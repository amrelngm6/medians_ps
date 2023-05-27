<?php

namespace Medians\Products\Domain;


use Medians\Products\Domain\Product;
use Medians\Users\Domain\User;

use Shared\dbaser\CustomModel;



/**
 * Stock class database queries
 */
class Stock extends CustomModel
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


	public $appends = ['description', 'name', 'user_name'];


	public function getUserNameAttribute()
	{
		return isset($this->user->name) ? $this->user->name : '';
	}

	public function getNameAttribute()
	{
		return isset($this->product->name) ? $this->product->name : '';
	}

	public function getDescriptionAttribute()
	{
		return isset($this->product->description) ? $this->product->description : '';
	}


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

	public function invoice()
	{
		return $this->hasOne(\Medians\Orders\Domain\Order::class, 'id', 'model_id');
	} 

}
