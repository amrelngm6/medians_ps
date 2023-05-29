<?php

namespace Shared\dbaser;

class CustomController 
{

	public function checkPlan()
	{

		$this->app = new \config\APP;

		$checkUser = $this->app->auth();

		if (empty($checkUser->plan->id))
			echo $this->app->redirect('/get-started');

	}


	public function checkBranch()
	{
		$this->app = new \config\APP;

		$checkUser = $this->app->auth();

		if (isset($checkUser->id) && empty($checkUser->active_branch))
			echo $this->app->redirect('/get-started');

	}


}



