<?php

namespace Medians\Notifications\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;
use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\PickupLocation;
use Medians\Help\Domain\HelpMessageComment;

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
		'body',
		'body_text',
		'status',
    	'created_by',
	];


	/**
	* @var bool
	*/
	// public $timestamps = false;



	public function getFields()
	{
		return $this->fillable;
	}



	/**
	 * handle event and process the Notification
	 * Body and information
	 * 
	 * @param $model Object Event related model
	 * @param $action String action type at CRUD
	 */ 
	public function handleEvent($model, $action)
	{
    	$events = json_decode(NotificationEvent::where('action',$action)->where('model',get_class($model))->get());

    	foreach ($events as $event) 
    	{
    		$this->renderNotification($event, $model);
    	}

    	return true;
	}


	/**
	 * Prepare notification content 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterReceiver($event, $model)
	{
		switch (get_class($model)) 
		{
			case HelpMessageComment::class:
				return $model->message->user;
				break;

			case PickupLocation::class:
				$location =  $model->with('route')->find($model->pickup_id);
				return isset($location->route->driver) ? $location->route->driver : null;
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

    	$receiver = $this->filterReceiver($event, $model);

		if (!$receiver)
			return null;

    	$app = new \config\APP;
    	$params = [];

    	/**
    	 * Get short name for the class to use as index
		 * Append the model as paramater to render the content
		 * And replace the shortcode
		 */ 
    	$params['model'] = $model;
    	$event->body = $app->renderTemplate($event->body)->render($params);
    	$event->body_text = $app->renderTemplate($event->body_text)->render($params);

    	return Notification::storeEventNotification($event, $model, $receiver);
	}  
}
