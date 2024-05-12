<?php

namespace Medians\Shipping\Domain;

use Shared\dbaser\CustomModel;


class Shipping extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'shipping';

    protected $primaryKey = 'shipping_id';

	public $fillable = [
		'name',
		'days',
		'price',
		'status',
	];



	public function getFields()
	{
		return $this->fillable;
	}

}
