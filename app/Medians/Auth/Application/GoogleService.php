<?php

namespace Medians\Auth\Application;


use Medians\Branches\Application\BranchController;
use Medians\Mail\Application\MailService;

use Google\Client;

use Medians\Auth\Domain\AuthModel;

use Google_Service_Oauth2;
use Medians\Settings\Application\SystemSettingsController;


class GoogleService 
{


	function __construct($client_id, $client_secret)
	{

		$this->app = new \config\APP;

		$this->repo = new \Medians\Users\Infrastructure\UserRepository();

		$this->client = new Client();
		$this->client->setClientId($client_id);
		$this->client->setClientSecret($client_secret);
		$this->client->setRedirectUri($this->app->CONF['url'].'google_login_redirect');
		$this->client->addScope("email");
		$this->client->addScope("profile");
	}


	public function verifyLoginWithGoogle()
	{

		$this->app = new \config\APP;


		try {
				
			// Get system settings for Google Login
			$SystemSettings = new SystemSettingsController;

			$settings = $SystemSettings->getAll();

			$Google = new GoogleService($settings['google_login_key'], $settings['google_login_secret']);

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
			$params['profile_image'] = $user_info['picture'];

			// $params['field']['google_id'] = $user_info['id'];

			$user = $this->repo->getByEmail($params['email']);

			if (isset($user->id))
				$user->update(['profile_image' => $user_info['picture']]);
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
	public function checkLogin($user)
	{

		if (empty($user->email))
			return null;

		$checkLogin = $this->repo->getByEmail($user->email);

		if (empty($checkLogin->id))
		{

            $params['first_name'] = $user->givenName;
            $params['last_name'] = $user->familyName;
            $params['email'] = $user->email;
            // $params['profile_image'] = $user->picture;

            $params['active'] = '0';
            $params['role_id'] = 3;
            $params['active_branch'] = '0';

			$checkLogin = $this->repo->store($params);

		}

        $this->setSession($checkLogin);

		return $checkLogin;
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










}
