<?php

namespace Medians\Medicines\Domain;

use Shared\dbaser\CustomModel;
use Medians\Views\Domain\View;
use Medians\Content\Domain\Content;
use Medians\Doctors\Domain\Doctor;


class Medicine extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'medicines';

	public $fillable = [
		'title', 
		'prefix', 
		'picture', 
		'category_id', 
		'sorting', 
		'sorting_ar', 
		'status', 
		'inserted_by'
	];


	public $appends = ['photo', 'sort'];


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
