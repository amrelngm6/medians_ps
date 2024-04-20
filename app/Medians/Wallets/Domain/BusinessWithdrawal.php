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
		'code',
		'amount',
		'business_id',
		'user_id',
		'user_type',
		'date',
		'due_date',
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
