<?php

namespace Medians\Locations\Infrastructure;

use Medians\Locations\Domain\RouteLocation;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;
use Medians\Customers\Domain\Employee;
use Medians\Customers\Domain\SuperVisor;


class RouteLocationRepository 
{


	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business ;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}


	public function find($id)
	{
		return RouteLocation::where('business_id', $this->business_id)->find($id);
	}

	public function findByStudent($id)
	{
		return RouteLocation::where('business_id', $this->business_id)->where('model_type', Student::class)->where('model_id',$id)->first();
	}

	public function get($limit = 100)
	{
		return RouteLocation::with('route','model')
		->where('business_id', $this->business_id)->limit($limit)->orderBy('location_id','DESC')->get();
	}

	public function getRouteStudents($route_id)
	{
		return RouteLocation::where('business_id', $this->business_id)->whereDoesntHave('',function($q){
			return $q;
		})
		->where('route_id', $route_id)->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$data['model_type'] = $this->handleClassType($data['usertype']);

		$Model = new RouteLocation();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = RouteLocation::create($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

		return $Object;
	}
		
	
		
	/**
	 * Update Lead
	 */
	public function handleClassType($data)
	{

		if (strtolower($data) == 'employee')
			return Employee::class;
	
		if (strtolower($data) == 'student')
			return Student::class;
	
		if (strtolower($data) == 'supervisor')
			return SuperVisor::class;

	}
	
		
	/**
	 * Update Lead
	 */
	public function update($data)
	{
		
		$data['model_type'] = $this->handleClassType($data['usertype']);

		$Object = RouteLocation::where('business_id', $this->business_id)->find($data['location_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['location_id']) : '';

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
			
			$delete = RouteLocation::where('business_id', $this->business_id)->find($id)->delete();

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
			
			$delete = RouteLocation::where('model_id',$student_id)->where('model_type',Student::class)->delete();

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
		CustomField::where('model_type', RouteLocation::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = RouteLocation::class;	
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