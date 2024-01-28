<?php

namespace Medians\Plans\Infrastructure;

use Medians\Plans\Domain\Plan;
use Medians\Plans\Domain\PlanFeature;



/**
 * Plan class database queries
 */
class PlanFeatureRepository 
{

	protected $app ;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return PlanFeature::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get() 
	{
		return PlanFeature::with('plan')->get();
	}


	/**
	* Find items by `params` 
	*/
	public function getGrouped() 
	{
		return PlanFeature::with('plan')->groupBy('title')->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new PlanFeature();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = PlanFeature::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PlanFeature::find($data['feature_id']);
		
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
			
			return PlanFeature::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}