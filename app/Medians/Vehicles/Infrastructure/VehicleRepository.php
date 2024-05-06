<?php

namespace Medians\Vehicles\Infrastructure;

use Medians\Vehicles\Domain\Vehicle;
use Medians\CustomFields\Domain\CustomField;
use Medians\Trips\Domain\TripTrack;


class VehicleRepository 
{

	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business;

	function __construct($business)
	{
		$this->business = $business;

		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}




	public function find($id)
	{
		return Vehicle::with('type')->where('business_id', $this->business_id)->find($id);
	}

	public function get($limit = 100)
	{
		return Vehicle::with('type')->where('business_id', $this->business_id)->limit($limit)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$permission = 'Vehicle.count';
		if (count($this->get()) == $this->business->subscription->features[$permission])
		{
			return throw new \Exception(translate('Access limit exceeded'), 1);
		}

		$Model = new Vehicle();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Vehicle::create($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Vehicle::where('business_id', $this->business_id)->find($data['vehicle_id']);
		
		// Return the  object with the new data
    	$update = $Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['vehicle_id']) : '';
		
    	// Store Custom fields
    	!empty($data['trip_track']) ? TripTrack::addItem((array) $data['trip_track']) : '';

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
			
			$delete = Vehicle::where('business_id', $this->business_id)->find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Vehicle::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Vehicle::class;	
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