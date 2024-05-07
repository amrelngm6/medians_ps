<?php

namespace Medians\Routes\Domain;

use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\RouteLocation;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Medians\Customers\Domain\SuperVisor;
use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class Route extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'routes';

    protected $primaryKey = 'route_id';
	
	public $fillable = [
		'business_id',
		'route_name',
		'description',
		'morning_trip_time',
		'afternoon_trip_time',
		'supervisor_id',
		'vehicle_id',
		'driver_id',
		'created_by',
		'status',
	];


	// public $appends = ['position'];


    // // Define an accessor to fetch the driver's name
    // public function getPositionAttribute()
    // {
    //     return $this->route ?? '';
    // }

	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	
	public function trip() 
	{
		return $this->hasOne(Trip::class, 'route_id', 'route_id');	
	}

	public function position()
	{
		return $this->hasOne(RoutePosition::class, 'route_id', 'route_id');
	}

	public function route_locations() 
	{
		return $this->hasMany(RouteLocation::class, 'route_id', 'route_id')->where('status', 'on')->with('model');	
	}


	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id')->with('vehicle');	
	}

	public function supervisor() 
	{
		return $this->hasOne(SuperVisor::class, 'customer_id', 'supervisor_id')->where('model', SuperVisor::class);	
	}

	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class , 'vehicle_id', 'vehicle_id');	
	}

}
