<?php

namespace Medians\Drivers\Domain;

use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
use Shared\dbaser\CustomModel;


class Driver extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'drivers';

    protected $primaryKey = 'driver_id';
	
	public $fillable = [
		// 'driver_id',
		'first_name',
		'last_name',
		'picture',
		'driver_license_number',
		'vehicle_plate_number',
		'email',
		'contact_number',
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


	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class, 'driver_id', 'driver_id')->with('route');	
	}



}
