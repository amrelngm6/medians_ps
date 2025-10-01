<?php

namespace Medians\Trips\Infrastructure;

use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\TripAlarm;
use Medians\Trips\Domain\TripLocation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;

use Medians\Routes\Infrastructure\RouteRepository;


class TripRepository 
{


	/**
	 * Business id
	 */ 
	protected $business_id ;
	
	protected $routeRepo;

	function __construct($business)
	{
		
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
		$this->routeRepo = new RouteRepository($business);
	}


	public function find($id)
	{
		return Trip::where('business_id', $this->business_id)->find($id);
	}

	public function findLocation($id)
	{
		return TripLocation::find($id);
	}

	public function getTrip($id)
	{
		return Trip::withCount('moving_locations','done_locations','waiting_locations')->with('locations',  'driver', 'vehicle', 'route','supervisor')->find($id);
	}

	public function getParentTrip($trip_id, $parent_id)
	{
		return Trip::where('business_id', $this->business_id)->with('locations',  'driver', 'vehicle', 'route')
		->with([
			'locatiobs' => function($q) use ($parent_id){
				return $q->with('location')->where('model_type', Student::class)->whereHas('model', function($q) use ($parent_id){
					return $q->where('parent_id', $parent_id);
				})->orderBy('status','DESC');
		}])->with([
			'locatiobs' => function($q) use ($parent_id){
				return $q->with('location')->where('model_type', Student::class)->whereHas('model', function($q) use ($parent_id){
					return $q->where('parent_id', $parent_id);
				})->orderBy('status','DESC');
		}])
		->find($trip_id);
	}

	public function getActiveParentTrip($parent_id)
	{
		$ids = Student::where('parent_id', $parent_id)->select('student_id')->get();

		$students =  array_column($ids->toArray(), 'student_id');

		return Trip::with('driver', 'vehicle', 'route')
		->whereHas('locations' , function($q) use ($students){
				return $q->with('location')->whereIn('model_id', $students)->orderBy('status','DESC');
		})->with(['locations' => function($q) use ($students){
				return $q->with('location')->whereIn('model_id', $students)->orderBy('status','DESC');
		}])
		->where('status','started')
		->withCount('moving_locations')->withCount('waiting_locations')->first();
	}


	public function getActiveTrips()
	{
		return Trip::with('driver', 'vehicle', 'route')
		->where('business_id', $this->business_id)
		->where('status', 'started')
		->withCount('moving_locations')->withCount('waiting_locations')
		->get();
	}

	public function getDriverTrips($id, $limit = 10)
	{
		return Trip::with(['locations'=> function($q){
			$q->with('model');
		}])
		->where('business_id', $this->business_id)
		->with('driver', 'vehicle')
		->where('driver_id', $id)->orderBy('trip_id','DESC')->limit($limit)->get();
	}

	public function getActiveDriverTrip($driver_id)
	{
		return Trip::where('business_id', $this->business_id)
		->with('route','driver','vehicle','supervisor')
		->with(['locations'=> function($q){
			$q->with('model');
		}])
		->where('driver_id', $driver_id)
		->whereDate('date', date('Y-m-d'))
		->where('status', 'started')
		->first();
	}

	public function getStudentTrips($id, $lastId = 0)
	{
		return Trip::with('locations', 'driver', 'vehicle', 'route')->whereHas(
			'locations', function($q) use ($id){
				$q->where('model_id', $id)->where('model_type', Student::class)->with('model');
			}
		)->withCount('moving_locations')->withCount('waiting_locations')->orderBy('trip_id','DESC')->limit(10)->get();
	}

	public function getParentStudentsTrips($parent_id)
	{
		
		$ids = Student::where('parent_id', $parent_id)->select('student_id')->get();

		$students =  array_column($ids->toArray(), 'student_id');

		return Trip::with('driver', 'vehicle', 'route')
		->whereHas('locations' , function($q) use ($students){
				return $q->with('location')->whereIn('model_id', $students)->orderBy('status','DESC');
		})->with(['locations' => function($q) use ($students){
				return $q->with('location')->orderBy('status','DESC');
		}])
		->withCount('moving_locations')->withCount('waiting_locations')->orderBy('trip_id','DESC')->limit(10)->get();
	}

	
	public function get($limit = 100)
	{
		return Trip::where('business_id', $this->business_id)->withCount('moving_locations')->withCount('locations')->with('route', 'locations',  'waiting_locations', 'driver', 'vehicle')->orderBy('trip_id', 'DESC')->limit($limit)->get();
	}

	
	public function eventsByDate($params)
	{
		$query = Trip::where('business_id', $this->business_id)->whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}

	public function getByDate($params)
	{
		
		$check = Trip::with('locations',  'driver', 'vehicle', 'route','supervisor')
		->where('business_id', $this->business_id)
		->withCount('moving_locations')->withCount('locations');

		if (!empty($params["start_date"]))
		{
			$check = $check->whereBetween('date' , [$params['start_date'] , $params['end_date']]);
		}

		return $check->orderBy('created_at', 'DESC')->get();
	}

	public function allEventsByDate($params)
	{
		$query = Trip::where('business_id', $this->business_id)
		->whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}

	public function masterByDate($params)
	{
		$query = Trip::whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}

	
	/**
	* Find By Business between two days 
	*/
	public function getByDateCharts($params )
	{

	  	$check = Trip::where('business_id', $this->business_id)
		->whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');

  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}

	
	/**
	* Find all items between two days 
	*/
	public function getAllByDateCharts($params )
	{

	  	$check = Trip::where('business_id', $this->business_id)
		->whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');

  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}

	
	
	/**
	* Find all items between two days 
	*/
	public function masterByDateCharts($params )
	{

	  	$check = Trip::whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');

  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}

	

	public function filterData($data)
	{
		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		return $dataArray;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Trip();

		$dataArray = $this->filterData($data);

		// Return the  object with the new data
    	$Object = Trip::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }

    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Trip::where('business_id', $this->business_id)->find($data['trip_id']);
		
		// Return the  object with the new data
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
			
			$delete = Trip::where('business_id', $this->business_id)->find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	 * Store trip
	 */
	public function createTrip($data)
	{

		$data = (array) $data;

		// Load route with locations
		$route = $this->routeRepo->getRouteForTrip($data['route_id']);

		// Stop if no locations for this route today
		if (empty($route->route_locations))
			return null;

		$data['date'] =  date('Y-m-d');
		$data['business_id'] =  $this->business_id;
		$data['route_id'] =  $route->route_id;
		$data['driver_id'] =  $route->driver_id;
		$data['vehicle_id'] =  $route->vehicle_id;
		$data['supervisor_id'] =  $route->supervisor_id;
		$data['status'] =  'started';
		$data['start_time'] = date('H:i:s');

		// Create the Trip
		$save = Trip::firstOrCreate($data);

		// Stop if duplicated
		if (empty($save->wasRecentlyCreated))
			return $save;

		// Handle trip waypoints
		foreach ($route->route_locations as $key => $value) 
		{
			$value['trip_id'] = $save->trip_id;
			$value['status'] = 'waiting';
			// Store trip location
			$this->saveLocation($value);
		}

		// Return the trip
		return $this->getTrip($save->trip_id);
	}
	

	/**
	 * Store trip
	 */
	public function createAlarm($data)
	{

		$data = (array) $data;

		// Load route with locations
		$trip = $this->find($data['trip_id']);

		$tripLocation = $this->findLocation($data['trip_location_id']);

		// Stop if no locations for this route today
		if (empty($trip->trip_id))
			return null;

		$data['business_id'] =  $this->business_id;
		$data['trip_id'] =  $trip->trip_id;
		$data['model_id'] =  $tripLocation->model_id;
		$data['model_type'] =  $tripLocation->model_type;

		// Create the Trip
		$save = TripAlarm::create($data);

		return $save;
	}
	

	/**
	 * Store Trip Location
	 */
	public function saveLocation($data)
	{

		$fieldsData = [
			'trip_id' => $data['trip_id'],
			'model_type' => $data['model_type'],
			'model_id' => $data['model_id'],
			'location_id' => $data['location_id'],
			'status' => $data['status'],
		];

		$check = TripLocation::create($fieldsData);

		return $check;
	}
	

	/**
	 * update trip
	 */
	public function updateTripLocationStatus($data)
	{
		
		$trip = Trip::find($data['trip_id']);

		$location = TripLocation::find($data['trip_location_id']);
		$data['boarding_time'] = date('Y-m-d h:i:s');
		$update = $location->update($data);

		return $update ? true : false;
	}
	

	/**
	 * End trip
	 */
	public function endTrip($data, $driverId)
	{
		
		$trip = Trip::where('driver_id', $driverId)->where('trip_id', $data['trip_id'])->first();
		$trip->end_time = date('H:i:s');
		$update = $trip->update($data);

		$updateLocations = TripLocation::where('trip_id', $data['trip_id'])->where('status', 'moving')->update(['status'=> 'done', 'dropoff_time'=> date('Y-m-d h:i:s')]);

		return $update ? true : false;
	}
	
    	
    	
 
}