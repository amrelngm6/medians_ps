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
	protected $table = 'trip_pickups';

    protected $primaryKey = 'trip_pickup_id';
	
	public $fillable = [
		'trip_id',
		'pickup_type',
		'pickup_id',
		'status',
		'boarding_time',
		'dropoff_time',
		'created_by'
	];


	// public $appends = [];





}
