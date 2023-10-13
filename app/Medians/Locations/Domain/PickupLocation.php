<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Students\Domain\Student;


class PickupLocation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'pickup_locations';

    protected $primaryKey = 'pickup_id';
	
	public $fillable = [
		'model_type',
		'model_id',
		'route_id',
		'location_name',
		'location_name',
		'latitude',
		'longitude',
		'address',
	];


	public $appends = ['contact_number', 'student_name'];

	public function getContactNumberAttribute() {
		return isset($this->student->contact_number) ? $this->student->contact_number : '0';
	}

	public function getStudentNameAttribute() {
		return isset($this->student->first_name) ? $this->student->first_name.' '. $this->student->last_name : '0';
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

	
	public function student() 
	{
    	return $this->hasOne(Student::class, 'student_id', 'model_id');
	}
	
	
	
}
