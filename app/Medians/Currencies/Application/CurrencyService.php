<?php

namespace Medians\Currencies\Application;
use \Shared\dbaser\CustomController;

use Medians\Currencies\Infrastructure\CurrencyRepository;
use Medians\Users\Domain\User;

class CurrencyService
{

	
	public $app;

	public $repo;


	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new CurrencyRepository();
	}
	
	
	public function load()
	{
		try {

            $result = $this->repo->load_active();
			echo(json_encode($result));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
		
	}
	

}
