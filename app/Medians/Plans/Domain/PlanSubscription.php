<?php

namespace Medians\Plans\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;

/**
 * PlanSubscriber class database queries
 */
class PlanSubscription extends CustomModel
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

	protected $appends = ['is_expired', 'branch_name', 'user_name', 'plan_name', ];


	public function getUserNameAttribute()
	{
		return isset($this->user->name) ? $this->user->name : '';
	}

	public function getBranchNameAttribute()
	{
		return isset($this->branch->name) ? $this->branch->name : '';
	}
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
		return $this->belongsTo(Plan::class, 'plan_id', 'id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	public function branch()
	{
		return $this->hasOne(Branch::class, 'id', 'branch_id');
	}

}
