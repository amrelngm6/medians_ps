<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Agent;
use Medians\Customers\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class AgentRepository  extends CustomerRepository
{

	 
	


	function __construct()
	{
		
	}


	public function find($customer_id)
	{
		return Agent::where('model', Agent::class)->find($customer_id);
	}

	public function findAgentByEmail($email)
	{
		return Agent::where('model', Agent::class)->where( 'email', $email)->first();
	}

	public function get($limit = 100)
	{
		return Agent::where('model', Agent::class)->limit($limit)->get();
	}

	public function checkLogin($email, $password)
	{
		return Agent::where('model', Agent::class)->where('password', $password)->where('email' , $email)->first();
	}


	public function getAgent($customer_id)
	{
		return Agent::find($customer_id);
	}

	/**
	 * Check user session by his token
	 */
	public function findByToken($token, $code = 'API_token')
	{
		return Agent::where('model', Agent::class)->with('custom_fields')->whereHas('custom_fields', function($q) use ($token, $code) {
			$q->where('code', $code)->where('value',$token);
		})->first();
	}
	

	/**
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new Agent();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return translate('User not found');
		
		$deleteOld = CustomField::where('model_type', Agent::class)->where('model_id', $findByEmail->customer_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = Agent::class;	
		$fields['model_id'] = $findByEmail->customer_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $this->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);
		$send  = $sendMail->sendMail();

		return  $send;
    }
    	

	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Agent();
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$data['generated_password'] = $this->randomPassword();
		$data['password'] = $Auth->encrypt($data['generated_password']);
		$data['model'] = $Model::class;
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Agent::firstOrCreate($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->customer_id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Agent::find($data['customer_id']);
		
		if (isset($data['email']) && $this->validateEmail($data['email'], $data['customer_id']))
		{
			return throw new \Exception(translate('Email found'), 1);
		}

		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->customer_id);

    	return $Object;

    }

    	
    /**
     * Update password
     */
    public function changePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = Agent::find($data['customer_id']);
		
		$current = $Auth->encrypt($data['current_password']);

		if (!$this->checkLogin($Object->email, $current))
		{
			return translate('PASSWORD_ERROR');
		}

		$data['password'] = $Auth->encrypt($data['new_password']);

		// Return the  object with the new data
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
			
			$delete = Agent::find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Agent::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Agent::class)->where('code',$key)->where('model_id', $id)->delete();
					foreach ($value as $k => $v) {
						$Model = CustomField::firstOrCreate($fields);
						$Model->update(['value'=>$v]);
					}
				} else {
					$Model = CustomField::firstOrCreate($fields);
					$Model->update(['value'=>$value]);
				}
			}
	
			return $Model;		
		}
	}


 
}