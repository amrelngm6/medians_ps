<?php

namespace Medians\Devices\Domain;


use Shared\dbaser\CustomModel;

use Medians\Devices\Domain\Device;
use Medians\Games\Domain\Game;
use Medians\Products\Domain\Product;
use Medians\Users\Domain\User;
use Medians\Customers\Domain\Customer;
use Medians\Branches\Domain\Branch;


class OrderDevice extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'order_devices';

	/**
	* @var Array
	*/
	public $fillable = [
		'branch_id',	
		'customer_id',	
		'device_id',	
		'game_id',	
		'device_cost',	
		'order_code',	
		'booking_type',	
		'start_time',	
		'break_time',	
		'end_time',	
		'last_check',	
		'created_by',	
		'status'
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;

	public $appends = ['title', 'duration', 'duration_time', 'currency', 'subtotal', 'products_subtotal', 'total_cost', 'duration_hours','date', 'end_time_validated', 'duration_now', 'subtotal_now'];



	public function getEndTimeValidatedAttribute()
	{
		return ($this->end_time != '0000-00-00 00:00:00') ? $this->end_time : date('Y-m-d H:i:s');
	}
	public function getTitleAttribute()
	{
		return isset($this->device->title) ? $this->device->title : '';
	}
	public function getDateAttribute()
	{
		return substr($this->created_at, 0, 10);
	}

	public function getTotalCostAttribute()
	{
		return (isset($this->subtotal) && isset($this->products_subtotal) ) ? ($this->products_subtotal+$this->subtotal) : $this->subtotal;
	}

	public function getCurrencyAttribute() 
	{
		return 'EGP';
	}

	public function getDurationAttribute() 
	{
		return round(abs(strtotime($this->end_time_validated) - strtotime($this->start_time)) / 60, 2);
	}

	public function getDurationHoursAttribute() 
	{
		return number_format($this->duration / 60, 2);
	}


	/**
	 * Get subtotal for the booking
	 */ 
	public function getSubtotalAttribute() 
	{
        return round(number_format($this->device_cost) * $this->duration_hours, 2) ;
	}


	/**
	 * Get subtotal for purchased products
	 */ 
	public function getProductsSubtotalAttribute() 
	{
        return round($this->products->sum(function ($model) {
    return $model->price * $model->qty;
}), 2) ;
	}



	public function getDurationTimeAttribute() 
	{
		$interval = (new \DateTime($this->start_time ))->diff(new \DateTime($this->end_time_validated));
		$hours   = $interval->format('%H:%I'); 
		return $hours;
	}

	public function getDurationNowAttribute() 
	{
		$interval =  (new \DateTime($this->start_time ))->diff(new \DateTime());
		$hours   = $interval->format('%H:%I'); 
		return $hours;
	}

	public function getSubtotalNowAttribute() 
	{
        return round(number_format($this->device_cost) * number_format(round(abs(strtotime(date("Y-m-d H:i:s")) - strtotime($this->start_time)) / 60, 2) / 60, 2), 2) ;
	}




	/**
	 * Relations
	 */
	public function customer()
	{
		return $this->hasOne(Customer::class, 'id', 'customer_id');
	}

	/**
	 * Relations
	 */
	public function device()
	{
		return $this->hasOne(Device::class, 'id', 'device_id');
	}

	/**
	 * Relations
	 */
	public function products()
	{
		return $this->hasMany(OrderDeviceItem::class, 'order_device_id', 'id')->where('model_type', Product::class)->with('product');
	}


	/**
	 * Relations
	 */
	public function game()
	{
		return $this->hasOne(Game::class, 'id', 'game_id');
	}


	/**
	 * Relations
	 */
	public function user()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}


	/**
	 * Relations
	 */
	public function branch()
	{
		return $this->hasOne(Branch::class, 'id', 'created_by');
	}



}
