<?php

namespace Medians\Notifications\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Customers\Domain\Customer;
use Medians\Customers\Domain\Agent;
use Medians\Templates\Domain\EmailTemplate;

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



	public function template()
	{
		return $this->hasOne(EmailTemplate::class, 'template_id', 'template_id');
	}


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
		return $user->model == $event->receiver_model ? $user : $user;
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
			case Agent::class:
				return [$model];
				// return method_exists($model, 'receiverAsCustomer') ? [$this->validateUserType($event, $model->receiverAsCustomer())] : null;
				break;
				
			case User::class:
				return method_exists($model, 'receiverAsUser') ? [$model->receiverAsUser()] : null;
				break;

			default:
				return $model;
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
					$save = $this->saveNotification($event, $model, $receiver);
				}
			}

			return isset($save);
			
		} catch (\Throwable $th) {
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
		try {
			
			$params['model'] = $model;
			$params['receiver'] = $receiver;
			try {
				
				$templateRepo = new \Medians\Templates\Infrastructure\EmailTemplateRepository;
				$template = $templateRepo->findByLang($event->template_id, isset($receiver->field['language']) ? $receiver->field['language'] : $app->default_lang);
				$event->body = isset($template->content->content) ? $app->renderTemplate($template->content->content)->render($params) : '';

			} catch (\Throwable $th) {
				$event->body = $app->renderTemplate($event->body_text)->render($params) ;
			}

			$event->subject = $app->renderTemplate($event->subject)->render($params);
			$event->body_text = $app->renderTemplate($event->body_text)->render($params);
			return Notification::storeEventNotification($event, $model, $receiver);
	
		} catch (\Throwable $th) {
			
			error_log($th->getMessage());
		}
	}
}
