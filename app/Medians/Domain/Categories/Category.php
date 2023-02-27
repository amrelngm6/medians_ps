<?php

namespace Medians\Domain\Categories;

use Shared\dbaser\CustomController;

use Medians\Domain\Devices\Device;
use Medians\Domain\Products\Product;

class Category extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'categories';

	public $fillable = [
		'name',
		'branch_id',
		'model',
		'status',
	];


	/**
	 * Disable create & update times fields
	 */ 
	public $timestamps = false;


	public function getFields()
	{
		return $this->fillable;
	}

	public static function byModel($Model)
	{
		return Category::where('model', $Model)->where('status', 'on')->get();
	}


	public function devices()
	{
		return $this->hasMany(Device::class, 'type', 'id');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'type', 'id');
	}

}
