<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Locations\Domain\RouteLocation;
use Medians\Drivers\Domain\Driver;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Customers\Domain\Parents;
use Medians\Students\Domain\Student;

use Shared\dbaser\CustomModel;


class TripLocation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trip_locations';

    protected $primaryKey = 'trip_location_id';
	
	public $fillable = [
		'trip_id',
		'model_type',
		'model_id',
		'location_id',
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

	/**
	 * Relations with onother Models
	 */
	public function location() 
	{
		return $this->hasOne(RouteLocation::class, 'location_id', 'location_id');	
	}

	public function trip() 
	{
		return $this->hasOne(Trip::class, 'trip_id', 'trip_id');	
	}

	public function driver() 
	{
		return $this->hasOneThrough(Driver::class, Trip::class, 'trip_id', 'driver_id', 'trip_id', 'driver_id');	
	}

	public function model() 
	{
		return $this->morphTo();	
	}


    public function receiverAsCustomer()
    {
		$object =  $this->where('model_type', Student::class)->with(['model'=> function($q){ $q->with('parent'); }])->find($this->trip_location_id);
		return  isset($object->model->parent) ? $object->model->parent : null;
    }
	
    public function receiverAsDriver()
    {
		$object =  $this->with('driver')->find($this->trip_location_id);
		return isset($object->driver) ? $object->driver : null;
    }

}
