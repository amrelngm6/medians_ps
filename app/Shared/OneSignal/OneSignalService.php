<?php
namespace Shared\OneSignal;

use Shared\dbaser\CustomController;


class OneSignalService extends CustomController 
{

    function __construct()
	{

		$this->app = new \config\APP;

	}


    public function send()
    {
        
    }


}