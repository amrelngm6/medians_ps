<?php

namespace Medians\Trips\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Medians\Customers\Domain\Parents;
use Medians\Customers\Domain\SuperVisor;
use Medians\Students\Domain\Student;



class Trip extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trips';

    protected $primaryKey = 'trip_id';
	
	public $fillable = [

		'driver_id',
		'vehicle_id',
		'route_id',
		'supervisor_id',
		'date',
		'status',
		'trip_type',
		'start_time',
		'end_time',
		'created_by'
	];


	public $appends = ['driver_name', 'car_plate', 'distance', 'duration'];

	public function getDriverNameAttribute() 
	{
		return isset($this->driver->first_name) ? $this->driver->first_name. ' ' .$this->driver->last_name : '';	
	}

	public function getCarPlateAttribute() 
	{
		return isset($this->vehicle->plate_number) ? $this->vehicle->plate_number : '';	
	}

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }

	
	/**
	 * Relations with onother Models
	 */
	

	
	public function route() 
	{
		return $this->hasOne(Route::class, 'route_id', 'route_id')->with('position');	
	}

	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class, 'vehicle_id', 'vehicle_id');	
	}

	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id');	
	}

	public function supervisor() 
	{
		return $this->hasOne(SuperVisor::class, 'customer_id', 'supervisor_id');	
	}

	public function locations() 
	{
		return $this->hasMany(TripLocation::class, 'trip_id', 'trip_id')->with('location','model')->orderBy('boarding_time', 'asc');	
	}

	public function waiting_locations() 
	{
		return $this->hasMany(TripLocation::class, 'trip_id', 'trip_id')->where('status', 'waiting');	
	}

	public function moving_locations() 
	{
		return $this->hasMany(TripLocation::class, 'trip_id', 'trip_id')->where('status', 'moving');	
	}
	
	public function done_locations() 
	{
		return $this->hasMany(TripLocation::class, 'trip_id', 'trip_id')->where('status', 'done');	
	}



	public function haversineDistance($lat1, $lon1, $lat2, $lon2) {
		$earthRadius = 6371; // Radius of the Earth in kilometers
	
		$dlat = deg2rad($lat2 - $lat1);
		$dlon = deg2rad($lon2 - $lon1);
	
		$a = sin($dlat / 2) * sin($dlat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlon / 2) * sin($dlon / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	
		$distance = $earthRadius * $c; // The distance in kilometers
	
		return $distance / 2;
	}
	
	public function getDurationAttribute() {
		
		if ($this->created_at)
		{
			$datetime1 = new \DateTime($this->created_at);
			$datetime2 = new \DateTime($this->updated_at);  // change the millennium to see output difference
			$diff = $datetime1->diff($datetime2);
	
			return '(0'.$diff->h.':'.($diff->i < 10 ? '0'.$diff->i : $diff->i).':'.$diff->s.')';
		}
	}
	
	public function getDistanceAttribute() {
		$locations = $this->route_locations;
		$route = $this->route;
		$totalDistance = 0;
		
		if ($locations && count($locations) > 0)
		{
			for ($i = 0; $i < count($locations); $i++) {
				$totalDistance += $this->haversineDistance($locations[$i]['latitude'], $locations[$i]['longitude'], $locations[($i + 1) % count($locations)]['latitude'], $locations[($i + 1) % count($locations)]['longitude']);
			}

			$totalDistance += $this->haversineDistance($locations[(count($locations) - 1)]['latitude'], $locations[(count($locations) - 1)]['longitude'], $route->latitude, $route->longitude);
		}

		return number_format($totalDistance, 3);
	}

    public function receiverAsCustomer()
    {
		$object =  $this->with('model')->find($this->trip_id);
		return isset($object->model) ? $object->model : null;
    }
	
    public function receiverAsDriver()
    {
		$object =  $this->whereHas('driver')->with('driver')->find($this->trip_id);
		return isset($object->driver) ? $object->driver : null;
    }

}
