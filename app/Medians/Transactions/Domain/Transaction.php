<?php

namespace Medians\Transactions\Domain;


use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;
use Medians\Packages\Domain\PackageSubscription;
use Medians\CustomFields\Domain\CustomField;

class Transaction extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'transactions';

	protected $primaryKey = 'transaction_id';

	/**
	* @var Array
	*/
	public $fillable = [
		'transaction_id'	
		,'business_id'	
		,'subscription_id'	
		,'model_id'	
		,'model_type'	
		,'item_id'	
		,'item_type'	
		,'payment_method'	
		,'amount'	
		,'date'	
		,'status'	
		,'notes'
		,'created_by'
	];

	public $appends = ['field'];

	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}

	public function package_subscription()
	{
		return $this->hasOne(PackageSubscription::class, 'subscription_id', 'subscription_id');
	}

	public function getFields()
	{
		return $this->fillable;
	}
	
    public function model()
    {
        return $this->morphTo();
    }

    public function item()
    {
        return $this->morphTo();
    }

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}


}
