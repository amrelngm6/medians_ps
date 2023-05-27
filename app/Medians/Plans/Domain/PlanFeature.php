<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomModel;


/**
 * PlanFeature class database queries
 */
class PlanFeature extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'plan_features';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'plan_id',
    	'code',
    	'access',
    	'created_by',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;

	public $appends = ['plan_name', 'access_value'];


	public  function getAccessValueAttribute()
	{
		if ($this->access > 0)
			return $this->access;

		if ($this->access < 0)
			return __('unlimited');

		if ($this->access == 0)
			return __('not_available'); 
	}

	public  function getPlanNameAttribute()
	{
		return isset($this->plan->name) ? $this->plan->name : '';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class, 'plan_id', 'id');
	}


}
