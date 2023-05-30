<?php

namespace Medians\Users\Domain;

use Medians\Branches\Domain\Branch as branchModel;

use Medians\Plans\Domain\Plan;
use Medians\Plans\Domain\PlanSubscription;

class Branch extends branchModel
{

	public $appends = ['features'];

	public function getFeaturesAttribute()
	{
		return isset($this->plan->plan_features)
		? (object) array_column( $this->plan->plan_features->toArray(), 'access', 'code')
		: [];
	}


	public function Plan() 
	{
		return $this->hasOneThrough(Plan::class, PlanSubscription::class, 'branch_id', 'id', 'id', 'plan_id')->orderBy('id', 'DESC')->with('plan_features');
	}
	

}
