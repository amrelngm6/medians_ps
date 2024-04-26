<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Customer;

class CustomerRepository 
{


	protected $app;


	/**
	* Find all items between two days 
	*/
	public function masterByDateCount($params )
	{
	  	return Customer::whereBetween('created_at' , [$params['start'] , $params['end']])->count();
	}



	public function getClassName()
	{
		return Customer::class;
	}

	public function findByEmail($email)
	{
		return Customer::where('email' , $email)->first();
	}

	
	/**
	 * Check user session by his token
	 */
	public function findByToken($token, $code = 'API_token')
	{
		return Customer::with('custom_fields')->whereHas('custom_fields', function($q) use ($token, $code) {
			$q->where('code', $code)->where('value',$token);
		})->first();
	}

	/**
	 * Login with email & password 
	 */	
	public function checkLogin($email, $password)
	{
		return Customer::where('password', $password)->where('email' , $email)->first();
	}


	/**
	 * Generate random password
	 */
	public function randomPassword() {
		$alphabet = '12345678900';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}


    /**
     * Reset & Update password 
     */
    public function resetChangePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = $this->findByToken($data['reset_token'], 'reset_token');
		
		if (!$Object)
		{
			return translate('Sent token is not valid');
		}

		$newPassword = $Auth->encrypt($data['password']);

		// Return the  object with the new data
    	$Object->update( ['password'=> $newPassword]);

    	return $Object;
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
			
			$Object = Customer::find($data['customer_id']);
			
			if (!$Object) {
				return translate('this user not found');	
			}


			// Return the Model object with the new data
	    	$Object->update( (array) $data);
	    	
    		return $Object;	

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	
	/**
	* validate Email 
	*/
	public function validateEmail($email, $id = 0) 
	{
		if (!empty($email))
		{
			$check = Customer::where('email', $email)->where('customer_id', '!=', $id)->first();
		}

		return  (empty($check)) ? null : translate('EMAIL_FOUND');
	}


}
