<?php

namespace Medians\Forum\Domain;

use Shared\dbaser\CustomModel;
use Medians\Views\Domain\View;
use Medians\CustomFields\Domain\CustomField;
use Medians\Doctors\Domain\Doctor;
use Medians\Specializations\Domain\Specialization;


class Forum extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'forum';

	public $fillable = [
		'subject', 
		'content', 
		'reply', 
		'doctor_id', 
		'category_id', 
		'customer_name', 
		'customer_email', 
		'customer_phone', 
		'whatsapp_contact', 
		'email_contact', 
		'status', 
	];


	public $appends = ['title','category_name','date', 'update_date'];



	public function getTitleAttribute() 
	{
		return $this->subject;
	}

	public function getCategoryNameAttribute() 
	{
		return !empty($this->category->name) ? $this->category->name : '';
	}

	public function getDateAttribute() : ?String
	{
		return date('M, d Y', strtotime($this->created_at));
	}
	
	public function getUpdateDateAttribute() 
	{
		return isset($this->updated_at) ? date('M, d Y', strtotime($this->updated_at)) : '';
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
		return $this->hasOne(Specialization::class, 'id', 'category_id');
	}

	public function doctor()
	{
		return $this->hasOne(Doctor::class, 'id', 'doctor_id');
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}


	public function comments()
	{
		return $this->hasMany(ForumComment::class, 'item_id', 'id');
	}

	public function views()
	{
		return $this->morphMany(View::class, 'item');
	}

	public function totalviews()
	{
		return $this->morphMany(View::class, 'item');
	}


	public function thumbnail() 
	{
		
    	$return = str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
    	return is_file($return) ? $return : $this->picture;
	}



	public function receiverAsCustomer() 
	{
		return $this;
	}

	public function receiverAsUser() 
	{
		return User::first();
	}

}
