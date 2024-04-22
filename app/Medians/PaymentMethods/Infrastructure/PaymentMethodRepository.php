<?php

namespace Medians\PaymentMethods\Infrastructure;

use Medians\PaymentMethods\Domain\PaymentMethod;
use Medians\PaymentMethods\Domain\PaymentMethodField;



/**
 * PaymentMethod class database queries
 */
class PaymentMethodRepository 
{

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
		return PaymentMethod::with('fields')->get();
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

    	// Store fields
    	!empty($data['fields']) ? $this->storeFields($data['fields'], $Object->payment_method_id) : '';

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = PaymentMethod::Driverfind($data['payment_method_id']);
		
		// Return the Model object with the new data
    	$Object->update( (array) $data);

    	!empty($data['fields']) ? $this->storeFields($data['fields'], $Object->payment_method_id) : '';

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
			
			return PaymentMethod::Driverfind($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	
	/**
	* Save related items to database
	*/
	public function storeFields($data, $id) 
	{
		PaymentMethodField::where('payment_method_id', $id)->delete();

		if ($data)
		{
			foreach ($data as $item )
			{
				foreach ($item as $key => $value) 
				{
					$value = (array) $value;
					$fields = [];
					$fields['payment_method_id'] = $id;	
					$fields['code'] = $value['code'];	
					$fields['title'] = $value['title'];	
					$fields['type'] = $value['type'];	

					$Model = PaymentMethodField::create($fields);
					$Model->update($fields);	
				}
			}
	
			return $Model;		
		}
	}
}