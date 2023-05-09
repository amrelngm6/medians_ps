<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Customer;

class CustomerRepository 
{


	public $app;


	function __construct($app = null)
	{
		$this->app = $app;
	}

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
		return Customer::withCount('bookings')->with('last_invoice')->where('created_by', $this->app->auth()->id)->limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Customer();

		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$Model = $Model->firstOrCreate($dataArray);

    	$Model->update($dataArray);
    	
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


			// Return the FBUserInfo object with the new data
	    	$Object->update( (array) $data);
	    	
    		return $Object;	

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}


}
