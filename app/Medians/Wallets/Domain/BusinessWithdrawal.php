<?php

namespace Medians\Wallets\Domain;

use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class BusinessWithdrawal extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'business_withdrawals';

    protected $primaryKey = 'withdrawal_id';
	
	public $fillable = [
		'amount',
		'business_id',
		'wallet_id',
		'date',
		'due_date',
		'payment_method',
		'status',
	];


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
	

}
