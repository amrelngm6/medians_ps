<?php

namespace Medians\Auth\Application;


use Medians\Branches\Application\BranchController;

use Medians\Auth\Domain\AuthModel;



class AuthService 
{

	/*
	/ @var Int
	*/
	private $passLen = 5;

	/*
	/ @var String
	*/
	private $email;

	/*
	/ @var String
	*/
	private $password ;

	/*
	/ @var CustomerModel
	*/
	private $AuthModel;

	/*
	/ @var Instance
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

	    return  render('views/admin/forms/login.html.twig', [
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

	public function checkLogin($email, $password)
	{


		$checkLogin = $this->repo->checkLogin($email, $password);

		if (empty($checkLogin->id))
		{
            return __("User credentials not valid");

			// throw new \Exception(, 1);
		}

		if (empty($checkLogin->active))
		{
			return __("User account is not active");
			
		}

		return $checkLogin;
	}


	public function validatePassword($password)
	{
		if (strlen($password) < $this->passLen)
		{
			throw new \Exception("Password length must be $this->passLen at least ", 1);
		}

	} 


	public function checkSession($code = null) 
	{
		$AuthModel = new AuthModel($code);

		if (!empty ( $AuthModel->checkSession($code) ))
		{
			return $this->repo->find($AuthModel->checkSession($code));
		}
	}



	public function setSession($data, $code = null) 
	{

		$AuthModel = new AuthModel($code);

		if ($AuthModel->setData($data)) 
		{
			return $AuthModel->checkSession($code);
		}
	}


	public function unsetSession() 
	{
		
		$AuthModel = new AuthModel();
		return $AuthModel->unsetSession();
	}


	public static function encrypt($value) : String 
	{
		return sha1(md5($value));

	}









}
