<?php

namespace Medians\PaymentMethods\Domain;

use Shared\dbaser\CustomModel;

/**
 * Transaction class database queries
 */
class PaymentMethod extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'payment_methods';

    protected $primaryKey = 'payment_method_id';

	protected $fillable = [
    	'name',
		'description',
		'picture',
    	'status',
    	'created_by',
	];



}
