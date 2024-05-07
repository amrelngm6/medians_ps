<?php

namespace Medians\Notifications\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Customers\Domain\Customer;
use Medians\Drivers\Domain\Driver;
use Medians\Drivers\Domain\DriverApplicant;
use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\TripLocation;
use Medians\Trips\Domain\TaxiTrip;
use Medians\Trips\Domain\TripAlarm;
use Medians\Locations\Domain\RouteLocation;
use Medians\Help\Domain\HelpMessageComment;
use Medians\Customers\Domain\Parents;
use Medians\Customers\Domain\Employee;
use Medians\Customers\Domain\SuperVisor;
use Medians\Students\Domain\Student;

/**
 * NotificationEvent class database queries
 */
class NotificationEvent extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'notifications_events';

	/**
	* @var Array
	*/
	protected $fillable = [
		'title',
		'receiver_model',
		'model',
		'action_field',
		'action_value',
		'action',
		'subject',
		'template_id',
		'body_text',
		'status',
    	'created_by',
	];

	public $appends = ['receiver_title', 'model_title'];




	public function getReceiverTitleAttribute()
	{
		$value = explode("\\", $this->receiver_model);
		return end($value);
	}

	public function getModelTitleAttribute()
	{
		$value = explode("\\", $this->model);
		return end($value);
	}

	public function getFields()
	{
		return $this->fillable;
	}



	/**
	 * handle create event and process the Notification
	 * Body and information
	 * 
	 * @param $model Object Event related model
	 * @param $action String action type at CRUD
	 */ 
	public function handleEvent($model, $action, $updatedFields = null)
	{

		$events = json_decode(NotificationEvent:: where('action',$action)->where('model',get_class($model))->get());

		foreach ($events as $event) 
		{
			$event = $this->renderNotification($event, $model);
		}

		return true;

	}

	/**
	 * handle update event and process the Notification
	 * Body and information
	 * 
	 * @param $model Object Event related model
	 * @param $action String action type at CRUD
	 */ 
	public function handleEventUpdate($model, $action, $updatedFields = null)
	{
		$events = json_decode(NotificationEvent::whereIn('action_field', $updatedFields)
		->where('action',$action)
		->where('model',get_class($model))
		->orWhere('action_field', '')
		->where('action',$action)
		->where('model',get_class($model))
		->get());

    	foreach ($events as $event) 
    	{
			$event = $this->renderNotification($event, $model);
    	}

    	return true;
	}



	public function validateUserType($event, $user)
	{
		return $user->model == $event->receiver_model ? $user : null;
	}

	

	
	/**
	 * Filter Business Owners notification 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterUser($event, $model)
	{
		switch (get_class($model)) 
		{
			case HelpMessageComment::class:
				$item =  $model->with('message')->find($model->message_id);
				return isset($model->message->business->owner) ?  [$model->message->business->owner] : null;
				break;

			case HelpMessage::class:
				$item =  $model->with('business')->find($model->message_id);
				return isset($model->business->owner) ?  [$model->business->owner] : null;
				break;

			case RouteLocation::class:
				$location =  $model->with('business')->find($model->route_location);
				return isset($model->business->owner) ?  [$model->business->owner] : null;
				break;

			case DriverApplicant::class:
				$item =  $model->with('business')->find($model->applicant_id);
				return isset($model->business->owner) ?  [$model->business->owner] : null;
				break;

			case TaxiTrip::class:
				$object =  $model->with('business')->find($model->trip_id);
				// $object =  $model->with(['business'=>function($q){return $q->with('owner');}])->find($model->trip_id);
				return isset($model->business->owner) ?  [$model->business->owner] : null;
				break;
				
			default:
				return $model;
				break;
			
		}
	}


	/**
	 * Prepare notification receivers
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterReceivers($event, $model)
	{	
		switch ($event->receiver_model) 
		{
			case Driver::class:
				return method_exists($model, 'receiverAsDriver') ? [$model->receiverAsDriver()] : null;
				break;
				
				case Employee::class:
				case SuperVisor::class:
				case Parents::class:
				return method_exists($model, 'receiverAsCustomer') ? [$this->validateUserType($event, $model->receiverAsCustomer())] : null;
				break;
				
			case User::class:
				return $this->filterUser($event, $model);
				break;
			
		}
	}

	

	/**
	 * Prepare notification content 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function renderNotification($event, $model)
	{
		try {
			$receivers = $this->filterReceivers($event, $model);

			if (!$receivers)
				return null;

			foreach ($receivers as $key => $receiver) 
			{
				if ($receiver)
				{
					$this->saveNotification($event, $model, $receiver);
				}
			}

			return true;
			
		} catch (\Throwable $th) {
			error_log($th->getMessage());
			return null;
		}
	}  

	public function saveNotification($event, $model, $receiver)
	{
    	$app = new \config\APP;
    	$params = [];

    	/**
    	 * Get short name for the class to use as index
		 * Append the model as paramater to render the content
		 * And replace the shortcode
		 */ 
    	$params['model'] = $model;
    	$params['receiver'] = $receiver;
		$templateRepo = new \Medians\Templates\Infrastructure\EmailTemplateRepository;
		$template = $templateRepo->findByLang($event->template_id, isset($receiver->field['lang']) ? $receiver->field['lang'] : $app->default_lang);
    	$event->body = isset($template->content->content) ? $app->renderTemplate($template->content->content)->render($params) : '';
    	$event->subject = $app->renderTemplate($event->subject)->render($params);
    	$event->body_text = $app->renderTemplate($event->body_text)->render($params);

    	return Notification::storeEventNotification($event, $model, $receiver);
	}
}
