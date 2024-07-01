<?php

namespace Medians\Stories\Domain;

use Shared\dbaser\CustomModel;
use Medians\CustomFields\Domain\CustomField;

class Story extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'stories';

	public $fillable = [
		'title', 
		'category_id', 
		'picture', 
		'status', 
		'inserted_by'
	];

	public $appends = ['field'];

	public function getFieldAttribute() 
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}

	public function thumbnail() 
	{
    	$return = str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
    	return is_file($return) ? $return : $this->picture;
	}



}
