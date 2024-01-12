<?php

namespace Medians\Students\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\PickupLocation;
use Medians\Locations\Domain\Destination;
use Medians\Parents\Domain\Parents;
use Medians\Routes\Domain\Route;
use Medians\Trips\Domain\TripPickup;

class Student extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'students';

    protected $primaryKey = 'student_id';
	
	public $fillable = [
		'business_id',
		'first_name',
		'last_name',
		'picture',
		'date_of_birth',
		'address',
		'parent_id',
		'contact_number',
		'transfer_status',
		'status',
		'gender',
		'created_by'
	];


	public $appends = ['student_name', 'name'];


	public function getNameAttribute() : String
	{
		return $this->first_name .' '.$this->last_name;
	}

	public function getStudentNameAttribute() : String
	{
		return $this->first_name .' '.$this->last_name;
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}


	public function trips() 
	{
    	return $this->hasMany(TripPickup::class, 'model_id', 'student_id')->where('model_type', Student::class)->with('trip');
	}

	public function pickup_location() 
	{
    	return $this->hasOne(PickupLocation::class, 'model_id', 'student_id')->where('model_type', Student::class);
	}

	public function route() 
	{
		return $this->hasOneThrough(Route::class, PickupLocation::class, 'model_id', 'route_id', 'student_id', 'route_id');	
	}

	public function destination() 
	{
    	return $this->hasOne(Destination::class, 'model_id', 'student_id')->where('model_type', Student::class);
	}

	public function parent() 
	{
		return $this->belongsTo(Parents::class, 'parent_id', 'parent_id');
	}

	public function parent_name() 
	{
		return $this->belongsTo(Parents::class, 'parent_id', 'parent_id');
	}
	
	

}
