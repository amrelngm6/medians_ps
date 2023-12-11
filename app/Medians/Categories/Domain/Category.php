<?php

namespace Medians\Categories\Domain;

use Shared\dbaser\CustomModel;

use Medians\Devices\Domain\Device;
use Medians\Products\Domain\Product;

class Category extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'categories';

	public $fillable = [
		'name',
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
