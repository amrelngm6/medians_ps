<?php

namespace Medians\Vehicles\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;
use Medians\Businesses\Domain\Business;


class Vehicle extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vehicles';

    protected $primaryKey = 'vehicle_id';
	
	public $fillable = [
		'business_id',
		'vehicle_name',
		'maintenance_status',
		'capacity',
		'picture',
		'plate_number',
		'type_id',
		'last_latitude',
		'last_longitude',
		'created_by'
	];


	public $appends = ['latitude', 'longitude'];

	public function getLatitudeAttribute()
	{
		return $this->last_latitude;
	}
	public function getLongitudeAttribute()
	{
		return $this->last_longitude;
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}


	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}


	public function type() 
	{
		return $this->hasOne(VehicleType::class, 'type_id', 'type_id');	
	}
}
