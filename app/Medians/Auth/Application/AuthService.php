<?php

namespace Medians\Auth\Application;


use Medians\Branches\Application\BranchController;

use Medians\Auth\Domain\AuthModel;



class AuthService 
{

	/**
	 * Minimum length of the user password
	 * 
	 * @var Int
	*/
	private $passLen = 5;

	/**
	* @var Instance AuthModel
	*/
	private $AuthModel;

	/**
	* @var Instance Repo
	*/
	private $repo;



	function __construct()
	{

		$this->repo = new \Medians\Users\Infrastructure\UserRepository();
	}


	/**
	 * Display login page 
	 */
	public function loginPage()
	{

		$this->app = new \config\APP;
		
		if (isset($this->app->auth()->id)) { return $this->app->redirect('/'); }

	    return  render('login', [
	    	'load_vue' => true,
	        'title' => __('Login page'),
	        'app' => $this->app,
	        'formAction' => '/login',
	    ]);
	}


	public function userLogin()
	{
		$this->app = new \config\APP;
		
        $requestData = $this->app->request()->get('params');

        try {
            
            $checkUser = $this->checkLogin($requestData['email'], $this->encrypt($requestData['password']));

            if (!empty($checkUser->id))
            {
                $this->setSession($checkUser);
            	echo json_encode(array('success'=>1, 'result'=>__('Logged in'), 'redirect'=>$this->app->CONF['url']));

            } else {
	            echo json_encode(array('error'=>$checkUser));
            }


        } catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
        	
        }
	}

	/**
	 * Check login credentials
	 * 
	 * @return Object / String 
	 */ 
	public function checkLogin($email, $password)
	{

		$checkLogin = $this->repo->checkLogin($email, $password);

		if (empty($checkLogin->id))
		{
            return __("User credentials not valid");
		}

		if (empty($checkLogin->active))
		{
			return __("User account is not active");
			
		}

		return $checkLogin;
	}


	/**
	 * Validate the password length
	 * 
	 */ 
	public function validatePassword($password)
	{
		if (strlen($password) < $this->passLen)
		{
			throw new \Exception("Password length must be $this->passLen at least ", 1);
		}

	} 


	/**
	 * Check session is valid or not 
	 * 
	 * @return ? AuthModel
	 */ 
	public function checkSession($code = null) 
	{
		$this->AuthModel = new AuthModel($code);

		if (!empty ( $this->AuthModel->checkSession($code) ))
		{
			return $this->repo->find($this->AuthModel->checkSession($code));
		}
	}



	/**
	 * Set session  
	 */ 
	public function setSession($data, $code = null) 
	{

		$this->AuthModel = new AuthModel($code);

		if ($this->AuthModel->setData($data)) 
		{
			return $this->AuthModel->checkSession($code);
		}
	}


	/**
	 * Clear session after logout
	 */ 
	public function unsetSession() 
	{
		
		$this->AuthModel = new AuthModel();
		return $this->AuthModel->unsetSession();
	}

	/**
	 * Encryption algoritm for password storage
	 */ 
	public static function encrypt($value) : String 
	{
		return sha1(md5($value));

	}









}
