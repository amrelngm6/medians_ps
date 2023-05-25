<?php

namespace Medians\Plans\Infrastructure;

use Medians\Plans\Domain\Plan;



/**
 * Plan class database queries
 */
class PlanRepository 
{

	public $app ;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	public function getModel()
	{
		return new Plan;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Plan::find($id);
	}

	/*
	// Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Plan::get();
	}

	/**
	 * Find items by `params` 
	*/
	public function getItems($params = null) 
	{
		$query = Plan::with('category');

		$query = isset($params['status']) ? $query->where('status', '!=', '0') : $query;

		$query = isset($params['stock']) ? $query->where('stock','>',0) : $query;
		
		return $query->where('branch_id', $this->app->branch->id)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Plan();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Plan::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Plan::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Plan::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}