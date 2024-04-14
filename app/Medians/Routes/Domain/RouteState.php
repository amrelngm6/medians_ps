<?php

namespace Medians\Routes\Domain;

use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\RouteLocation;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class RouteState extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'route_states';

    protected $primaryKey = 'route_state_id';
	
	public $fillable = [
		'business_id',
		'route_id',
		'state_id',
		'created_by'
	];



	public function getFields()
	{
		return $this->fillable;
	}


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

	public function route_locations() 
	{
		return $this->hasMany(RouteLocation::class, 'route_id', 'route_id')->where('status', 1)->with('model');	
	}


	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id');	
	}

	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class , 'vehicle_id', 'vehicle_id');	
	}

}
