<?php

namespace Medians\Trips\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Medians\Customers\Domain\Parents;
use Medians\Students\Domain\Student;
use Medians\Employees\Domain\Employee;
use Medians\Businesses\Domain\Business;


class PrivateTrip extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'private_trips';

    protected $primaryKey = 'trip_id';
	
		public $fillable = [
			'business_id',
			'driver_id',
			'vehicle_id',
			'model_id',
			'model_type',
			'pickup_address',
			'pickup_latitude',
			'pickup_longitude',
			'destination_address',
			'destination_latitude',
			'destination_longitude',
			'date',
			'start_time',
			'subtotal',
			'discount_amount',
			'total_cost',
			'status',
	];


	public $appends = ['distance', 'usertype', 'duration'];

	
	public function getUsertypeAttribute() {
		$parts = explode('\\', $this->model_type);
		return strtolower(end($parts));
	}


	public function getDriverNameAttribute() 
	{
		return isset($this->driver->first_name) ? $this->driver->first_name. ' ' .$this->driver->last_name : '';	
	}

	public function getCarPlateAttribute() 
	{
		return isset($this->vehicle->plate_number) ? $this->vehicle->plate_number : '';	
	}

	
	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	
	/**
	 * Relations with onother Models
	 */
	public function userParent() 
	{
		return $this->morphOne(Parents::class, 'user');	
	}
	
	public function userEmployee() 
	{
		return $this->morphOne(Employee::class, 'user');	
	}


	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class, 'vehicle_id', 'vehicle_id');	
	}

	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id');	
	}


	public function pickup_location() 
	{
		return $this->hasOne(TripPickup::class, 'trip_id', 'trip_id')->with('location','model')->orderBy('boarding_time', 'asc');	
	}

	public function destinations() 
	{
		return $this->hasMany(TripDestination::class, 'trip_id', 'trip_id')->with('destination','model')->orderBy('dropoff_time', 'asc');	
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

		$totalDistance = 0;
		
		$totalDistance += $this->haversineDistance($this->pickup_latitude, $this->pickup_longitude, $this->destination_latitude, $this->destination_longitude);

		return number_format($totalDistance, 3);
	}

	
    public function model()
    {
        return $this->morphTo();
    }

}