<?php

namespace Medians\Customers\Infrastructure;

use Medians\Customers\Domain\Parents;
use Medians\Customers\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class ParentRepository  extends CustomerRepository
{

	/**
	 * Business id
	 */ 
	protected $business_id ;


	function __construct($business)
	{
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}


	public function find($customer_id)
	{
		return Parents::where('model', Parents::class)->find($customer_id);
	}

	public function findParentByEmail($email)
	{
		return Parents::where('model', Parents::class)->where( 'email', $email)->first();
	}

	public function get($limit = 100)
	{
		return Parents::where('business_id', $this->business_id)->where('model', Parents::class)->with('route_location', 'students', 'wallet')->limit($limit)->get();
	}

	public function checkLogin($email, $password)
	{
		return Parents::where('model', Parents::class)->where('password', $password)->where('email' , $email)->first();
	}


	public function getParent($customer_id)
	{
		return Parents::where('model', Parents::class)->with(['students'=>function($q){
			$q->withCount('trips')->with('route','route_location');
		}])->with(['pending_student'=> function($q){
			$q->whereDoesntHave('route_location');
		}])
		->with('wallet')
		->find($customer_id);
	}

	/**
	 * Check user session by his token
	 */
	public function findByToken($token, $code = 'API_token')
	{
		return Parents::where('model', Parents::class)->with('custom_fields')->whereHas('custom_fields', function($q) use ($token, $code) {
			$q->where('code', $code)->where('value',$token);
		})->first();
	}
	

	/**
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new Parents();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return translate('User not found');
		
		$deleteOld = CustomField::where('model_type', Parents::class)->where('model_id', $findByEmail->customer_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = Parents::class;	
		$fields['model_id'] = $findByEmail->customer_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $this->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->parent_name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);
		$sendMail->sendMail();

		return  1;
    }
    	

	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Parents();
		
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
    	$Object = Parents::create($dataArray);

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

		$Object = Parents::find($data['customer_id']);
		
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

		$Object = Parents::find($data['customer_id']);
		
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
			
			$delete = Parents::find($id)->delete();

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
				$fields['model_type'] = Parents::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Parents::class)->where('code',$key)->where('model_id', $id)->delete();
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