<?php

namespace Medians\Locations\Infrastructure;

use Medians\Locations\Domain\PickupLocation;
use Medians\Locations\Domain\Destination;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;


class PickupLocationRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public static function getModel()
	{
		return new PickupLocation();
	}


	public function find($id)
	{
		return PickupLocation::find($id);
	}

	public function findByStudent($id)
	{
		return PickupLocation::where('model_type', Student::class)->where('model_id',$id)->first();
	}

	public function get($limit = 100)
	{
		return PickupLocation::limit($limit)->orderBy('pickup_id','DESC')->get();
	}

	public function getRouteStudents($route_id)
	{
		return PickupLocation::whereDoesntHave('',function($q){
			return $q;
		})
		->where('route_id', $route_id)->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new PickupLocation();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = PickupLocation::create($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	

	/**
	* Save item to database
	*/
	public function storeDestination($data) 
	{

		$Model = new Destination();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Destination::create($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = PickupLocation::find($data['pickup_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['pickup_id']) : '';

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
			
			$delete = PickupLocation::find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function deleteByStudent($student_id) 
	{
		try {
			
			$delete = PickupLocation::where('model_id',$student_id)->where('model_type',Student::class)->delete();

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
		CustomField::where('model_type', PickupLocation::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = PickupLocation::class;	
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