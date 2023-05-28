<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\Orders\Domain\Order;
use Medians\Devices\Domain\OrderDevice;

class Customer extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'customers';

	public $fillable = [
		'name',
		'mobile',
		'photo',
		'gender',
		'active_branch',
		'created_by',
	];



	public $appends = [ 'photo', 'last_invoice_code', 'not_removeable'];

	public function getLastInvoiceCodeAttribute() : ?String
	{
		return isset($this->last_invoice->code) ? $this->last_invoice->code : '';
	}

	public function getNotRemoveableAttribute() 
	{
		return true;
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			return $q;
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


	public function bookings()
	{
		return $this->hasMany(OrderDevice::class, 'customer_id', 'id');
	}

	public function last_invoice()
	{
		return $this->hasOne(Order::class, 'customer_id', 'id');
	}


}
