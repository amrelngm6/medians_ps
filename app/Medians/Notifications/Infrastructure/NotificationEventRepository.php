<?php

namespace Medians\Notifications\Infrastructure;

use Medians\Notifications\Domain\NotificationEvent;



/**
 * NotificationEvent class database queries
 */
class NotificationEventRepository 
{

	protected $app ;


	function __construct ()
	{
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return NotificationEvent::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return NotificationEvent::get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new NotificationEvent();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = NotificationEvent::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = NotificationEvent::find($data['id']);
		
		// Return the Model object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return NotificationEvent::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	 * Load all notifiable Models for 
	 * Dynamic events 
	 * 
	 */
	public function loadModels()
	{
		return [
			'Business' => \Medians\Businesses\Domain\Business::class,
			'RouteLocation' => \Medians\Locations\Domain\RouteLocation::class,
			'Student' => \Medians\Students\Domain\Student::class,
			'Customer' => \Medians\Customers\Domain\Customer::class,
			'User' => \Medians\Users\Domain\User::class,
			'Driver' => \Medians\Drivers\Domain\Driver::class,
			'DriverApplicant' => \Medians\Drivers\Domain\DriverApplicant::class,
			'Vehicle' => \Medians\Vehicles\Domain\Vehicle::class,
			'Trip' => \Medians\Trips\Domain\Trip::class,
			'TripLocation' => \Medians\Trips\Domain\TripLocation::class,
			'TaxiTrip' => \Medians\Trips\Domain\TaxiTrip::class,
			'Trip alarm' => \Medians\Trips\Domain\TripAlarm::class,
			'Parents' => \Medians\Customers\Domain\Parents::class,
			'HelpMessage' => \Medians\Help\Domain\HelpMessage::class,
			'PackageSubscription' => \Medians\Packages\Domain\PackageSubscription::class,
			'Payment' => \Medians\Payments\Domain\Payment::class,
			'HelpMessageComment' => \Medians\Help\Domain\HelpMessageComment::class,
		];
	}   


	/**
	 * Load all receiveable Models for 
	 * Dynamic events 
	 * 
	 */
	public function loadReceiverModels()
	{
		return [
			'User' => \Medians\Users\Domain\User::class,
			'Driver' => \Medians\Drivers\Domain\Driver::class,
			'Parents' => \Medians\Customers\Domain\Parents::class,
			'Employee' => \Medians\Customers\Domain\Employee::class,
			'SuperVisor' => \Medians\Customers\Domain\SuperVisor::class,
		];
	}   
}