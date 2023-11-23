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

	public function getModel()
	{
		return new NotificationEvent;
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
			'PickupLocation' => \Medians\Locations\Domain\PickupLocation::class,
			'Destination' => \Medians\Locations\Domain\Destination::class,
			'Student' => \Medians\Students\Domain\Student::class,
			'User' => \Medians\Users\Domain\User::class,
			'Driver' => \Medians\Drivers\Domain\Driver::class,
			'Vehicle' => \Medians\Vehicles\Domain\Vehicle::class,
			'Trip' => \Medians\Trips\Domain\Trip::class,
			'Parents' => \Medians\Parents\Domain\Parents::class,
			'HelpMessage' => \Medians\Help\Domain\HelpMessage::class,
			'HelpMessageComment' => \Medians\Help\Domain\HelpMessageComment::class,
		];
	}   
}