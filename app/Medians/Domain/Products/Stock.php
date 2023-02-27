<?php

namespace Medians\Domain\Products;


use Medians\Domain\Products\Product;
use Medians\Domain\Users\User;

use Shared\dbaser\CustomController;



/**
 * Stock class database queries
 */
class Stock extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'stock';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'product_id',
    	'branch_id',
    	'stock',
    	'type',
    	'date',
    	'created_by',
		'model_type',	
		'model_id',	
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;



	public function getFields()
	{
		return $this->fillable;
	}

	public function product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

}
