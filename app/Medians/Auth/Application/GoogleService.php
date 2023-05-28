<?php

namespace Medians\Auth\Application;


use Medians\Branches\Application\BranchController;
use Medians\Mail\Application\MailService;

use Google\Client;

use Medians\Auth\Domain\AuthModel;



class GoogleService 
{


	function __construct($client_id, $client_secret)
	{

		$this->app = new \config\APP;

		$this->client = new Client();
		$this->client->setClientId($client_id);
		$this->client->setClientSecret($client_secret);
		$this->client->setRedirectUri($this->app->CONF['url'].'google_login_redirect');
		$this->client->addScope("email");
		$this->client->addScope("profile");
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

			if (isset($checkLogin->id))
				$this->observe($checkLogin);
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



	/**
	 * Observe the new user event
	 */ 
	public function observe($user) 
	{

		$data = [
			'subject' => __('Activate your account'),
			'body' => render('views/email/email.html.twig',['user'=>$user, 'app'=>$this->app, 'setting'=>$this->app->settings()])
		];


		$mail = new MailService($user->email, $user->email, $data['subject'], $data['body']);

		return $mail->sendMail(); 


	}









}
