<?php

namespace Medians\Parents\Infrastructure;

use Medians\Parents\Domain\Parents;
use Medians\Parents\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;

class ParentRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public static function getModel()
	{
		return new Parents();
	}


	public function find($parent_id)
	{
		return Parents::find($parent_id);
	}

	public function get($limit = 100)
	{
		return Parents::with('pickup_location')->limit($limit)->get();
	}

	public function checkLogin($email, $password)
	{
		return Parents::where('password', $password)->where('email' , $email)->first();
	}

	public function findByEmail($email)
	{
		return Parents::where('email' , $email)->first();
	}

	public function getParent($parent_id)
	{
		return Parents::with('students', 'pending_student')->find($parent_id);
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

		return Parents::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}


	/**
	 * Check user session by his token
	 */
	public function findByToken($token)
	{
		return Parents::with('custom_fields')->whereHas('custom_fields', function($q) use ($token) {
			$q->where('code','API_token')->where('value',$token);
		})->first();

	}


	/**
	 * Generate random password
	 */
	public function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return 'P'. implode($pass); //turn the array into a string
	}


	/**
	* Save item to database
	*/
	public function resetPassword($data) 
	{

		$Model = new Parents();
		
		$findByEmail = $this->findByEmail($data['email']);

		if (empty($findByEmail))
			return __('User not found');
		
		$deleteOld = CustomField::where('model_type', Parents::class)->where('model_id', $findByEmail->parent_id)->where('code', 'reset_token')->delete();
		
		$fields = [];
		$fields['model_type'] = Parents::class;	
		$fields['model_id'] = $findByEmail->parent_id;	
		$fields['code'] = 'reset_token';	
		$fields['value'] = $this->randomPassword();

		$Model = CustomField::create($fields);
		
		$sendMail = new MailService($findByEmail->email, $findByEmail->parent_name, 'Your token for reset password', "Here is the attached code \n\n ".$fields['value']);

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
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		

		// Return the FBUserInfo object with the new data
    	$Object = Parents::create($dataArray);

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

		$Object = Parents::find($data['parent_id']);
		
		// Return the FBUserInfo object with the new data
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
		CustomField::where('model_type', Parents::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Parents::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
			}
	
			return $Model;		
		}
	}


 
}