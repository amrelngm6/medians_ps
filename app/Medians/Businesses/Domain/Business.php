<?php

namespace Medians\Businesses\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Plans\Domain\PlanSubscription;


class Business extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'businesses';

    protected $primaryKey = 'business_id';
	
	public $fillable = [
		'business_name',
		'type',
		'status',
		'user_id',
	];
	

	public function getFields()
	{
		return $this->fillable;
	}

    public function subscription()
    {
		return $this->hasOne(PlanSubscription::class, 'business_id', 'business_id')->with('plan')->orderBy('end_date', 'DESC');	
    }

}