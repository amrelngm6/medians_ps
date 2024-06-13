<?php

namespace Medians\Routes\Domain;

use Medians\Trips\Domain\Trip;
use Medians\Locations\Domain\RouteLocation;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Drivers\Domain\Driver;

use Shared\dbaser\CustomModel;


class RoutePosition extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'route_position';

    protected $primaryKey = 'position_id';
	
	public $fillable = [

		'route_id',
        'start_address',
        'start_state',
		'start_latitude',
		'start_longitude',
		'end_address',
		'end_latitude',
		'end_longitude',
        'end_state',
        'created_by'
	];

	public $appends = ['end_location', 'start_location'];

	public function getEndLocationAttribute()
	{
		return null;
	}

	public function getStartLocationAttribute()
	{
		return null;
	}

	public function getFields()
	{
		return $this->fillable;
	}


	/**
	 * Relations with onother Models
	 */
	
	
	public function route() 
	{
		return $this->hasOne(Route::class, 'route_id', 'route_id');	
	}


}
