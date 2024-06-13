<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\RouteLocation;
use Medians\Trips\Domain\TripLocation;
use Medians\CustomFields\Domain\CustomField;


class Employee extends Customer
{

	public $appends = ['employee_name','field','usertype'];

	public function getUsertypeAttribute()
	{
		return 'employee';
	}

	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

    public function route_locations()
    {
        return $this->morphMany(RouteLocation::class, 'notifiable');
    }

	public function getEmployeeNameAttribute() : String
	{
		return $this->name;
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	
	/**
	 * Relations with onother Models
	 */
	
	
	public function trip_route_location() 
	{
		return $this->hasOne(TripLocation::class, 'employee_id', 'model_id', 'employee_id', 'student_id');	
	}

	public function route_location() 
	{
		return $this->morphOne(RouteLocation::class, 'model', 'model_type', 'model_id');	
	}
	
    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }
	

	/**
	 * Create Custom filed for Session of Employee
	 */
	public function insertCustomField($code, $value)
	{
		$delete = CustomField::where('code', $code)
		->where('model_type', Employee::class)
		->where('model_id', $this->employee_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Employee::class, 
			'model_id'=>$this->employee_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  


}
