<?php

namespace Medians\Wallets\Domain;

use Shared\dbaser\CustomModel;


/**
 * Transaction class database queries
 */
class CollectedCash extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'collected_cash';

    protected $primaryKey = 'collection_id';

	protected $fillable = [
    	'wallet_id',
    	'wallet_type',
		'amount',
		'currency_code',
		'date',
		'notes',
		'created_by',
	];



    public function wallet()
    {
        return $this->morphTo();
    }


}
