<?php

namespace Medians\Payments\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Application\SystemSettingsController;



class PayPalService
{

	public $app;


	function __construct($order)
	{

		$this->app = new \config\APP;


	}



}
