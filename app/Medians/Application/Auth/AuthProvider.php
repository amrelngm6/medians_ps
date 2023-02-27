<?php

namespace Medians\Application\Auth;

use Medians\Domain\Customers\Customer;

use Medians\Application\AuthInterface;

use Medians\Application\Administrators\Admin;

use Medians\Domain\Auth\AuthModel;

class AuthBranch 
{

	/*
	/ @var String
	*/
	private $email;

	/*
	/ @var String
	*/
	private $password ;

	/*
	/ @var Instance
	*/
	private $repo;



	function __construct($repo)
	{

		$this->repo = $repo;
	}


	public function checkLogin($email, $password) : ?Customer
	{

		$checkLogin = $this->repo->checkLogin($email, $password);

		if (empty($checkLogin->id()))
		{
			throw new \Exception("User credentials not valid", 1);
		}

		if (empty($checkLogin->publish()))
		{
			throw new \Exception("User account is not active", 1);
			
		}

		return $checkLogin;
	}


	public function checkSession($code) 
	{
		$AuthModel = new AuthModel();

		if (!empty ( $AuthModel->checkSession($code) ))
		{
			return (new Admin($AuthModel->checkSession($code)))->getItem();
		}
	}



	public function setSession($data) 
	{
		$AuthModel = new AuthModel();

		if ($AuthModel->setData($data)) 
		{
			return $AuthModel->checkSession($code);
		}
	}


	public function unsetSession() 
	{
		$AuthModel = new AuthModel();
		$AuthModel->unsetSession();
	}


	public function encrypt($value) : String 
	{
		return sha1(md5($value));

	}



}
