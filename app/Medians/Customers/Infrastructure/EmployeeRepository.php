<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Employee;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class EmployeeRepository extends CustomerRepository
{

	/**
	 * Business id
	 */ 
	protected $business_id ;

	function __construct($business)
	{
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}

	public function get($limit = 100)
	{
		return Employee::where('model', Employee::class)->where('business_id', $this->business_id)->with('route_location', 'business')->limit($limit)->get();
	}


	public function getEmployee($employee_id)
	{
		return Employee::where('model', Employee::class)->where('business_id', $this->business_id)->find($employee_id);
	}


	/**
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new Employee();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return translate('User not found');
		
		$deleteOld = CustomField::where('model_type', Employee::class)->where('model_id', $findByEmail->employee_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = Employee::class;	
		$fields['model_id'] = $findByEmail->employee_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $this->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->employee_name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);
		$sendMail->sendMail();

		return  1;
    }
    	

	

	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Employee();
		
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
    	$Object = Employee::create($dataArray);

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

		$Object = Employee::where('business_id', $this->business_id)->find($data['customer_id']);
		
		if ($this->validateEmail($data['email'], $data['customer_id']))
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

		$Object = Employee::find($data['employee_id']);
		
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
			
			$delete = Employee::where('business_id', $this->business_id)->find($id)->delete();

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
				$fields['model_type'] = Employee::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Employee::class)->where('code',$key)->where('model_id', $id)->delete();
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