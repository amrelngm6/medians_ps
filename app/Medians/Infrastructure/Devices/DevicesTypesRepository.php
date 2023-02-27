<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\DeviceType;


class DevicesTypesRepository 
{



	function __construct()
	{
	}


	/*
	// Find item by `id` 
	*/

	public function find($deviceTypeId)
	{
		return DeviceType::find($deviceTypeId);
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  DeviceType::all();
	}

	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new DeviceType();
		$Model->title = $data['title'];		
    	$Model->publish = $data['publish'];		
    	$Model->save();

		// Return the DeviceType object with the new data
		return $Model;
	}

	/**
	* Update item to database
	*/
	public function edit($data) 
	{

		$Model = DeviceType::find($data['id']);
		$Model->title = $data['title'];		
    	$Model->save();

		// Return the object with the new data
		return $Model;	
	}


	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return DeviceType::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}
