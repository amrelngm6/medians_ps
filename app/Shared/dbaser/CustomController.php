<?php

namespace Shared\dbaser;

class CustomController 
{

	public function checkBranch()
	{
		$this->app = new \config\APP;

		$checkUser = $this->app->auth();

		if (isset($checkUser->id) && empty($checkUser->active_branch))
			echo $this->app->redirect('/get-started');

	}

}



