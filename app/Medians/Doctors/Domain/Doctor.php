<?php

namespace Medians\Doctors\Domain;

use Shared\dbaser\CustomModel;


class Doctor extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'doctors';

	public $fillable = [
		'title', 
		'speciality', 
		'picture', 
		'prefix', 
		'status', 
		'inserted_by'
	];


	public $appends = ['field','content_item'];


	public function getFieldAttribute() 
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'speciality');
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomFields::class, 'model');
	}

	public function content()
	{
		return $this->morphOne(Content::class, 'item')->where('lang', translate('lang'));
	}

	public function getContentItemAttribute()
	{
		return $this->content;
	}


	public function thumbnail() 
	{
    	$file = str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->photo()));

		return is_file($file) ? $file : $this->photo();
		
	}


}
