<?php

namespace Medians\Invoices\Domain;


use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;
use Medians\Packages\Domain\PackageSubscription;
use Medians\CustomFields\Domain\CustomField;

class Invoice extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'invoices';

	protected $primaryKey = 'invoice_id';

	/**
	* @var Array
	*/
	public $fillable = [
		'invoice_id'	
		,'business_id'	
		,'code'	
		,'model_id'	
		,'model_type'	
		,'payment_method'	
		,'subtotal'	
		,'discount_amount'	
		,'total_amount'	
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


	public function getFields()
	{
		return $this->fillable;
	}
	
    public function model()
    {
        return $this->morphTo();
    }

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}


}
