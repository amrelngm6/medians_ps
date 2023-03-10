<?php

namespace Medians\Devices\Infrastructure;

use Medians\Devices\Domain\OrderDevice;

class OrderDevicesRepository
{
 	


	public $app ;


	function __construct()
	{
	}


	/*
	// Find item by `id` 
	*/
	public function find($id)
	{

		return OrderDevice::with('products','game','user')->with(['device'=>function($q){

			return $q->with('games')->with('products');

		}])->find($id)->toArray();

	}



}
