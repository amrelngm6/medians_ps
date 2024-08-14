<?php

namespace Medians\Visits\Domain;


use Shared\dbaser\CustomModel;

class Visit extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'visits';


	protected $fillable = [
    	'item_type',
    	'item_id',
    	'ip',
    	'date',
    	'country',
	];

	public $appends = ['class'];

	public function getClassAttribute()
	{
		$itemType = explode("\\", $this->item_type);
		return $itemType ? end($itemType) : '';
	}

	public function item()
	{
		return $this->morphTo();
	}

}
