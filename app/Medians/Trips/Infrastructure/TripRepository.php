<?php

namespace Medians\Trips\Infrastructure;

use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\PickupLocation;
use Medians\Locations\Domain\Destination;
use Medians\Trips\Domain\TripPickup;
use Medians\Trips\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


class TripRepository 
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
		return new Trip();
	}


	public function find($id)
	{
		return Trip::find($id);
	}

	public function getTrip($id)
	{
		return Trip::withCount('moving_locations')->withCount('waiting_locations')->with('pickup_locations', 'driver', 'vehicle')->find($id);
	}

	public function getDriverTrips($id)
	{
		return Trip::with(['pickup_locations'=> function($q){
			$q->with('model');
		}])->with('driver', 'vehicle')->where('driver_id', $id)->orderBy('trip_id','DESC')->limit(10)->get();
	}

	public function getStudentTrips($id)
	{
		return Trip::with('pickup_locations', 'driver', 'vehicle', 'route')->whereHas(
			'pickup_locations', function($q) use ($id){
				$q->where('model_id', $id);
			}
		)->orderBy('trip_id','DESC')->limit(10)->get();
	}

	public function get($limit = 100)
	{
		return Trip::withCount('moving_locations')->withCount('pickup_locations')->with('route', 'pickup_locations', 'waiting_locations', 'driver', 'vehicle')->orderBy('trip_id', 'DESC')->limit($limit)->get();
	}

	public function eventsByDate($params)
	{
		$query = Trip::whereBetween('trip_date', [$params['start'], $params['end']]);
		return $query;
	}

	
	/**
	* Find all items between two days By BranchId
	*/
	public function getByDateCharts($params )
	{

	  	$check = Trip::whereBetween('trip_date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, trip_date as label');

  		return $check->groupBy('trip_date')->orderBy('trip_date', 'ASC')->get();
	}


	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['trip_id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Trip::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}


	public function filterData($data)
	{
		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
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

		$Object = Trip::find($data['trip_id']);
		
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
			
			$delete = Trip::find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	 * Create trip
	 */
	public function createTrip($data)
	{
		$data['trip_date'] =  date('Y-m-d');
		$save = Trip::firstOrCreate($data);

		if (empty($save->wasRecentlyCreated))
			return $save;

		$check = PickupLocation::where('route_id', $data['route_id'])->get();

		foreach ($check as $key => $value) 
		{
			$value['trip_id'] = $save->trip_id;
			$value['status'] = 'waiting';
			$savePickups = $this->savePickup($value);
		}

		$check = Destination::where('route_id', $data['route_id'])->get();

		foreach ($check as $key => $value) 
		{
			$value['trip_id'] = $save->trip_id;
			$value['status'] = 'waiting';
			$savePickups = $this->saveDestination($value);
		}

		return $this->getTrip($save->trip_id);
	}
	


	/**
	 * update trip
	 */
	public function updateTrip($data)
	{
		
		$trip = Trip::find($data['trip_id']);

		$pickup = TripPickup::find($data['trip_pickup_id']);
		$data['boarding_time'] = date('Y-m-d h:i:s');
		$update = $pickup->update($data);

		return $update ? true : false;
	}
	

	/**
	 * End trip
	 */
	public function endTrip($data)
	{
		
		$trip = Trip::find($data['trip_id']);

		$update = $trip->update($data);

		TripPickup::where('trip_id', $data['trip_id'])->update(['status'=> 'done', 'dropoff_time'=> date('Y-m-d h:i:s')]);

		return $update ? true : false;
	}
	
    	
	/**
	 * Create Trip Pickup
	 */
	public function savePickup($data)
	{

		$fieldsData = [
			'trip_id' => $data['trip_id'],
			'model_type' => $data['model_type'],
			'model_id' => $data['model_id'],
			'pickup_id' => $data['pickup_id'],
			'status' => $data['status'],
		];

		$check = TripPickup::create($fieldsData);

		return $check;
	}
	
    	
	/**
	 * Create Trip Pickup
	 */
	public function saveDestination($data)
	{

		$fieldsData = [
			'trip_id' => $data['trip_id'],
			'model_type' => $data['model_type'],
			'model_id' => $data['model_id'],
			'pickup_id' => $data['pickup_id'],
			'status' => $data['status'],
		];

		$check = TripDestination::create($fieldsData);

		return $check;
	}
	
    	

 
}