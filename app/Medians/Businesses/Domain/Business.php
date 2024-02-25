<?php

namespace Medians\Businesses\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Routes\Domain\Route;
use Medians\Drivers\Domain\Driver;
use Medians\Locations\Domain\RouteLocation;
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

    public function drivers()
    {
		return $this->hasMany(Driver::class, 'business_id', 'business_id');	
    }

    public function routes()
    {
		return $this->hasMany(Route::class, 'business_id', 'business_id');	
    }

    public function locations()
    {
		return $this->hasMany(RouteLocation::class, 'business_id', 'business_id');	
    }

}
