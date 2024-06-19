<?php

namespace Medians\Routes\Infrastructure;

use Medians\Routes\Domain\Route;
use Medians\Routes\Domain\RoutePosition;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;


class RouteRepository 
{


	 
	



	function __construct()
	{
		
		
	}



	public function find($id)
	{
		return Route::with('route_locations', 'position', 'driver')->find($id);
	}

	public function get($limit = 100)
	{
		return Route::with('route_locations', 'position', 'supervisor', 'vehicle', 'driver')->limit($limit)->get();
	}
	
	public function getRouteForTrip($route_id)
	{
		$dayName = strtolower(date('l'));
		
		return Route::with(['route_locations'=> function($q) use ($dayName, $route_id){
			return $q->where($dayName, 'on')->where('route_id', $route_id)->whereDoesntHave('vacation');
		}])
		->whereHas('route_locations', function($q) use ($dayName, $route_id){
			return $q->where($dayName, 'on')->where('route_id', $route_id)->whereDoesntHave('vacation');
		})
		->find($route_id);
	}


	public function getDriverRoutes($driver_id)
	{
		return Route::where('driver_id', $driver_id)
		->where('status', 'on')
		->with('route_locations','position', 'vehicle')
		->get();
	}

	public function getDriverRoute($driver_id)
	{
		return Route::where('driver_id', $driver_id)
		->where('status', 'on')
		->with('route_locations','position', 'vehicle')
		->first();
	}

	
	public function getRoutes()
	{
		return Route::where('status', 'on')
		->with('route_locations','position', 'vehicle')
		->get();
	}

	public function getParentRoutes($parent_id)
	{
		
		$ids = Student::where('parent_id', $parent_id)->select('student_id')->get();

		$students =  array_column($ids->toArray(), 'student_id');
		
		return Route::with('route_locations','position', 'vehicle')
		->where('parent_id', $parent_id)
		->whereHas('route_locations', function($q) {
			$q->where('');
		})
		->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Route();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Route::create($dataArray);

    	// Store Custom fields
		isset($data['field']) ? $this->storeCustomFields($data['field'], $Object->route_id) : '';
				
    	// Store Postition
		!empty($data['position']) ? $this->storeRoutePosition($data['position'], $Object->route_id) : '';

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
    	!empty($data['position']) ? $this->storeRoutePosition($data['position'], $data['route_id']) : '';

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
				$this->storeRoutePosition(null, $id);
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

	/**
	* Save related items to database
	*/
	public function storeRoutePosition($data, $id) 
	{
		global $capsule;

		RoutePosition::where('route_id', $id)->delete();

		$data = is_object($data) ? $data : json_decode($data);

		$Model = new RoutePosition;
		
		$save = $capsule->getConnection()->insert("INSERT INTO ".$Model->getTable()." (start_location, end_location) VALUES (POINT({$data->start_latitude}, {$data->start_longitude}), POINT({$data->end_latitude}, {$data->end_longitude}))");
		
		$insertedId = $capsule->getConnection()->getPdo()->lastInsertId();

		if ($data)
		{
			
			$data->route_id = $id;	
			
			$dataArray = [];
			foreach ($data as $key => $value) 
			{
				if (in_array($key, $Model->getFields()))
				{
					$dataArray[$key] = $value;
				}
			}		
			
			$item = $Model->find($insertedId);
			
			$Model = $item->update($dataArray);
	
			return $Model;		
		}
	}

	
	public function getNearestRoute($data)
	{
		global $capsule;
		
		// Assuming your current location coordinates
		$currentLocation = "POINT({$data->latitude} {$data->longitude})";

		// Run the SQL query using Capsule's getConnection method
		$results = $capsule->getConnection()->select("
			SELECT route_id, 
			ST_Distance_Sphere(start_location, ST_GeomFromText(?)) AS start_distance, 
			ST_Distance_Sphere(end_location, ST_GeomFromText(?)) AS end_distance 
			FROM route_position
			HAVING start_distance < 100 OR end_distance < 100
		", [$currentLocation, $currentLocation]);

		$ids = array_column($results, 'route_id');
		$list = Route::whereIn('route_id',$ids)->get();
		// print_r($list);
		return $list;
	}

 
}