<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Shared\dbaser\CustomModel;


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
		'trip_date',
		'trip_status',
		'created_by'
	];


	public $appends = ['driver_name', 'car_plate'];



	public function getDriverNameAtribute() 
	{
		return isset($this->driver->first_name) ? $this->driver->first_name. ' ' .$this->driver->last_name : '';	
	}

	public function getCarPlateAtribute() 
	{
		return isset($this->car->plate_number) ? $this->car->plate_number : '';	
	}

	public function route() 
	{
		return $this->hasOne(Route::class, 'route_id', 'route_id')->with('pickup_locations');	
	}


	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class, 'vehicle_id', 'vehicle_id');	
	}

	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id');	
	}


	public function pickup_locations() 
	{
		return $this->hasMany(TripPickup::class, 'trip_id', 'trip_id')->with('location')->orderBy('boarding_time', 'asc');	
	}

	public function waiting_locations() 
	{
		return $this->hasMany(TripPickup::class, 'trip_id', 'trip_id')->where('status', 'waiting');	
	}

	public function moving_locations() 
	{
		return $this->hasMany(TripPickup::class, 'trip_id', 'trip_id')->where('status', 'moving');	
	}


}
