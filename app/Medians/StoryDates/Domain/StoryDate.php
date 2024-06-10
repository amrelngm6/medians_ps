<?php

namespace Medians\StoryDates\Domain;

use Shared\dbaser\CustomModel;
use Medians\CustomFields\Domain\CustomField;

class StoryDate extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'story_dates';

	public $fillable = [
		'title', 
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

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}


}
