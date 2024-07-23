<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\RouteLocation;
use Medians\Trips\Domain\TripLocation;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;

use Medians\Wallets\Domain\Wallet;

class Lead extends Customer
{

	public $appends = ['parent_name', 'parent_id','field','usertype'];

	public function getUsertypeAttribute()
	{
		return 'Lead';
	}


	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function getParentIdAttribute() 
	{
		return $this->customer_id;
	}

	public function getParentNameAttribute() : String
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
	

	public function trip_route_location() 
	{
		return $this->hasOneThrough(TripLocation::class, Student::class, 'customer_id', 'model_id', 'customer_id', 'student_id');	
	}

	public function route_location() 
	{
		return $this->hasOneThrough(RouteLocation::class, Student::class, 'parent_id', 'model_id', 'customer_id', 'student_id');	
	}

	public function students() 
	{
    	return $this->hasMany(Student::class, 'parent_id', 'customer_id');
	}

	public function pending_student() 
	{
		return $this->hasOne(Student::class, 'parent_id', 'customer_id')->where('transfer_status', 'Pending')->with('route_location');
	}

	public function wallet() 
	{
        return $this->morphOne(Wallet::class, 'user');
	}

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }



	/**
	 * Create Custom filed for Session of Parent
	 */
	public function insertCustomField($code, $value)
	{
		$delete = CustomField::where('code', $code)
		->where('model_type', Lead::class)
		->where('model_id', $this->customer_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Lead::class, 
			'model_id'=>$this->customer_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  


}