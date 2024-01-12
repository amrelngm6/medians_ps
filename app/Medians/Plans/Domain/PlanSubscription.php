<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Businesses\Domain\Business;

/**
 * PlanSubscriber class database queries
 */
class PlanSubscription extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'plan_subscriptions';

	protected $primaryKey = 'subscription_id';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'plan_id',
    	'business_id',
    	'user_id',
    	'start_date',
    	'end_date',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;

	protected $appends = ['is_expired', 'plan_name'];


	public function getPlanNameAttribute()
	{
		return isset($this->plan->name) ? $this->plan->name : '';
	}


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
		return $this->hasOne(Plan::class, 'plan_id', 'plan_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}

}
