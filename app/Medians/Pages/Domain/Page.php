<?php

namespace Medians\Pages\Domain;

use Shared\dbaser\CustomModel;

use Medians\Content\Domain\Content;
use Medians\CustomFields\Domain\CustomField;

class Page extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'pages';

    protected $primaryKey = 'page_id';

	public $fillable = [
		'title', 
		'prefix', 
		'homepage', 
		'status', 
		'created_by', 
	];


	public $appends = ['photo','field','name', 'data','show_header_menu','show_footer_menu1','show_footer_menu2'];



	public function getShowHeaderMenuAttribute() 
	{
		return isset($this->field['show_header_menu']) ? $this->field['show_header_menu'] : null;
	}

	public function getShowFooterMenu1Attribute() 
	{
		return isset($this->field['show_footer_menu1']) ? $this->field['show_footer_menu1'] : null;
	}

	public function getShowFooterMenu2Attribute() 
	{
		return isset($this->field['show_footer_menu2']) ? $this->field['show_footer_menu2'] : null;
	}


	public function getDataAttribute() 
	{
		return isset($this->content->content) ? $this->content->content : ''; 
	}

	public function getFieldAttribute() 
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function getNameAttribute() : ?String
	{
		return isset($this->content->title) ? $this->content->title : $this->title;
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function content()
	{
		return $this->hasOne(Content::class, 'item_id', 'page_id')->where('item_type', Page::class)->where('lang',$_SESSION['lang']);
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}




}
