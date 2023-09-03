<?php

namespace Medians\Bookings\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;


class Booking extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'booking';

	public $fillable = [
		'class', 
		'itemid', 
		'branch_id', 
		'status	', 
	];



	public $appends = ['field', 'title', 'date','name', 'mobile', 'full_mobile', 'email' ];


	public function getDateAttribute() 
	{
		return isset($this->created_at) ? date('Y-m-d', strtotime($this->created_at)) : '';
	}

	public function getMobileAttribute() 
	{
		return isset($this->field['mobile']) ? $this->field['mobile'] : '';
	}

	public function getEmailAttribute() 
	{
		return isset($this->field['email']) ? $this->field['email'] : '';
	}

	public function getFullMobileAttribute() 
	{
		$code = isset($this->field['mobile_key']) ? $this->field['mobile_key'] : '';
		$num = isset($this->field['mobile']) ? $this->field['mobile'] : '';
		return $code.$num;
	}

	public function getNameAttribute() 
	{
		return isset($this->field['name']) ? $this->field['name'] : '';
	}

	public function getFieldAttribute() 
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function getTitleAttribute() 
	{
		return  isset($this->consultation->doctor_name) 
		? $this->consultation->doctor_name 
		: (isset($this->offer->title) ? $this->offer->title : '');
		  
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'item');
	}

	public function consultation()
	{
		return $this->hasOne(\Medians\OnlineConsultations\Domain\OnlineConsultation::class, 'id', 'itemid');
	}

	public function offer()
	{
		return $this->hasOne(\Medians\Offers\Domain\Offer::class, 'id', 'itemid');
	}


}
