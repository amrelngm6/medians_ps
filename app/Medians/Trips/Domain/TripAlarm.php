<?php

namespace Medians\Trips\Domain;

use Medians\Routes\Domain\Route;
use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\RouteLocation;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Customers\Domain\Parents;
use Medians\Students\Domain\Student;
use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class TripAlarm extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trip_alarms';

    protected $primaryKey = 'alarm_id';
	
	public $fillable = [
		'business_id',
		'trip_id',
		'model_type',
		'model_id',
	];


	public $appends = ['time'];


	public function getTimeAttribute()
	{
		return empty($this->created_at) ? '' : date('H:i:s', strtotime($this->created_at));
	}


	/**
	 * Relations with onother Models
	 */
	public function trip() 
	{
		return $this->hasOne(Trip::class, 'trip_id', 'trip_id');	
	}

	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}

	public function model() 
	{
		return $this->morphTo();	
	}


    public function receiverAsParent()
    {
		$Object = $this->whereHas('model')->with('model')->find($this->alarm_id);
        return isset($Object->model->parent) ? $Object->model->parent : null;
    }


}
