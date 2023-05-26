<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomController;


/**
 * PlanSubscriber class database queries
 */
class PlanSubscription extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'plan_subscriptions';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'plan_id',
    	'branch_id',
    	'user_id',
    	'start_date',
    	'end_date',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;

	public $appends = ['is_expired'];


	public  function getIsExpiredAttribute()
	{
		return (strtotime($this->end_date) > strtotime(date('Y-m-d')))  ? false : true; 
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
