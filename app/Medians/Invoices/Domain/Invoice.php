<?php

namespace Medians\Invoices\Domain;


use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\CustomFields\Domain\CustomField;
use Medians\Transactions\Domain\Transaction;

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
		'code'	
		,'user_id'	
		,'user_type'	
		,'payment_method'	
		,'subtotal'	
		,'discount_amount'	
		,'total_amount'	
		,'date'	
		,'status'	
		,'notes'
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
	
    public function user()
    {
        return $this->morphTo();
    }


	public function items()
	{
		return $this->hasMany(InvoiceItem::class, 'invoice_id', 'invoice_id')->with('item');
	}

	public function item()
	{
		return $this->hasOne(InvoiceItem::class, 'invoice_id', 'invoice_id')->with('item');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'invoice_id', 'invoice_id');
	}

	public function transaction()
	{
		return $this->hasOne(Transaction::class, 'invoice_id', 'invoice_id');
	}


}
