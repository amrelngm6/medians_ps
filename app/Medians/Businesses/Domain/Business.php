<?php

namespace Medians\Businesses\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Routes\Domain\Route;
use Medians\Drivers\Domain\Driver;
use Medians\Packages\Domain\Package;
use Medians\Settings\Domain\Settings;
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
	
	public $append = ['owner'];

	public function getOwnerAttribute ()
	{
		return isset($this->owner_user) ? $this->owner_user : null;
	}

	public function getFields()
	{
		return $this->fillable;
	}

    public function owner_user()
    {
		return $this->hasOne(User::class, 'id', 'user_id');	
    }

    public function subscription()
    {
		return $this->hasOne(PlanSubscription::class, 'business_id', 'business_id')->with('plan')->orderBy('end_date', 'DESC');	
    }

    public function drivers()
    {
		return $this->hasMany(Driver::class, 'business_id', 'business_id');	
    }

    public function packages()
    {
		return $this->hasMany(Package::class, 'business_id', 'business_id');	
    }

    public function routes()
    {
		return $this->hasMany(Route::class, 'business_id', 'business_id');	
    }

    public function locations()
    {
		return $this->hasMany(RouteLocation::class, 'business_id', 'business_id');	
    }

    public function settings()
    {
		return $this->hasMany(Settings::class, 'business_id', 'business_id');	
    }

}
