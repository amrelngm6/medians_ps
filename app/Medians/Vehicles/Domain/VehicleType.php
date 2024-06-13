<?php

namespace Medians\Vehicles\Domain;

use Shared\dbaser\CustomModel;
use Medians\Routes\Domain\Route;



class VehicleType extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vehicle_types';

    protected $primaryKey = 'type_id';
	
	public $fillable = [

		'name',
		'status',
		'created_by'
	];


	/**
	 * Relations with onother Models
	 */
	


	public function vehicles() 
	{
		return $this->hasOne(Vehicle::class, 'type_id', 'type_id');	
	}
}
