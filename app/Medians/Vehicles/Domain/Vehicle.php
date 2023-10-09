<?php

namespace Medians\Vehicles\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;


class Vehicle extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vehicles';

    protected $primaryKey = 'vehicle_id';
	
	public $fillable = [
		'vehicle_name',
		'maintenance_status',
		'capacity',
		'picture',
		'plate_number',
		'vehicle_type',
		'driver_id',
		'route_id',
		'last_latitude',
		'last_longitude',
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


	public function route() 
	{
		return $this->hasOne(Route::class, 'route_id', 'route_id')->with('pickup_locations');	
	}

}