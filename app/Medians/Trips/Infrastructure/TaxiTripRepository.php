<?php

namespace Medians\Trips\Infrastructure;

use Medians\Trips\Domain\TaxiTrip;
use Medians\Customers\Domain\Employee;
use Medians\Customers\Domain\SuperVisor;
use Medians\Customers\Domain\Parents;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;

use Medians\Routes\Infrastructure\RouteRepository;


class TaxiTripRepository 
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
		return TaxiTrip::with('transaction')->find($id);
	}


	public function get($limit = 100)
	{
		return TaxiTrip::where('business_id', $this->business_id)->with('driver', 'vehicle','model')->orderBy('trip_id', 'DESC')->limit($limit)->get();
	}

	public function getTaxiTrip($id)
	{
		return TaxiTrip::with('transaction','driver','vehicle','model','business')->find($id);
	}

	public function getDriverTrips($id)
	{
		return TaxiTrip::where('business_id', $this->business_id)->with('driver', 'vehicle', 'model','business')->where('driver_id', $id)->orderBy('trip_id','DESC')->limit(10)->get();
	}

	public function getDriverTaxiTrips($id, $limit = 1000)
	{
		return TaxiTrip::with('driver', 'vehicle', 'model','business')->where('driver_id', $id)->orderBy('trip_id','DESC')->limit($limit)->get();
	}

    

	public function getUpcomingDriverTrip($driver_id)
	{
		return TaxiTrip::where('business_id', $this->business_id)
		->where('driver_id', $driver_id)
		->whereIn('status',  ['scheduled','started'])
		// ->where('date', '>=', date('Y-m-d'))
        ->with('model','driver','vehicle','business')
		->first();
	}

	public function getUpcomingParentTrip($parent_id)
	{
		return TaxiTrip::where('model_id', $parent_id)->where('model_type', Parents::class)
		->whereIn('status',  ['scheduled','started'])
		// ->where('date', '>=', date('Y-m-d'))
        ->with('model','driver','vehicle','business')
		->first();
	}

	public function getParentTrips($parent_id)
	{
		return TaxiTrip::where('model_id', $parent_id)->where('model_type', Parents::class)
        ->with('model','driver','vehicle','business')
		->orderBy('trip_id','DESC')
		->get();
	}

	
	public function getByDate($params)
	{
		
		$check = TaxiTrip::with('model',  'driver', 'vehicle')->where('business_id', $this->business_id);

		if (!empty($params["start_date"]))
		{
			$check = $check->whereBetween('date' , [$params['start_date'] , $params['end_date']]);
		}

		return $check->orderBy('created_at', 'DESC')->get();
	}

	
	public function eventsByDate($params)
	{
		$query = TaxiTrip::where('business_id', $this->business_id)->whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}

	public function allEventsByDate($params)
	{
		$query = TaxiTrip::where('business_id', $this->business_id)->whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}

	
	/**
	* Find By Business between two days 
	*/
	public function getByDateCharts($params )
	{

	  	$check = TaxiTrip::where('business_id', $this->business_id)->whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');

  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}

	
	/**
	* Find all items between two days 
	*/
	public function getAllByDateCharts($params )
	{

	  	$check = TaxiTrip::where('business_id', $this->business_id)
		->whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');

  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}

	
	/**
	* Find all items between two days 
	*/
	public function masterByDateCharts($params )
	{

	  	$check = TaxiTrip::whereBetween('date' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, date as label');
  		return $check->groupBy('date')->orderBy('date', 'ASC')->get();
	}


	public function filterData($data)
	{
        $Model = new TaxiTrip;

        $data['model_type'] = $this->handleClassType($data['usertype']);

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
	 * Update Lead
	 */
	public function handleClassType($data)
	{

		if (strtolower($data) == 'employee')
			return Employee::class;
	
		if (strtolower($data) == 'supervisor')
			return SuperVisor::class;

		if (strtolower($data) == 'parent')
			return Parents::class;

	}
	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new TaxiTrip();

		$dataArray = $this->filterData($data);

		// Return the  object with the new data
    	$Object = TaxiTrip::create($dataArray);

    	return $Object;
    }

    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = TaxiTrip::find($data['trip_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    }
    
    /**
     * Update Status
     */
    public function updateStatus($data)
    {

		$Object = TaxiTrip::where('business_id', $this->business_id)->find($data['trip_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    }
    

    /**
     * cancel Trip
     */
    public function cancelTrip($data)
    {

		$Object = TaxiTrip::find($data['trip_id']);
		
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
			
			$delete = TaxiTrip::where('business_id', $this->business_id)->find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	
 
}