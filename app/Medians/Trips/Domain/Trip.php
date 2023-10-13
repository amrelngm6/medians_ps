<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
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
		'route_id',
		'supervisor_id',
		'trip_date',
		'trip_status',
		'created_by'
	];


	// public $appends = [];



	public function route() 
	{
		return $this->hasOne(Route::class, 'route_id', 'route_id')->with('pickup_locations');	
	}

	public function pickup_locations() 
	{
		return $this->hasOne(TripPickup::class, 'pickup_id', 'pickup_id')->with('location');	
	}


}
