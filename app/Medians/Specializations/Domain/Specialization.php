<?php

namespace Medians\Specializations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Views\Domain\View;
use Medians\Content\Domain\Content;
use Medians\Doctors\Domain\Doctor;


class Specialization extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'specialization';

	public $fillable = [
		'title', 
		'prefix', 
		'picture', 
		'category_id', 
		'parent_id', 
		'sorting', 
		'sorting_ar', 
		'status', 
		'inserted_by'
	];


	public $appends = ['photo', 'parent_name', 'sort'];


	public function getParentNameAttribute() : ?String
	{
		return isset($this->parent->title) ? $this->parent->title : '';
	}

	public function getSortAttribute() 
	{
		return translate('lang') == 'en' ? $this->sorting : $this->sorting_ar;
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return $this->fillable;
	}


	public function childs()
	{
		return $this->hasMany(Specialization::class, 'parent_id', 'id')->orderBy('sorting','ASC');
	}


	public function parent()
	{
		return $this->hasOne(Specialization::class, 'id', 'parent_id');
	}

	public function lang_content()
	{
		return $this->morphOne(Content::class, 'item')->where('lang',$_SESSION['lang']);
	}

	public function views()
	{
		return $this->morphMany(View::class, 'item');
	}

	
	public function totalviews()
	{
		return $this->morphMany(View::class, 'item')->sum('times');
	}
	
	public function author()
	{
		return $this->hasOne(Doctor::class, 'id', 'inserted_by');
	}

}
