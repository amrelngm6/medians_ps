<?php

namespace Medians\Students\Domain;

use Shared\dbaser\CustomModel;


class Student extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'students';

    protected $primaryKey = 'student_id';
	
	public $fillable = [
		// 'student_id',
		'first_name',
		'last_name',
		'date_of_birth',
		'address',
		'parent_guardian_name',
		'contact_number',
		'current_school',
		'grade_level',
		'transfer_status',
		'created_by'
	];


	// public $appends = [];


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



}