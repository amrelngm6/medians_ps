<?php

namespace Medians\Devices\Domain;

use Shared\dbaser\CustomController;
use Medians\Prices\Domain\Prices;
use Medians\Games\Domain\Game;
use Medians\Orders\Domain\OrderDevice;
use Medians\Categories\Domain\Category;
use Medians\Products\Domain\Product;


class Device extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'devices';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'title',
    	'branch_id',
    	'playing',
    	'type',
    	'status'
	];


	public $appends = ['picture', 'price', 'name'];
 

 	/**
 	 * Filter fillable fields for frontend requests
 	 */ 
	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			if (!in_array($q, array('model_type' ,'model_id')))
			{
				return $q;
			}
		}, $this->fillable));
	}



	/** 
	 * Render options values
	 */ 
	public function renderOptions($category)
	{
		return (object) array_column(
				array_map(function($q) use ($category) {
					if ($q->category == $category) { return $q; }
				}, (array) json_decode($this->SelectedOption))
			, 'value', 'code');

	}


	/** 
	 * Render options values
	 */ 
	public function renderFields($category)
	{
		return array_column(Options::where('model', Property::class)->where('category', $category)->get()->toArray(), 'title', 'code');
	}




	/**
	 * Relatoins
	 *
	*/
	public function games()
	{
		return  $this->hasMany(Game::class, 'category', 'type');
	}

	/**
	 * Relatoins
	 *
	*/
	public function currentOrder()
	{
		return  $this->hasOne(DeviceOrder::class, 'deviceId', 'id')->where('status', 'active');
	}



	/**
	* Relation 
	*/
	public function prices()
	{
		return  $this->MorphMany(Prices::class, 'model');
	}


	/**
	* Relation 
	*/
	public function category()
	{
		return  $this->hasOne(Category::class, 'id', 'type')->where('model', Device::class);
	}


	/**
	* Relation 
	*/
	public function order()
	{
		return  $this->hasOne(OrderDevice::class, 'device_id', 'id')->where('status','active')->where('model', Device::class);
	}



	public function products()
	{
		return $this->hasMany(Product::class , 'branch_id' , 'branch_id');
	}



	

	public function getPictureAttribute()
	{
		return 'default.png';
	}
	public function getNameAttribute()
	{
		return $this->title;
	}
	public function getPriceAttribute()
	{
		return (object) array_column( (array) json_decode($this->prices), 'value', 'code');
	}

}
