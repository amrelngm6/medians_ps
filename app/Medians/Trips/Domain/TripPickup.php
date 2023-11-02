<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Locations\Domain\PickupLocation;
use Medians\Vehicles\Domain\Vehicle;
use Shared\dbaser\CustomModel;


class TripPickup extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trip_pickups';

    protected $primaryKey = 'trip_pickup_id';
	
	public $fillable = [
		'trip_id',
		'model_type',
		'model_id',
		'pickup_id',
		'status',
		'boarding_time',
		'dropoff_time',
		'created_by'
	];


	public $appends = ['latitude', 'longitude', 'time'];


	public function getTimeAttribute()
	{
		return empty($this->boarding_time) ? '' : date('H:i:s', strtotime($this->boarding_time));
	}

	public function getLatitudeAttribute()
	{
		return isset($this->location->latitude) ? $this->location->latitude : 0;
	}

	public function getLongitudeAttribute()
	{
		return isset($this->location->longitude) ? $this->location->longitude : 0;
	}

	public function location() 
	{
		return $this->hasOne(PickupLocation::class, 'pickup_id', 'pickup_id');	
	}

	public function model() 
	{
		return $this->morphTo();	
	}



}
