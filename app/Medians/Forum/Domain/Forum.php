<?php

namespace Medians\Forum\Domain;

use Shared\dbaser\CustomModel;
use Medians\Views\Domain\View;
use Medians\CustomFields\Domain\CustomField;
use Medians\Doctors\Domain\Doctor;


class Forum extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'forum';

	public $fillable = [
		'subject', 
		'content', 
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
		return !empty($this->content->title) ? $this->content->title : '';
	}

	public function getCategoryNameAttribute() 
	{
		return !empty($this->category->name) ? $this->category->name : '';
	}

	public function getDateAttribute() : ?String
	{
		return date('Y-m-d', strtotime($this->created_at));
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
		return $this->hasOne(Category::getClass(), 'category_id', 'category_id')->with('content');
	}

	public function author()
	{
		return $this->hasOne(Doctor::class, 'id', 'created_by');
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}

	public function content()
	{
		return $this->morphOne(Content::class, 'item')->where('lang', translate('lang'));
	}

	public function views()
	{
		return $this->morphMany(View::class, 'item');
	}

	public function totalviews()
	{
		return $this->morphMany(View::class, 'item')->sum('times');
	}


	public function thumbnail() 
	{
		
    	$return = str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
    	return is_file($return) ? $return : $this->picture;
	}



}
