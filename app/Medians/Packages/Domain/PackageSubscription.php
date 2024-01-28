<?php

namespace Medians\Packages\Domain;

use Shared\dbaser\CustomModel;

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
    	'business_id',
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

    public $appends = ['is_paid','usertype'];

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

}
