<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\SuperVisor;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class SuperVisorRepository extends CustomerRepository
{

	 
	

	function __construct()
	{
		
	}

	public function get($limit = 100)
	{
		return SuperVisor::where('model', SuperVisor::class)->limit($limit)->get();
	}


	public function getSuperVisor($supervisor_id)
	{
		return SuperVisor::where('model', SuperVisor::class)->find($supervisor_id);
	}


	/**
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new SuperVisor();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return translate('User not found');
		
		$deleteOld = CustomField::where('model_type', SuperVisor::class)->where('model_id', $findByEmail->supervisor_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = SuperVisor::class;	
		$fields['model_id'] = $findByEmail->supervisor_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $this->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->supervisor_name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);
		$sendMail->sendMail();

		return  1;
    }
    	

	

	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new SuperVisor();
		
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
    	$Object = SuperVisor::create($dataArray);

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

		$Object = SuperVisor::find($data['supervisor_id']);
		
		if ($this->validateEmail($data['email'], $data['supervisor_id']))
		{
			return throw new \Exception(translate('Email found'), 1);
		}

		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    }


    	
    /**
     * Update password
     */
    public function changePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = SuperVisor::find($data['supervisor_id']);
		
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
			
			$delete = SuperVisor::find($id)->delete();

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
				$fields['model_type'] = SuperVisor::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', SuperVisor::class)->where('code',$key)->where('model_id', $id)->delete();
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