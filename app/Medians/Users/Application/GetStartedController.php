<?php

namespace Medians\Users\Application;

use Medians\Branches\Infrastructure\BranchRepository;

use Medians\Settings\Application\SettingsController;

class GetStartedController 
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	public $app;


	function __construct()
	{
		$this->app = new \config\APP;		

		$this->repo = new BranchRepository();
		
	}



	/**
	*  Store setting for new user
	*/
	public function store_setting() 
	{

		return (new SettingsController)->update();

	}


	/**
	*  Store branch for new user
	*/
	public function store_branch() 
	{

		$params = (array)  $this->app->request()->get('params');

		try {

			$params['status'] = 'on';
			$params['owner_id'] = $this->app->auth()->id;
			$save = $this->repo->store($params);

			if (isset($save->id))
				$this->saveActiveBranch($save);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created'), 'reload'=>1)
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}


	/**
	 * Save the created branch 
	 * for the active session
	 * 
	 */ 
	public function saveActiveBranch($branch)
	{

		$user = $this->app->auth();

		$user->update(['active_branch'=>$branch->id]);

		return $this;
	} 


}
