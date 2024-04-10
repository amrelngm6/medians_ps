<?php

namespace Medians\Notifications\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Customers\Domain\Customer;
use Medians\Drivers\Domain\Driver;
use Medians\Drivers\Domain\DriverApplicant;
use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\TripAlarm;
use Medians\Locations\Domain\RouteLocation;
use Medians\Help\Domain\HelpMessageComment;
use Medians\Customers\Domain\Parents;

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
    		$event = $this->renderNotification($event, $model);
    	}

    	return true;
	}


	/**
	 * Prepare notification content 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterDriver($event, $model)
	{
		switch (get_class($model)) 
		{
			case HelpMessageComment::class:
				return [$model->message->user];
				break;

			case RouteLocation::class:
				$location =  $model->with('route')->find($model->location_id);
				return isset($location->route->driver) ? [$location->route->driver] : null;
				break;

			case Trip::class:
				$object =  $model->whereHas('driver')->with('driver')->find($model->trip_id);
				return isset($object->driver) ? [$object->driver] : null;
				break;

			default:
				return [$model];
				break;
			
		}
	}


	
	/**
	 * Prepare notification content 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterParent($event, $model)
	{
		switch (get_class($model)) 
		{
			case HelpMessageComment::class:
				return [$model->message->user];
				break;

			case RouteLocation::class:
				$location =  $model->with('parent')->find($model->location_id);
				return isset($location->parent) ? [$location->parent] : null;
				break;

			case TripAlarm::class:
				$object =  $model->whereHas('model')->with('model')->find($model->alarm_id);
				return isset($object->model) ? [$object->model] : null;
				break;

			case Trip::class:
				$object =  $model->whereHas('parent')->with('parent')->find($model->trip_id);
				return isset($object->parent) ? [$object->parent] : null;
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
	public function filterUser($event, $model)
	{
		switch (get_class($model)) 
		{
			case HelpMessageComment::class:
				return [$model->message->user];
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
				return isset($location->parent) ? [$location->parent] : null;
				break;

			default:
				return $model;
				break;
			
		}
	}

	

	/**
	 * Prepare notification receiver 
	 * 
	 * @param $event Object
	 * @param $model Object Event related model
	 */
	public function filterReceivers($event, $model)
	{	
		switch ($event->receiver_model) 
		{
			case Driver::class:
				return $this->filterDriver($event, $model);
				break;
				
			case Customer::class:
				return $this->filterParent($event, $model);
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
	}  

	public function saveNotification($event, $model, $receiver)
	{
		// error_log(is_string($receiver) ? $receiver : json_encode($receiver));
    	$app = new \config\APP;
    	$params = [];

    	/**
    	 * Get short name for the class to use as index
		 * Append the model as paramater to render the content
		 * And replace the shortcode
		 */ 
    	$params['model'] = $model;
    	$params['receiver'] = $receiver;
    	$event->body = $app->renderTemplate($event->body)->render($params);
    	$event->subject = $app->renderTemplate($event->subject)->render($params);
    	$event->body_text = $app->renderTemplate($event->body_text)->render($params);

    	return Notification::storeEventNotification($event, $model, $receiver);
	}
}
