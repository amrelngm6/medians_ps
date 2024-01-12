<?php

namespace Medians\Employees\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\PickupLocation;
use Medians\Trips\Domain\TripPickup;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;

class Employee extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'employees';

    protected $primaryKey = 'employee_id';
	
	public $fillable = [
		'business_id',
		'first_name',
		'last_name',
		'picture',
		'contact_number',
		'email',
		'generated_password',
		'password',
		'status',
	];


	public $appends = ['employee_name'];


	public function getEmployeeNameAttribute() : String
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


	public function trip_pickup_location() 
	{
		return $this->hasOne(TripPickup::class, 'employee_id', 'model_id', 'employee_id', 'student_id');	
	}

	public function pickup_location() 
	{
		// return $this->hasOneThrough(PickupLocation::class, Student::class, 'employee_id', 'model_id', 'employee_id', 'student_id');	
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
