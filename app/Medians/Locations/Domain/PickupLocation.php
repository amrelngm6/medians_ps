<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;


class PickupLocation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'pickup_locations';

    protected $primaryKey = 'pickup_id';
	
	public $fillable = [
		'location_name',
		'latitude',
		'longtude',
		'address',
	];


	public $appends = ['latitude'];


	public function getLatitudeAttribute()
	{
		return  floatval($this->latitude);
	}

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


}
