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

	protected $primaryKey = 'payment_id';

	/**
	* @var Array
	*/
	public $fillable = [
		'business_id',
		'amount',
		'model_id',
		'model_type',
		'date',
		'payment_method',
		'payment_code',
		'created_by',
	];


	public function getFields()
	{
		return $this->fillable;
	}

	public function plan_subscription()
	{
		return $this->hasOne(PlanSubscription::class, 'subscription_id', 'model_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}


}
