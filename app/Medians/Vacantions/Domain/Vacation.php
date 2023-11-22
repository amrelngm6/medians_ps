<?php

namespace Medians\Vacations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Students\Domain\Student;

class Vacation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vacations';

    protected $primaryKey = 'vacation_id';
	
	public $fillable = [
		'title',
		'date',
		'student_id',
		'student_type',
	];

	public $appends = ['student_name', 'last_update'];

	public function getStudentNameAttribute()
	{
		return $this->student->student_name;
	}

	public function getLastUpdateAttribute()
	{
		return date('Y-m-d H:i', strtotime($this->updated_at));
	}
	
	public function getFields()
	{
		return $this->fillable;
	}
	
	public function student()
	{
		return $this->hasOne(Student::class, 'student_id','student_id');
	}
	
	
	
}
