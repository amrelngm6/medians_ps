<?php

namespace Medians\Students\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\PickupLocation;
use Medians\Parents\Domain\Parents;

class Student extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'students';

    protected $primaryKey = 'student_id';
	
	public $fillable = [
		'first_name',
		'last_name',
		'picture',
		'date_of_birth',
		'address',
		'parent_id',
		'contact_number',
		'current_school',
		'grade_level',
		'transfer_status',
		'created_by'
	];


	public $appends = ['student_name'];


	public function getStudentNameAttribute() : String
	{
		return $this->first_name .' '.$this->last_name;
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


	public function pickup_location() 
	{
    	return $this->hasOne(PickupLocation::class, 'model_id', 'student_id')->where('model_type', Student::class);
	}

	public function parent() 
	{
		return $this->belongsTo(Parents::class, 'parent_id', 'parent_id');
	}

	

}
