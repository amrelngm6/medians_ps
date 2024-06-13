<?php

namespace Medians\Packages\Domain;

use Shared\dbaser\CustomModel;

use Medians\Customers\Domain\StudentApplicant;

/**
 * Subscription class database queries
 */
class PackageSubscription extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'package_subscriptions';

    protected $primaryKey = 'subscription_id';

	protected $fillable = [
    	'package_id',
		'model_id',
		'model_type',
        'start_date',
        'end_date',
        'payment_type',
        'payment_status',
    	'daily_trips',
        'total_cost',
        'notes',
    	'created_by',
	];

    public $appends = ['is_paid','usertype','name'];

    public function getNameAttribute()
    {
        return isset($this->package->name) ? $this->package->name : '';
    }

    public function getIsPaidAttribute()
    {
        return $this->payment_status == 'paid' ? true : null;
    }

	public function getUsertypeAttribute() {
		$parts = explode('\\', $this->model_type);
		return strtolower(end($parts));
	}

    public function model()
    {
        return $this->morphTo();
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'package_id', 'package_id');
    }

    public function applicant()
    {
        return $this->hasOne(StudentApplicant::class, 'subscription_id', 'subscription_id');
    }

}
