<?php

namespace Medians\Domain\Orders;


use Shared\dbaser\CustomController;



class OrderItem extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'order_items';

	/**
	* @var Array
	*/
	public $fillable = [
		'branch_id',
		'order_devices_id',
		'model_type',
		'model_id',
		'price',
		'qty',
		'order_code',
		'subtotal',
		'tax',
		'total_cost',
		'created_by',
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;



}
