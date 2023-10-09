<?php

namespace Medians\Routes\Domain;

use Medians\Locations\Domain\PickupLocation;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;
use Shared\dbaser\CustomModel;


class Route extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'routes';

    protected $primaryKey = 'route_id';
	
	public $fillable = [
		'route_name',
		'description',
		'created_by'
	];


	// public $appends = [];


	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}

	public function pickup_locations() 
	{
		return $this->hasMany(PickupLocation::class, 'route_id', 'route_id')->with('student');	
	}

	public function driver() 
	{
		return $this->hasOneThrough(Driver::class, Vehicle::class, 'driver_id', 'driver_id', 'route_id', 'driver_id');	
	}

}