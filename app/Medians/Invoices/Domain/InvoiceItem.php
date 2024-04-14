<?php

namespace Medians\Invoices\Domain;


use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;
use Medians\Packages\Domain\PackageSubscription;
use Medians\CustomFields\Domain\CustomField;

class InvoiceItem extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'invoice_items';

	protected $primaryKey = 'invoice_item_id';

	/**
	* @var Array
	*/
	public $fillable = [
		'invoice_id'	
		,'business_id'	
		,'item_id'	
		,'item_type'	
		,'subtotal'	
		,'discount_amount'	
		,'total_amount'	
		,'status'	
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
	
    public function item()
    {
        return $this->morphTo();
    }

	public function business()
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');
	}


}
