<?php

namespace Medians\Auth\Application;

use Medians\Auth\Domain\AuthModel;

use Medians\Settings\Application\SystemSettingsController;

use Medians\Mail\Application\MailService;

use Google_Service_Oauth2;

class AuthService 
{

	
	private $app;

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
	protected $repo;

	/**
	* @var Instance Driver Repo
	*/
	protected $driverRepo;

	/**
	* @var Instance Parent Repo
	*/
	protected $parentRepo;


	function __construct()
	{
		$this->repo = new \Medians\Users\Infrastructure\UserRepository();
		$this->parentRepo = new \Medians\Customers\Infrastructure\ParentRepository(null);
	}
 

	/**
	 * Display login page 
	 */
	public function loginPage()
	{
		try {
			
			$this->app = new \config\APP;

			if (isset($this->app->auth()->id)) { return $this->app->redirect('/dashboard'); }

		    // return  render('login', [
			return render('views/front/signin.html.twig', [
		    	// 'load_vue' => true,
		        'title' => translate('Login page'),
		        'app' => $this->app,
		        'google_login' => $this->loginWithGoogle(),
		        'formAction' => '/login',
		    ]);
		    
		} catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
		}
	}

	
	/**
	 * Display login page 
	 */
	public function signupPage()
	{
		try {
			
			$this->app = new \config\APP;

			if (isset($this->app->auth()->id)) { return $this->app->redirect('/dashboard'); }

			return render('views/front/signup.html.twig', [
		        'title' => translate('Login page'),
		        'app' => $this->app,
		        'google_login' => $this->loginWithGoogle(),
		    ]);
		    
		} catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
		}
	}


	public function verifyLoginWithGoogle()
	{

		$this->app = new \config\APP;


		try {
				
			// Get system settings for Google Login
			$SystemSettings = new SystemSettingsController;

			$settings = $SystemSettings->getAll();

			$Google = new GoogleService($settings['google_client_id'], $settings['google_client_secret']);

			$code = $this->app->request()->get('code');

		  	$Google->client->setAccessToken($Google->client->fetchAccessTokenWithAuthCode($code));

		  	// Check if code is expired or invalid
		  	if($Google->client->isAccessTokenExpired())
		  	{
	  			return false;
		  	}


	  		// Get user data through API
			$google_oauth = new Google_Service_Oauth2($Google->client);
			$user_info = $google_oauth->userinfo->get();

			// Prepare user data to store
			$params['email'] = $user_info['email'];
			$params['first_name'] = $user_info['givenName'];
			$params['last_name'] = $user_info['familyName'];
			$params['picture'] = $user_info['picture'];
			$params['role_id'] = 3;

			// $params['field']['google_id'] = $user_info['id'];

			$user = $this->repo->getByEmail($params['email']);

			if (isset($user->id))
				$user->update(['picture' => $user_info['picture']]);
			else 
				$user = $this->repo->store($params);

			// Check if user saved
			if (isset($user->id)){
				$this->setSession($user);
		    	$this->repo->setCustomCode((object) $user, 'google_id', $user_info['id']);
			} else {
				return null;
			}  

			if (isset($user->field['activation_token']))
				echo $this->app->redirect('./activate-account/'.$user->field['activation_token']);
			else
				echo $this->app->redirect('/dashboard');

		} catch (Exception $e) {
			return array('error'=>$e->getMessage());
		}


	}


	public function loginWithGoogle()
	{
		$SystemSettings = new SystemSettingsController;

		$settings = $SystemSettings->getAll();

		if (empty($settings['google_client_id']))
			return null;

		$Google = new GoogleService($settings['google_client_id'],$settings['google_client_secret']);

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
            	echo json_encode(array('success'=>1, 'result'=>translate('Logged in'), 'redirect'=>$this->app->CONF['url']));

            } else {
	            echo json_encode(array('error'=>$checkUser));
            }


        } catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
        	
        }
	}


	/**
	 * User Signup request
	 */ 
	public function userSignup()
	{
		$this->app = new \config\APP;
		
        $params = $this->app->request()->get('params');

        try {
            
            $checkUser = $this->checkSignup($params);

            if (empty($checkUser))
            {
				$checkUser = $this->repo->signup($params);

				if (!empty($checkUser->id))
				{
					$this->setSession($checkUser);
					echo json_encode(array('success'=>1, 'result'=>translate('Logged in'), 'redirect'=>$this->app->CONF['url'].'dashboard'));
				}

            } else {
	            echo json_encode(array('error'=>$checkUser));
            }


        } catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);
        	
        }
	}

	/**
	 * User Signup request
	 */ 
	public function activate($code)
	{
		$this->app = new \config\APP;
		
        try {
            
            $checkUser = $this->repo->findByActivationCode($code);

            if (!empty($checkUser))
            {
				$updated = $checkUser->update(['status'=>'on']);
			}

			return render('views/front/activate.html.twig', [
				// 'load_vue' => true,
				'title' => translate('Activation page'),
				'app' => $this->app,
				'msg' => isset($updated) ? translate('Account activated successfully') : translate('Code not valid'),
				'valid' => isset($updated) ? true : false,
			]);

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
            return translate("User credentials not valid");
		}

		if (empty($checkLogin->active))
		{
			return translate("User account is not active");
		}

		return $checkLogin;
	}


	/**
	 * Check Signup credentials
	 * 
	 * @return Object / String 
	 */ 
	public function checkSignup($params)
	{
		$getByEmail = $this->repo->getByEmail($params['email']);
		
		if (isset($getByEmail->id))
		{
            return translate("EMAIL_FOUND");
		}
	}


	/**
	 * Check login credentials
	 * 
	 * @return Object / String 
	 */ 
	public function checkDriverLogin($email, $password)
	{

		$this->driverRepo = new \Medians\Drivers\Infrastructure\DriverRepository(null);
		
		$checkDriverLogin = $this->driverRepo->checkLogin($email, $password);

		if (empty($checkDriverLogin->id))
		{
            return translate("User credentials not valid");
		}

		if (empty($checkDriverLogin->active))
		{
			return translate("User account is not active");
		}

		return $checkDriverLogin;
	}

	/**
	 * Check Parent login credentials
	 * 
	 * @return Object / String 
	 */ 
	public function checkParentLogin($email, $password)
	{
		$checkParentLogin = $this->parentRepo->checkLogin($email, $password);

		if (empty($checkParentLogin->id))
		{
            return translate("User credentials not valid");
		}

		if (empty($checkParentLogin->active))
		{
			return translate("User account is not active");
		}

		return $checkParentLogin;
	}



	
	/**
	 * Validate the password length
	 * 
	 */ 
	public function validateSignup($params)
	{

        if (!empty($this->repo->getByEmail($params['email'])))
			return json_encode(array('error'=>translate('Email already found')));

        if (empty($params['email']))
			return json_encode(array('error'=>translate('Email required')));

        if (empty($params['first_name']))
			return json_encode(array('error'=>translate('Name required')));

		if (strlen($params['password']) < $this->passLen)
			return translate("Password length must be $this->passLen at least ");

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
		
		$check = $this->AuthModel->checkSession($code);


		if (!empty ( $check ))
		{
			return $this->repo->find($check);
		}
	}


	/**
	 * Check session is valid or not 
	 * for Mobile / API Tokens
	 * 
	 * @return ? AuthModel
	 */ 
	public function checkAPISession($token = null, $userType = null) 
	{
				
		$this->driverRepo = new \Medians\Drivers\Infrastructure\DriverRepository(null);
		
		switch ($userType) {
			case 'Driver':
				return $this->driverRepo->findByToken($token);
				break;
				
			case 'Parent':
				return $this->parentRepo->findByToken($token);
				break;

			default:
				return $this->repo->findByToken($token);
				break;
		}
		// return $userType == 'Driver' ?  : $this->repo->findByToken($token);
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
