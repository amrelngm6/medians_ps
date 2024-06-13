<?php

namespace Medians\Packages\Domain;

use Shared\dbaser\CustomModel;

/**
 * Subscription class database queries
 */
class Package extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'packages';

    protected $primaryKey = 'package_id';

	protected $fillable = [
		'name',
		'description',
		'single_cost_month',
		'single_cost_quarter',
		'single_cost_year',
		'double_cost_month',
		'double_cost_quarter',
		'double_cost_year',
    	'status',
    	'created_by',
	];



}
