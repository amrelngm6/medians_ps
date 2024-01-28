<?php

namespace Medians\Plans\Infrastructure;

use Medians\Plans\Domain\Plan;
use Medians\Plans\Domain\PlanSubscription;



/**
 * Plan class database queries
 */
class PlanSubscriptionRepository 
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

		return PlanSubscription::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get() 
	{
		return PlanSubscription::with('user', 'business', 'plan')->get();
	}


	/**
	* Find items by `params` 
	*/
	public function getByBusiness($business_id) 
	{
		return PlanSubscription::where('business_id', $business_id)->get();
	}




	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return PlanSubscription::whereBetween('start_date' , [date('Y-m-d', strtotime($params['start'])) , date('Y-m-d', strtotime($params['end']))])
	  	->limit($limit)
	  	->orderBy('id', 'DESC');
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

		// Return the Model object with the new data
    	$Object = PlanSubscription::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PlanSubscription::find($data['id']);
		
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
			
			return PlanSubscription::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}