<?php

namespace Medians\Notifications\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Mail\Application\MailService;



/**
 * Notification class database queries
 */
class Notification extends CustomModel
{

	/**
	* @var String
	*/
	protected $table = 'notifications';


	protected $fillable = [
		'receiver_type',
		'receiver_id',
		'event_id',
		'model_type',
		'model_id',
		'subject',
		'body',
		'status'
	];


	protected $appends = ['receiver_name', 'date', 'model_short_name', 'short_date', 'url'];

	public function getDateAttribute()
	{
		$date = date('Y-m-d', strtotime($this->created_at));

		return date( ($date == date('Y-m-d')) ? 'H:i a' : 'M d, H:i a'  , strtotime($this->created_at));

		return date('Y-m-d', strtotime($this->created_at));
	}

	public function getShortDateAttribute()
	{
		$date = date('Y-m-d', strtotime($this->created_at));
		return date( ($date == date('Y-m-d')) ? 'H:i' : 'M d, H:i'  , strtotime($this->created_at));
	}

	public function getModelShortNameAttribute()
	{
    	return strtolower((new \ReflectionClass(new $this->model_type))->getShortName());
	}

	public function getReceiverNameAttribute()
	{
		if ($this->receiver_type == User::class)
			return $this->user->name;

	}

	public function getUrlAttribute()
	{
		switch ($this->model_short_name) 
		{
			case 'device':
				return '/admin/devices/manage';
				break;
			
			case 'orderdevice':
				return '/admin/devices/booking_follow';
				break;
			
			case 'expense':
				return '/admin/expenses/index';
				break;
			
		}
	}

	public function getFields()
	{
		return $this->fillable;
	}


	public function user()
	{
		return $this->hasOne(User::class, 'id', 'receiver_id');
	}



	/**
	 * Store notification from Event
	 * 
	 * @param $event_id int 
	 * @param $subject String 
	 * @param $body String Notification content
	 * @param $model Object Model that called the event 
	 * @param $receiver Object Receiver of the Notification 
	 */
	public static function storeEventNotification(Int $event_id, String $subject,String $body, $model, $receiver)
	{

		$receiverPK = $receiver->getPrimaryKey();
		$modelPK = $model->getPrimaryKey();

    	// Store notification
		$filled['receiver_type'] = get_class($receiver);
		$filled['receiver_id'] = $receiver->$receiverPK;
		$filled['event_id'] = $event_id;
		$filled['model_type'] = get_class($model);
		$filled['model_id'] = $model->$modelPK;
    	$filled['subject'] = $subject;
    	$filled['body'] = $body;
    	$filled['status'] = 'new';

    	$notification = Notification::create($filled);

		(new Notification)->sendNotification($notification, $receiver);
		
	}  


	/**
	 * Send notification
	 */
	public function sendNotification(Notification $notification, $receiver)
	{
		error_log(json_encode($notification), 3, "./error_log.log");
		$sendMail = new MailService($receiver->email, $receiver->name, $notification->subject, $notification->body);

		return $sendMail;
	}
}
