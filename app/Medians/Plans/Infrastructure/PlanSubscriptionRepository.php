<?php

namespace Medians\Plans\Infrastructure;

use Medians\Plans\Domain\Plan;
use Medians\Plans\Domain\PlanSubscription;



/**
 * Plan class database queries
 */
class PlanSubscriptionRepository 
{

	public $app ;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	public function getModel()
	{
		return new PlanSubscription;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return PlanSubscription::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return PlanSubscription::get();
	}

	/**
	* Find items by `params` 
	*/
	public function getByBranch($branch_id) 
	{
		return PlanSubscription::where('branch_id', $branch_id)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new PlanSubscription();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = PlanSubscription::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PlanSubscription::find($data['id']);
		
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
			
			return PlanSubscription::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}