<?php

namespace Medians\Wallets\Domain;

use Shared\dbaser\CustomModel;
use Medians\Businesses\Domain\Business;
use Medians\CustomFields\Domain\CustomField;


class Withdrawal extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'withdrawals';

    protected $primaryKey = 'withdrawal_id';
	
	public $fillable = [
		'amount',
		'business_id',
		'wallet_id',
		'user_id',
		'user_type',
		'date',
		'due_date',
		'payment_method',
		'status',
		'business_notes',
		'user_notes',
	];


	public $appends = ['field'];

	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	/**
	 * Relations with onother Models
	 */	
    public function user()
    {
        return $this->morphTo();
    }

	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}

	public function wallet() 
	{
		return $this->hasOne(Wallet::class, 'wallet_id', 'wallet_id');	
	}

	public function custom_fields()
	{
		return $this->morphMany(CustomField::class, 'model');
	}


}
