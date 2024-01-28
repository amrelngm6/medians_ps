<?php

namespace Medians\Students\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\RouteLocation;
use Medians\Customers\Domain\Parents;
use Medians\Routes\Domain\Route;
use Medians\Trips\Domain\TripPickup;
use Medians\Businesses\Domain\Business;

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


	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}

	public function trips() 
	{
    	return $this->hasMany(TripPickup::class, 'model_id', 'student_id')->where('model_type', Student::class)->with('trip');
	}

	public function route_location() 
	{
    	return $this->hasOne(RouteLocation::class, 'model_id', 'student_id')->where('model_type', Student::class);
	}

	public function route() 
	{
		return $this->hasOneThrough(Route::class, RouteLocation::class, 'model_id', 'route_id', 'student_id', 'route_id');	
	}

	public function parent() 
	{
		return $this->belongsTo(Parents::class, 'parent_id', 'customer_id');
	}

	public function parent_name() 
	{
		return $this->belongsTo(Parents::class, 'parent_id', 'customer_id');
	}
	
	

}
