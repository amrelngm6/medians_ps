<?php

namespace Medians\Employees\Infrastructure;

use Medians\Employees\Domain\Employee;
use Medians\Employees\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class EmployeeRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public static function getModel()
	{
		return new Employee();
	}


	public function find($employee_id)
	{
		return Employee::find($employee_id);
	}

	public function get($limit = 100)
	{
		return Employee::with('pickup_location', 'students')->limit($limit)->get();
	}

	public function checkLogin($email, $password)
	{
		return Employee::where('password', $password)->where('email' , $email)->first();
	}

	public function findByEmail($email)
	{
		return Employee::where('email' , $email)->first();
	}

	public function getEmployee($employee_id)
	{
		return Employee::with(['students'=>function($q){
			$q->withCount('trips')->with('route');
		}])->with(['pending_student'=> function($q){
			$q->whereDoesntHave('pickup_location')->orWhereDoesntHave('destination');
		}])->find($employee_id);
	}

	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Employee::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}


	/**
	 * Check user session by his token
	 */
	public function findByToken($token, $code = 'API_token')
	{
		return Employee::with('custom_fields')->whereHas('custom_fields', function($q) use ($token, $code) {
			$q->where('code', $code)->where('value',$token);
		})->first();
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
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new Employee();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return __('User not found');
		
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
     * Reset & Update password 
     */
    public function resetChangePassword($data)
    {
		$Auth = new \Medians\Auth\Application\AuthService;

		$Object = $this->findByToken($data['reset_token'], 'reset_token');
		
		if (!$Object)
		{
			return __('Sent toen is not valid');
		}

		$newPassword = $Auth->encrypt($data['password']);

		// Return the  object with the new data
    	$Object->update( ['password'=> $newPassword]);

    	return $Object;
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
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		

		// Return the  object with the new data
    	$Object = Employee::create($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Employee::find($data['employee_id']);
		
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

		$Object = Employee::find($data['employee_id']);
		
		$current = $Auth->encrypt($data['current_password']);

		if (!$this->checkLogin($Object->email, $current))
		{
			return __('PASSWORD_ERROR');
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
			
			$delete = Employee::find($id)->delete();

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