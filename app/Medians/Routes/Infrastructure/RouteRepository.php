<?php

namespace Medians\Routes\Infrastructure;

use Medians\Routes\Domain\Route;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;


class RouteRepository 
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
		return new Route();
	}


	public function find($id)
	{
		return Route::with('pickup_locations', 'driver')->find($id);
	}

	public function get($limit = 100)
	{
		return Route::with('pickup_locations', 'vehicle', 'driver')->limit($limit)->get();
	}
	
	public function getRouteStudents($route_id)
	{
		$dayName = strtolower(date('l'));
		
		return Route::with(['pickup_locations'=> function($q) use ($dayName, $route_id){
			return $q->where($dayName, '>',0)->where('route_id', $route_id);
		}])->with(['destinations'=> function($q) use ($route_id, $dayName){
			return $q->where('route_id', $route_id)->where('model_type',Student::class)->whereHas('active_pickup', function($Q) use ($dayName){
				return $Q->where($dayName, '>' ,0);
			});
		}])->find($route_id);
	}


	public function getDriverRoute($driver_id)
	{
		return Route::with(['driver'=> function($q) use ($driver_id){
			
			return $q->where('vehicles.driver_id', $driver_id);

		}])->whereHas('driver', function($q) use ($driver_id){
			return $q->where('vehicles.driver_id', $driver_id);
		})->with('pickup_locations','destinations','vehicle')->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Route();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Route::create($dataArray);
    	$Object->update($dataArray);

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

		$Object = Route::find($data['route_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['route_id']) : '';

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
			
			$delete = Route::find($id)->delete();

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
		CustomField::where('model_type', Route::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Route::class;	
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