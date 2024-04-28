<?php

namespace Medians\Settings\Infrastructure;

use Medians\Settings\Domain\Settings;


class SettingsRepository 
{


	protected $app;

	protected $business_id;


	function __construct($business)
	{
		$this->business_id = isset($business->business_id) ? $business->business_id : 0;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) : ?Settings
	{

		return Settings::where('business_id', $this->business_id)->find($id);

	}

	/**
	* Find item by `id` 
	*/
	public function getByCode($code) : ? String
	{
		try {
			
			$check = Settings::where('business_id', $this->business_id)->where('code', $code)->first();
			return isset($check->value) ? $check->value : '';
		} catch (\Exception $e) {
    		throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	* Find all items 
	*/
	public function getAll()
	{
		try {
			return Settings::where('business_id', $this->business_id)->get();

		} catch (\Exception $e) {
    		throw new \Exception($e->getMessage(), 1);
		}
	}


	/**
	* Find all items 
	*/
	public function getBusinessSettings($businessId)
	{
		return Settings::where('business_id', $businessId)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Settings();

    	$Model->firstOrCreate($data);

		// Return the Settings object with the new data
		return $Model;
	}
	

	/**
	* Delete item from database
	*/
	public function delete($code) 
	{
		return Settings::where('business_id', $this->business_id)->where('code', $code)->delete();
	}


	/**
	* Clear item from database
	*/
	public function clear() 
	{
		Settings::where('business_id', $this->business_id)->delete();
		
		return $this;
	}


}
