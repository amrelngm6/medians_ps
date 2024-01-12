<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Students\Domain\Student;


class PickupAlarm extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'pickup_alarms';

    protected $primaryKey = 'alarm_id';
	
	public $fillable = [
		'business_id',
		'driver_id',
		'car_id',
		'student_id',
		'trip_id',
		'latitude',
		'longitude',
		'status',
	];


	
}
