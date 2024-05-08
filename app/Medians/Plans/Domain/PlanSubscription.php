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
    	'type',
    	'business_id',
    	'user_id',
    	'start_date',
    	'end_date',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;

	public $appends = ['is_expired', 'is_paid', 'plan_name','features','past_days','total_days','left_days'];


    public function getIsPaidAttribute()
    {
        return ( isset($this->plan->type) && $this->plan->type == 'paid') ? true : false;
    }

	public function getLeftDaysAttribute()
	{
		$startDate = new \DateTime(date('Y-m-d'));
		$endDate = new \DateTime($this->end_date);
		$interval = $startDate->diff($endDate);
		return $interval->days;
	}

	public function getTotalDaysAttribute()
	{
		$startDate = new \DateTime($this->start_date);
		$endDate = new \DateTime($this->end_date);
		$interval = $startDate->diff($endDate);
		return $interval->days;
	}

	public function getPastDaysAttribute()
	{

		$startDate = new \DateTime($this->start_date);
		$endDate = new \DateTime(date('Y-m-d'));
		$interval = $startDate->diff($endDate);
		return $interval->days;
	}

	public function getPlanNameAttribute()
	{
		return isset($this->plan->name) ? $this->plan->name : '';
	}

	public function getFeaturesAttribute()
	{
		return isset($this->plan->plan_features) ? array_column(json_decode($this->plan->plan_features), 'access', 'code') : '';
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

	public function plan_features()
	{
		return $this->hasMany(PlanFeature::class, 'plan_id', 'plan_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}
	
	public function receiverAsUser() 
	{
		$model =  $this->with('user')->find($this->subscription_idsubscription_id);
		return isset($model->user) ?  $model->user : null;
	}

}
