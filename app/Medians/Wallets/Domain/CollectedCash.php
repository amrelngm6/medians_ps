<?php

namespace Medians\Wallets\Domain;

use Shared\dbaser\CustomModel;
use Medians\Businesses\Domain\Business;

/**
 * Transaction class database queries
 */
class CollectedCash extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'collected_cash';

    protected $primaryKey = 'collection_cash_id';

	protected $fillable = [
    	'business_id',
    	'wallet_id',
    	'wallet_type',
		'amount',
		'date',
		'status',
	];


	public function business()
    {
        return $this->hasMany(Business::class, 'business_id', 'business_id');
    }

    public function wallet()
    {
        return $this->morphTo();
    }


}
