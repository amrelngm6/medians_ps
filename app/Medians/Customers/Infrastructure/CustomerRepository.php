<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Customer;

class CustomerRepository 
{


	public $app;


	function __construct()
	{
		$this->app = new \config\APP;;
	}

	public function getModel()
	{
		return new Customer;
	}

	public function search($mobile)
	{
		return Customer::where('mobile', 'LIKE', '%'.$mobile.'%')->where('active_branch', $this->app->branch->id)->limit(10)->get();
	}


	public function get($limit = 100)
	{
		return Customer::withCount('bookings')->with('last_invoice')->where('active_branch', $this->app->branch->id)->limit($limit)->get();
	}



	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return Customer::whereBetween('created_at' , [$params['start'] , $params['end']])
	  	->limit($limit)
	  	->orderBy('id', 'DESC');
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

		// Return the Model object with the new data
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


			// Return the Model object with the new data
	    	$Object->update( (array) $data);
	    	
    		return $Object;	

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}


}
