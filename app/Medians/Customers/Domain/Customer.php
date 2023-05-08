<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomController;

class Customer extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'customers';

	public $fillable = [
		'name',
		'mobile',
		'photo',
		'gender',
		'created_by',
	];



	public $appends = [ 'photo'];

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			return $q;
		}, $this->fillable));
	}


	/** 
	 * Render options values
	 */ 
	public function renderOptions($category)
	{
		return (object) array_column(
				array_map(function($q) use ($category) {
					if ($q->category == $category) { return $q; }
				}, (array) json_decode($this->SelectedOption))
			, 'value', 'code');

	}



}
