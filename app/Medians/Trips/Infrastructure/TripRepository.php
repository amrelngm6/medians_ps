<?php

namespace Medians\Trips\Infrastructure;

use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\PickupLocation;
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
		$this->app = new \config\APP;
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
		return Trip::with('vehicle')->find($id);
	}

	public function get($limit = 100)
	{
		return Trip::limit($limit)->get();
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

		// Return the FBUserInfo object with the new data
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

		return $save;
	}
	


	/**
	 * update trip
	 */
	public function updateTrip($data)
	{
		
		$trip = Trip::find($data['trip_id']);

		$update = $trip->update($data);

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
	
    	

 
}