<?php

namespace Medians\Devices\Domain;

use Shared\dbaser\CustomModel;
use Medians\Prices\Domain\Prices;
use Medians\Games\Domain\Game;
use Medians\Orders\Domain\Order;
use Medians\Categories\Domain\Category;
use Medians\Products\Domain\Product;

use Medians\Notifications\Domain\NotificationEvent;

class Device extends CustomModel
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


	public $appends = ['picture', 'price', 'name', 'label', 'y','booking_type'];


	public function getLabelAttribute() 
	{
		return $this->name;
	}

	public function getYAttribute() 
	{
		return isset($this->bookings_count) ? $this->bookings_count : 0;
	}
	
	public function getBookingTypeAttribute() 
	{
		// return 'ps';
		return isset($this->current_order->id) ? $this->current_order->booking_type : 'ps';
	}
	
 

 	/**
 	 * Filter fillable fields for frontend requests
 	 */ 
	public function getFields()
	{
		return $this->fillable;
	}



	/**
	 * Relatoins
	 *
	*/
	public function games()
	{
		return  $this->hasMany(DeviceGames::class, 'device_id', 'id');
	}

	/**
	 * Relatoins
	 *
	*/
	public function currentOrder()
	{
		return  $this->hasOne(OrderDevice::class, 'device_id', 'id')->where('status', 'active');
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

	/**
	* Relation 
	*/
	public function active_booking()
	{
		return  $this->hasOne(OrderDevice::class, 'device_id', 'id')->where('status','active')->with('products');
	}

	/**
	* Relation 
	*/
	public function pending_bookings()
	{
		return  $this->hasMany(OrderDevice::class, 'device_id', 'id')->where('status','completed');
	}



	public function products()
	{
		return $this->hasMany(Product::class , 'branch_id' , 'branch_id')->where('stock', '>', 0);
	}





	/**
	* Reports Relation 
	*/
	public function bookings()
	{
		return  $this->hasMany(OrderDevice::class, 'device_id', 'id');
	}


	/**
	* Reports Relation 
	*/
	public function orders()
	{
		return  $this->hasManyThrough(Order::class, OrderDevice::class, 'device_id', 'id', 'id', 'device_id');
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



    /**
     * Handle the event after new item 
     * has been stored 
     * 
     */
    public function createdEvent()
    {
    }  


    /**
     * Handle the event after an item 
     * has been updated 
     * 
     */
    public function updatedEvent()
    {

    	$fields = array_fill_keys($this->fillable,1);
    	$updatedFields = array_intersect_key($fields, $this->getDirty());
    	if (empty($updatedFields))
    		return null;


    	// Insert activation code 
    	return (new NotificationEvent)->handleEvent($this, 'update');

    }  

}
