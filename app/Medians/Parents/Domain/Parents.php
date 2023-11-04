<?php

namespace Medians\Parents\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\PickupLocation;
use Medians\Students\Domain\Student;

class Parents extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'parents';

    protected $primaryKey = 'parent_id';
	
	public $fillable = [
		'first_name',
		'last_name',
		'picture',
		'contact_number',
		'email',
		'generated_password',
		'password',
		'status',
	];


	public $appends = ['parent_name'];


	public function getParentNameAttribute() : String
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
    	return $this->hasOne(PickupLocation::class, 'model_id', 'student_id')->where('model_type', Parents::class);
	}

	public function students() 
	{
    	return $this->hasOne(Student::class, 'parent_id', 'parent_id');
	}


	

}
