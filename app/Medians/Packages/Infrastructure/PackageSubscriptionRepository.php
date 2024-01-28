<?php

namespace Medians\Packages\Infrastructure;

use Medians\Packages\Domain\PackageSubscription;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Employee;
use Medians\Customers\Domain\SuperVisor;


/**
 * PackageSubscription class database queries
 */
class PackageSubscriptionRepository 
{

	
	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business ;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return PackageSubscription::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return PackageSubscription::with('model','package')->where('business_id', $this->business_id)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$data['model_type'] = $this->handleClassType($data['usertype']);

		$Model = new PackageSubscription();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = PackageSubscription::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	 * Update Lead
	 */
	public function handleClassType($data)
	{

		if (strtolower($data) == 'employee')
			return Employee::class;
	
		if (strtolower($data) == 'student')
			return Student::class;
	
		if (strtolower($data) == 'supervisor')
			return SuperVisor::class;

	}
	
	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PackageSubscription::where('business_id', $this->business_id)->find($data['subscription_id']);
		
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
			
			return PackageSubscription::where('business_id', $this->business_id)->find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}