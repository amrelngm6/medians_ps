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

    protected $primaryKey = 'plan_id';

	protected $fillable = [
    	'name',
    	'type',
    	'monthly_cost',
    	'yearly_cost',
    	'created_by',
    	'status',
	];

	// public $timestamps = false;

	// protected $appends = ['features'];


	// public function getFeaturesAttribute()
	// {
	// 	return (object) array_column( $this->plan_features->toArray(), 'access', 'code');
	// }

	public function getFields()
	{
		return $this->fillable;
	}


	public function plan_features()
	{
		return $this->hasMany(PlanFeature::class, 'plan_id', 'id');
	}

}
