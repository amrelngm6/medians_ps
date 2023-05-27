<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomModel;

/**
 * Plan class database queries
 */
class Plan extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'plans';


	protected $fillable = [
    	'name',
    	'paid',
    	'monthly_cost',
    	'yearly_cost',
    	'created_by',
	];

	// public $timestamps = false;

	// public $appends = ['category_name'];


	public function getFields()
	{
		return $this->fillable;
	}

}
