<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\User;

class UserRepository 
{


	public function getModel()
	{
		return new User;
	}

	public function find($id)
	{
		return User::with('Role')->with('branch')->find($id);
	}

	public function findItem($id)
	{
		return User::with('Role')->with('branch')->find($id);
	}

	public function checkDuplicate($param)
	{
		if (User::where('email', $param['email'])->first())
		{
			return __('Email already found');
		}
	}


	public function getByID($customerId)
	{

		return User::find($customerId);

	}


	public function getByEmail($email)
	{

		return  User::where('email', $email)->first();
	}


	public function checkLogin($email, $password)
	{

		return User::where('password', $password)->where('email' , $email)->first();
	}

	public function get($limit = 100)
	{
		return User::with('Role', 'branch')->limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new User();

		$Model = $Model->firstOrCreate($data);

    	$Model->update($data);
    	
    	$data['id'] = $Model->id;
    	$this->checkUpdatePassword($data);

		// Return the FBUserInfo object with the new data
    	return $Model;

	}
	

	/**
	* Update item to database
	*/
	public function update($data) 
	{
		$Object = User::find($data['id']);
		
		if ($Object)
		{
			// Return the FBUserInfo object with the new data
	    	$Object->update( (array) $data);
	    	
	    	$data['id'] = $Object->id;
	    	$this->checkUpdatePassword($data);
		}

    	return $Object;	
	}

	/**
	* Update item to database
	*/
	public static function checkUpdatePassword($data) 
	{
		if (isset($data['id']))
		{
			$Object = User::find($data['id']);
		}

		if (!empty($data['password']))
		{
			// Return the FBUserInfo object with the new data
    		$Object->password =  User::encrypt($data['password']);
    		$Object->save();
		}
    	
    	return isset($Object) ? $Object : null;	
	}


}
