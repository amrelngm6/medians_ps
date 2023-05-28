<?php

namespace Medians\Users\Application;

use Medians\Branches\Infrastructure\BranchRepository;
use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Plans\Infrastructure\PlanSubscriptionRepository;

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

		$this->planSubscriptionRepo = new PlanSubscriptionRepository();

		$this->planRepo = new PlanRepository();
		
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



	/**
	 * Save the created branch 
	 * for the active session
	 * 
	 */ 
	public function saveActivePlan()
	{

		try {

			$user = $this->app->auth();

			$plan = $this->planRepo->find($this->app->request()->get('plan_id'));

			// Check if plan is exist
			if (empty($plan))
				return null;

			// Check if plan is free
			if (!empty($plan->paid))
				return null;

			// Store new subscription 
	    	$params['plan_id'] = $plan->id;
	    	$params['branch_id'] = $this->app->branch->id;
	    	$params['user_id'] = $this->app->auth()->id;
	    	$params['start_date'] = date('Y-m-d');
	    	$params['end_date'] = date('Y-m-d', strtotime('+1 year', date('Y-m-d')));
			$save = $this->planSubscriptionRepo->store($params);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created'))
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	} 


}
