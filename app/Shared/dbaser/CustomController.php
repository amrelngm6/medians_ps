<?php

namespace Shared\dbaser;

use \Illuminate\Database\Eloquent\Model;

use Medians\Domain\Users\User;

class CustomController extends Model
{

	function __construct()
	{
		$this->orderBy('id', 'DESC');
	}

	function can($permission, $app)
	{
	    if (isset($app->auth->role_id))
	    {

	        if ($app->auth->role_id == 1)
	            return true;

		    if (isset($this->agent_id) && $this->agent_id == $app->auth->id)
	            return true;

		    if (isset($this->created_by) && $this->created_by == $app->auth->id)
	            return true;

		    if (get_class($this) == User::class && $this->id == $app->auth->id)
	            return true;

	    }


	    return null;
	}

}




