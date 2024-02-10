<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Locations\Domain\RouteLocation;
use Medians\Locations\Domain\Destination;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class TripDestination extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trip_destinations';

    protected $primaryKey = 'trip_destination_id';
	
	public $fillable = [
		'trip_id',
		'model_type',
		'model_id',
		'location_id',
		'status',
		'dropoff_time',
		'created_by'
	];


	public $appends = ['latitude', 'longitude', 'time'];


	public function getTimeAttribute()
	{
		return empty($this->dropoff_time) ? '' : date('H:i:s', strtotime($this->dropoff_time));
	}

	public function getLatitudeAttribute()
	{
		return isset($this->destination->latitude) ? $this->destination->latitude : 0;
	}

	public function getLongitudeAttribute()
	{
		return isset($this->destination->longitude) ? $this->destination->longitude : 0;
	}

	
	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}


	public function destination() 
	{
		return $this->hasOne(Destination::class, 'destination_id', 'destination_id');	
	}

	public function student() 
	{
		return $this->hasOne(Student::class, 'student_id', 'model_id');	
	}

	public function parent() 
	{
		return $this->hasOneThrough(Parents::class, Student::class, 'student_id', 'parent_id', 'model_id', 'parent_id');	
	}

	public function model() 
	{
		return $this->morphTo();	
	}



}
