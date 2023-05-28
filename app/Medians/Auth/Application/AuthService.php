<?php

namespace Medians\Auth\Application;


use Medians\Branches\Application\BranchController;
use Medians\Mail\Application\MailService;

use Medians\Auth\Domain\AuthModel;

use Medians\Settings\Application\SystemSettingsController;


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

		try {
				
			$this->app = new \config\APP;

			if (isset($this->app->auth()->id)) { return $this->app->redirect('/dashboard'); }

		    return  render('login', [
		    	'load_vue' => true,
		        'title' => __('Login page'),
		        'app' => $this->app,
		        'google_login' => $this->loginWithGoogle(),
		        'formAction' => '/login',
		    ]);
		    
		} catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
		}
	}


	public function verifyLoginWithGoogle()
	{
		
		$this->app = new \config\APP;

		$params = $this->app->request()->query->all();

		$SystemSettings = new SystemSettingsController;

		$settings = $SystemSettings->getAll();

		$Google = new GoogleService($settings['google_login_key'],$settings['google_login_secret']);

	  	$token = $Google->client->fetchAccessTokenWithAuthCode($params['code']);

	  	$token = $Google->client->setAccessToken($token);

	  	if($client->isAccessTokenExpired())
	  		return false;


		$google_oauth = new Google_Service_Oauth2($client);
		$user_info = $google_oauth->userinfo->get();

		print_r($user_info);

	}


	public function loginWithGoogle()
	{
		$SystemSettings = new SystemSettingsController;

		$settings = $SystemSettings->getAll();

		$Google = new GoogleService($settings['google_login_key'],$settings['google_login_secret']);

		return $Google->client->createAuthUrl();
	}


	/**
	 * User login request
	 */ 
	public function userLogin()
	{
		$this->app = new \config\APP;
		
        $params = $this->app->request()->get('params');

        try {
            
            $checkUser = $this->checkLogin($params['email'], $this->encrypt($params['password']));

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
	 * Signup page 
	 * @var Int
	 */
	public function signup()
	{

		$this->app = new \config\APP;

		try {

			if (isset($this->app->auth()->id)) {
				echo $this->app->redirect('/dashboard');
			}

			return render('views/front/signup.html.twig', [
		        'google_login' => $this->loginWithGoogle(),
			]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

	/**
	 * User login request
	 */ 
	public function userSignup()
	{

		$this->app = new \config\APP;
        
        $params = $this->app->request()->get('params');

        try {
            
            $validate = $this->validateSignup($params);

            if (!empty($validate)){
            	echo $validate;
            	return $validate;
            }

            $params['active'] = '0';
            $params['role_id'] = 3;
            $params['active_branch'] = '0';

			$save = $this->repo->store($params);

			if (isset($save->id))
				$this->observe($save);

        	echo json_encode(isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created').__('check_email_for_activation'), 'reload'=>1)
        	: array('error'=> $save ));



        } catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
        	
        }
	}

	/**
	 * Validate the password length
	 * 
	 */ 
	public function validateSignup($params)
	{

        if (!empty($this->repo->getByEmail($params['email'])))
			return json_encode(array('error'=>__('Email already found')));

        if (empty($params['email']))
			return json_encode(array('error'=>__('Email required')));

        // if (empty($params['mobile']))
			// return json_encode(array('error'=>__('MOBILE_ERR')));

        if (empty($params['first_name']))
			return json_encode(array('error'=>__('Name required')));

		if (strlen($params['password']) < $this->passLen)
			return __("Password length must be $this->passLen at least ");

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


	/**
	 * Observe the new user event
	 */ 
	public function observe($user) 
	{

		$data = [
			'subject' => __('Activate your account'),
			'body' => render('views/email/email.html.twig',['user'=>$user, 'app'=>$this->app, 'setting'=>$this->app->settings()])
		];

		return new Mail($user->email, $user->email, $data['subject'], $data['body']);

	}









}
