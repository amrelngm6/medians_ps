<?php

namespace Medians\Payments\Domain;


use Shared\dbaser\CustomController;

use Medians\Users\Domain\User;

class Payment extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'payments';

	/**
	* @var Array
	*/
	public $fillable = [
		'branch_id',
		'name',
		'date',
		'notes',
		'picture',
		'invoice_id',
		'amount',
		'created_by'
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;


	public $appends = ['user_name'];


	public function getUserNameAttribute()
	{
		return isset($this->user->name) ? $this->user->name : '';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}


	public function addPayment(Array $params)
	{
		$fields = $this->fillable;
		$data = [];
		foreach ($fields as $field) 
		{
			$data[$field] = isset($params[$field]) ? $params[$field] : null;
		}

		$payment = Payment::create($data)->update([$data]);

		return $payment; 
	}


}
