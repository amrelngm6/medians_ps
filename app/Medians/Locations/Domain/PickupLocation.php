<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Students\Domain\Student;
use Medians\Routes\Domain\Route;


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
		'latitude',
		'longitude',
		'address',
		'status',
		'saturday',
		'sunday',
		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
	];

	public $appends = ['contact_number', 'student_name', 'picture', 'status_text','saturdays','sundays','mondays','tuesdays','wednesdays','thursdays','fridays'];

	public function getSaturdaysAttribute() {
		return !empty($this->saturday) ? true : false;
	}

	public function getSundaysAttribute() {
		return !empty($this->sunday) ? true : false;
	}

	public function getMondaysAttribute() {
		return !empty($this->monday) ? true : false;
	}

	public function getTuesdaysAttribute() {
		return !empty($this->tuesday) ? true : false;
	}

	public function getWednesdaysAttribute() {
		return !empty($this->wednesday) ? true : false;
	}

	public function  getThursdaysAttribute() {
		return !empty($this->thursday) ? true : false;
	}

	public function getFridaysAttribute() {
		return !empty($this->friday) ? true : false;
	}

	public function getStatusTextAttribute() {
		return $this->status == 1 ? 'on' : '';
	}

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

	public function getPictureAttribute() : String
	{
		return !empty($this->student->picture) ? $this->student->picture : '/uploads/images/default_profile.jpg';
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
	
	public function route() 
	{
    	return $this->hasOne(Route::class, 'route_id', 'route_id')->with('driver');
	}
	
	
	
}
