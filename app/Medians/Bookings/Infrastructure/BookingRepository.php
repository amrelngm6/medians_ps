<?php

namespace Medians\Bookings\Infrastructure;

use Medians\Bookings\Domain\Booking;
use Medians\CustomFields\Domain\CustomField;


class BookingRepository 
{
	
	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	public static function getModel()
	{
		return new Booking();
	}


	public function find($id)
	{
		return Booking::with('content')->find($id);
	}

	public function get($type = 'Booking', $limit = 100)
	{
		return Booking::where('class', $type)->with('content','user','custom_fields', 'consultation' , 'offer')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}

	
	public function eventsByDate($params)
	{
		$query = Booking::where('class', $params['class'])->whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}


	public function allEventsByDate($params)
	{
		$query = Booking::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}






	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Booking();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Booking::create($dataArray);
    	$Object->update($dataArray);

    	$this->storeCustomFields($data['custom_field'] ,$Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Booking::find($data['id']);
		
		// Return the FBUserInfo object with the new data
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
			
			return Booking::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}





	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Booking::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Booking::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;	

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}



 
}
