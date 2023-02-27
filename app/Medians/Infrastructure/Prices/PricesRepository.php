<?php

namespace Medians\Infrastructure\Prices;

use Medians\Domain\Prices\Prices;



class PricesRepository 
{




	/*
	// Find item by `id` 
	*/
	public function find($id)
	{

		return Prices::find($id);

	}


	/*
	// Find item by `branch` 
	*/
	public function getByDevice($deviceId)
	{
		return Prices::where('device', $deviceId)->first();
	}



	/*
	// Save item to database
	*/
	public function store($data) : Prices
	{

		// Return the  object with the new data
		return Prices::create($data);
	}


	/*
	// Update item to database
	*/
	public function edit($object) : Prices
	{

		$object->save();

		// Return the  object with the new data
		return Prices::find($object->id);
	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
