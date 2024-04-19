<?php

namespace Medians\Wallets\Domain;

use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class Wallet extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'wallets';

    protected $primaryKey = 'wallet_id';
	
	public $fillable = [
		'business_id',
		'code',
		'credit_balance',
		'debit_balance',
		'user_id',
		'user_type',
		'status',
	];


	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	

	
    public function user()
    {
        return $this->morphTo();
    }

}
