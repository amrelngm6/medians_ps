<?php

namespace Medians\Payments\Domain;


use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;
use Medians\Plans\Domain\PlanSubscription;

class Payment extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'payments';

	/**
	* @var Array
	*/
	public $fillable = [
		'branch_id',
		'amount',
		'model_id',
		'model_type',
		'date',
		'payment_method',
		'payment_id',
		'created_by',
	];

	public $appends = ['user_name', 'branch_name', 'model_name'];


	public function getModelNameAttribute()
	{
		return ($this->model_type == PlanSubscription::class && isset($this->plan_subscription->plan->name)) ? $this->plan_subscription->plan->name : '';
	}

	public function getUserNameAttribute()
	{
		return isset($this->user->name) ? $this->user->name : '';
	}

	public function getBranchNameAttribute()
	{
		return isset($this->branch->name) ? $this->branch->name : '';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function plan_subscription()
	{
		return $this->hasOne(PlanSubscription::class, 'id', 'model_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function branch()
	{
		return $this->hasOne(Branch::class, 'id', 'branch_id');
	}


}
