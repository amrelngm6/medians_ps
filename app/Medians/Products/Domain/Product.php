<?php

namespace Medians\Products\Domain;


use Shared\dbaser\CustomController;

use Medians\Categories\Domain\Category;

/**
 * Product class database queries
 */
class Product extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'products';


	protected $fillable = [
    	'name',
    	'description',
    	'branch_id',
    	'picture',
    	'price',
    	'tax',
    	'stock',
    	'type',
    	'created_by',
    	'status'
	];

	// public $timestamps = false;


	function __construct()
	{

	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function addStock($qty)
	{
		$this->stock = !empty($this->stock) ? (number_format($this->stock) + number_format($qty)) : $qty;

		$this->save();
		
		return $this;
	}

	public function pullStock($qty)
	{
		$this->stock = !empty($this->stock) ? (number_format($this->stock) - number_format($qty)) : 0;
		
		return $this;
	}

	public function categoriesList()
	{
		return Category::byModel(Product::class);
	}

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'type');
	}

	public function stock_log()
	{
		return $this->hasMany(Stock::class, 'product', 'id');
	}

}
