<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\OrderDevice;

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

			return $q->with('games');

		}])->find($id);

	}



}
