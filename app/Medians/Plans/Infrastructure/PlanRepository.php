<?php

namespace Medians\Plans\Infrastructure;

use Medians\Plans\Domain\Plan;



/**
 * Plan class database queries
 */
class PlanRepository 
{

	protected $app ;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	public function getModel()
	{
		return new Plan;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return Plan::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Plan::get();
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

		// Return the Model object with the new data
    	$Object = Plan::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Plan::find($data['plan_id']);
		
		// Return the Model object with the new data
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