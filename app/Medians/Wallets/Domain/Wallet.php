<?php

namespace Medians\Wallets\Domain;


use Shared\dbaser\CustomModel;


class Wallet extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'wallets';

    protected $primaryKey = 'wallet_id';
	
	public $fillable = [
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
    public function user()
    {
        return $this->morphTo();
    }

}
