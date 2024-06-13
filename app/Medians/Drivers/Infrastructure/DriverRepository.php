<?php

namespace Medians\Drivers\Infrastructure;

use Medians\Drivers\Domain\Driver;
use Medians\Drivers\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;


use Illuminate\Database\Capsule\Manager as Capsule;

class DriverRepository 
{


	 
	



	function __construct()
	{
		

		
	}


	public function find($id)
	{
		return Driver::with('vehicle','route','wallet')->find($id);
	}

	public function getDriver($id)
	{
		return Driver::with('trip','wallet')->with(['last_trips'=>function($q){
			return $q->limit(3);
		}])->find($id);
	}

	public function get($limit = 100)
	{
		return Driver::limit($limit)->orderBy('driver_id', 'DESC')->get();
	}

	public function getActive($limit = 100)
	{
		return Driver::where('status', 'on')->limit($limit)->with('vehicle')->orderBy('driver_id', 'DESC')->get();
	}

	public function getAll($limit = 100)
	{
		return Driver::with('last_trips','help_messages')->withCount('total_pickups')->limit($limit)->orderBy('driver_id', 'DESC')->get();
	}

	public function topDrivers($limit = 100)
	{
		return Driver::withCount('last_trips')->having('last_trips_count', '>', 0)->orderBy('last_trips_count', 'DESC')->limit($limit)->get();
	}

	
	/**
	 * Get the most used devices
	 */ 
	public function mostTrips($params, $limit = 5)
	{

		return  Driver::withCount(['last_trips as y'=>function($q)use($params){
			if (isset($params['start']))
			{
				$q->whereBetween('start_time' , [$params['start'] , $params['end']]);
			}
		}])
		->selectRaw('first_name as label')
		->having('y', '>', 0)
		->orderBy('y', 'desc')
		->limit($limit)
		->get();
	}

	public function checkLogin($email, $password)
	{
		return Driver::where('password', $password)->where('email' , $email)->first();
	}

	public function findByEmail($email)
	{
		return Driver::where('email' , $email)->first();
	}



	/**
	 * Check user session by his token
	 */
	public function findByToken($token, $code = 'API_token')
	{
		return Driver::with('custom_fields')->whereHas('custom_fields', function($q) use ($token, $code) {
			$q->where('code', $code)->where('value',$token);
		})->first();

	}

    /**
     * Update password
     */
    public function changePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = Driver::find($data['driver_id']);
		
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
     * Reset & Update password 
     */
    public function resetChangePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = $this->findByToken($data['reset_token'], 'reset_token');
		
		$newPassword = $Auth->encrypt($data['password']);

		if (!$Object)
		{
			return translate('PASSWORD_ERROR');
		}

		$data['password'] = $newPassword;

		// Return the  object with the new data
		$Object->update( (array) $data);

    	return $Object;
    }


	/**
	* Reset user password
	*/
	public function resetPassword($data) 
	{

		$Model = new Driver();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return translate('User not found');
		
		$deleteOld = CustomField::where('model_type', Driver::class)->where('model_id', $findByEmail->driver_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = Driver::class;	
		$fields['model_id'] = $findByEmail->driver_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $Model->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);
		$sendMail->sendMail();

		return  1;
    }
    	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Driver();
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$data['generated_password'] = $Model->randomPassword();
		$data['password'] = $Auth->encrypt($data['generated_password']);
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Driver::create($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
	
	/**
	* Save item to database
	*/
	public function signup($data) 
	{

		$Model = new Driver();
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$data['generated_password'] = $Model->randomPassword();
		$data['password'] = $Auth->encrypt($data['generated_password']);
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		
		// Return the  object with the new data
    	return  Driver::create($dataArray);
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Driver::find($data['driver_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['driver_id']) : '';

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
			
			/**
			 * Soft-Delete
			 * Remove the Driver
			 */
			$delete = Driver::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	* validate Email 
	*/
	public function validateEmail($email, $id = 0) 
	{
		if (!empty($email))
		{
			$check = Driver::where('email', $email)->where('driver_id', '!=', $id)->first();
		}

		return  (empty($check)) ? null : translate('EMAIL_FOUND');
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
				$fields['model_type'] = Driver::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Driver::class)->where('code',$key)->where('model_id', $id)->delete();
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