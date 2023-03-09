<?php

namespace Medians\Devices\Domain;


use Shared\dbaser\CustomController;

use Medians\Devices\Domain\Device;
use Medians\Games\Domain\Game;
use Medians\Products\Domain\Product;


class OrderDeviceItem extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'order_device_items';

	/**
	* @var Array
	*/
	public $fillable = [
		'model_type',	
		'model_id',	
		'qty',	
		'price',	
		'order_device_id',
		'created_by',
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;

	public $appends = ['subtotal', 'product_name'];


	public function getProductNameAttribute()
	{
		return isset($this->product->name) ? $this->product->name : null;
	}

	public function getSubtotalAttribute()
	{
		return isset($this->price) ? number_format($this->price) * $this->qty : 0;
	}


	/**
	 * Relations
	 */
	public function product()
	{
		return $this->hasOne(Product::class, 'id', 'model_id');
	}




}