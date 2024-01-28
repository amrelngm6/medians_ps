<?php

namespace Medians\Vehicles\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;
use Medians\Businesses\Domain\Business;


class VehicleType extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vehicle_types';

    protected $primaryKey = 'type_id';
	
	public $fillable = [
		'business_id',
		'name',
		'status',
		'created_by'
	];


	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}


	public function vehicles() 
	{
		return $this->hasOne(Vehicle::class, 'type_id', 'type_id');	
	}
}
