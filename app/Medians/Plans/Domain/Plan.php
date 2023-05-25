<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomController;

/**
 * Plan class database queries
 */
class Plan extends CustomController
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
