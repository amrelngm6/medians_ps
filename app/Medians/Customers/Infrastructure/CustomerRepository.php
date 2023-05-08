<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Customer;

class CustomerRepository 
{


	public function getModel()
	{
		return new Customer;
	}

	public function search($mobile)
	{
		return Customer::where('mobile', 'LIKE', '%'.$mobile.'%')->limit(10)->get();
	}


	public function get($limit = 100)
	{
		return Customer::limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Customer();

		$Model = $Model->firstOrCreate($data);

    	$Model->update($data);
    	
		// Return the FBUserInfo object with the new data
    	return $Model;

	}
	

	/**
	* Update item to database
	*/
	public function update($data) 
	{
		try {
			
			$Object = Customer::find($data['id']);
			
			if (!$Object) {
				return __('this user not found');	
			}


			$data['active'] = isset($data['active']) ? 1 : 0;

			// Return the FBUserInfo object with the new data
	    	$Object->update( (array) $data);
	    	
    		return $Object;	

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}


}
