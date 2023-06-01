<?php

namespace Medians\Users\Infrastructure;

use Medians\Users\Domain\User;
use Medians\CustomFields\Domain\CustomField;


class UserRepository 
{




	public function getModel()
	{
		return new User;
	}

	public function find($id)
	{
		return User::with('Role', 'Plan', 'branch')->find($id);
	}

	public function findItem($id)
	{
		return User::with('Role', 'Plan', 'branch')->find($id);
	}

	public function findByActivationCode($code)
	{
		return User::with('custom_fields')->whereHas('custom_fields', function($q) use ($code) {
			$q->where('code','activation_token')->where('value',$code);
		})->first();
	}

	public function checkDuplicate($param)
	{
		return $this->validateEmail($param['email']);
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

	public function get($limit = 100, $branchId = 0)
	{
		return User::with('Role', 'Plan', 'branch')->where('active_branch', $branchId)->limit($limit)->get();
	}

	public function getAll()
	{
		return User::with('Role', 'Plan', 'branch')->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new User();

		$validateEmail = $this->validateEmail($data['email']);
		if ($validateEmail) {
			return $validateEmail;	
		}

		$Model = $Model->firstOrCreate($data);

    	
    	$data['id'] = $Model->id;
    	$this->checkUpdatePassword($data);

    	/**
		* Set token for activation by User
		*/
		$value = User::encrypt(strtotime(date('YmdHis')).$data['id']);
    	$this->setCustomCode((object) $data, 'activation_token', $value);

		// Return the Model object with the new data
    	return $this->find($Model->id);

	}
	

	/**
	* Update item to database
	*/
	public function update($data) 
	{
		try {
			
			$Object = User::find($data['id']);
			
			if (!$Object) {
				return __('this user not found');	
			}

			$validateEmail = isset($data['email']) ? $this->validateEmail($data['email'], $Object->id) : null;
			if ($validateEmail) {
				return $validateEmail;	
			}

			$data['active'] = isset($data['active']) ? 1 : 0;

			// Return the Model object with the new data
	    	$Object->update( (array) $data);
	    	
	    	$data['id'] = $Object->id;
	    	$this->checkUpdatePassword($data);

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
			$check = User::where('email', $email)->where('id', '!=', $id)->first();
		}

		if (isset($check->id) && $check->id != $id)
		{
			return __('EMAIL_FOUND');
		}
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
			// Return the Model object with the new data
    		$Object->password =  User::encrypt($data['password']);
    		$Object->save();
		}
    	
    	return isset($Object) ? $Object : null;	
	}

	/**
	* Set Custom field for User
	*/
	public function setCustomCode($data, $customCode, $value) 
	{

		$fillable = ['code'=>$customCode,'item_type'=>User::class, 'item_id'=>$data->id, 'value'=>$value];

		CustomField::firstOrCreate($fillable);
	}


}
