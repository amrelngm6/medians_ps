<?php

namespace Medians\PaymentMethods\Infrastructure;

use Medians\PaymentMethods\Domain\PaymentMethod;



/**
 * PaymentMethod class database queries
 */
class PaymentMethodRepository 
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

		return PaymentMethod::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return PaymentMethod::where('business_id', $this->business_id)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new PaymentMethod();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = PaymentMethod::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PaymentMethod::where('business_id', $this->business_id)->find($data['payment_method_id']);
		
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
			
			return PaymentMethod::where('business_id', $this->business_id)->find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}