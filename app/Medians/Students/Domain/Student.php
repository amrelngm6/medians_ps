<?php

namespace Medians\Students\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\RouteLocation;
use Medians\Customers\Domain\Parents;
use Medians\Routes\Domain\Route;
use Medians\Trips\Domain\TripLocation;
use Medians\Businesses\Domain\Business;
use Medians\Packages\Domain\PackageSubscription;
use Medians\CustomFields\Domain\CustomField;

class Student extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'students';

    protected $primaryKey = 'student_id';
	
	public $fillable = [
		'parent_id',
		'business_id',
		'name',
		'mobile',
		'picture',
		'birth_date',
		'transfer_status',
		'gender',
		'status',
		'created_by'
	];

	public $appends = ['field','usertype'];

	public function getUsertypeAttribute()
	{
		return 'student';
	}

	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
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

	public function subscription() 
	{
		return $this->morphOne(PackageSubscription::class, 'model')->with('package','business','applicant')->orderBy('created_at','DESC');	
	}

	public function trips() 
	{
    	return $this->hasMany(TripLocation::class, 'model_id', 'student_id')->where('model_type', Student::class)->with('trip');
	}

	public function route_location() 
	{
    	return $this->hasOne(RouteLocation::class, 'model_id', 'student_id')->where('model_type', Student::class)->with('route');
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
