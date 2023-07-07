<?php

namespace Shared\dbaser;


/**
 * Using this class for the common
 * functions between Controllers
 * and services inside APP layer
 * 
 */   
class CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app ;

	public $client ;

	public $blogRepo;
	public $doctorRepo;
	public $specsRepo;
	public $storiesRepo;
	public $storyDateRepo;
	public $pagesRepo;
	public $offersRepo;
	public $categoryRepo;
	public $contentRepo;
	public $storyRepo;

	/**
	 * Check if the user can Access specific feature
	 * by code pf the feature
	 * 
	 * Return upgrade message as JSON 	 
	 * 
	 * @param $code String => Code of the feature 
	 * @param $currentCount Int =>  current usage of the feature  
	 * 
	 * @return JSON
	 * 
	 */ 
	public function checkFeatureAccess(String $code, $currentCount)
	{

		$this->app = new \config\APP;

		// Get branch features and convert to Object
		$branchFeatures = (object) $this->app->branch->features;

		// Check if the branch has this feature
		if (empty($branchFeatures->$code)){
			echo json_encode(['error'=>__('plan_limit_exceeded_upgrade_now')]); die();
		}

		// Check if the branch has this feature
		// And Usage count is less than the Limit
		// And Usage limit is not Umlimited
		if (isset($branchFeatures->$code) && $branchFeatures->$code <= $currentCount && $branchFeatures->$code > -1 ){
			echo json_encode(['error'=>__('plan_limit_exceeded_upgrade_now')]); die();
		}

	}


	/**
	 * Check if the user can created and assigned 
	 * to a branch 
	 * if Not he should be redirected to Get-Started page
	 * 
	 * Redirect to /get-started page 	 
	 * 
	 * @param $code String => Code of the feature 
	 * @param $limit Int =>  current usage of the feature  
	 * 
	 * @return JSON
	 * 
	 */ 
	public function checkBranch()
	{
		$this->app = new \config\APP;

		$checkUser = $this->app->auth();
		
		// Check if the user is Master
		if (isset($checkUser->id) && $checkUser->id === 1)
			return true;

		// Check if the request is in JSON
		// And User has no branch yet 
		if ($this->app->request()->get('load') == 'json' && empty($checkUser->active_branch))
		{
			echo $this->getStartedPage(); die();
		}

		// Check if the User has no branch yet
		if (isset($checkUser->id) && empty($checkUser->active_branch)) {
			echo $this->app->redirect('/get-started'); return true; 
		}

		// Check if the User has no Plan subscription yet
		if (empty($this->app->branch->plan)) {
			echo $this->app->redirect('/get-started'); return true;
		}

	}


	public function getStartedPage()
	{
		$page = new \Medians\Users\Application\GetStartedController;
		return $page->get_started();
	}

	

}



