<?php

namespace Medians\Templates\Domain;

use Shared\dbaser\CustomModel;

use Medians\Content\Domain\Content;
use Medians\Menus\Domain\Menu;
use Medians\CustomFields\Domain\CustomField;

class EmailTemplate extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'email_templates';

    protected $primaryKey = 'email_template_id';

	public $fillable = [
		'title', 
		'status', 
		'created_by', 
	];


	public function content()
	{
		return $this->hasOne(Content::class, 'item_id', 'page_id')->where('item_type', EmailTemplate::class)->where('lang',$_SESSION['lang']);
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}




}
