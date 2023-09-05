<?php

namespace Medians;
use \Shared\dbaser\CustomController;


class DashboardController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->app = new \config\APP;
	}

	/**
	 * Model object 
	 */
	public function index()
	{

		try {
			
	        return  render('dashboard', [
	        	'load_vue'=> true,
				'messages' => $this->activeMessages(),
	            'title' => __('Dashboard')
	        ]);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


	/**
	 * Load Active Messages
	 */
	public function activeMessages()
	{

		$app = new \Medians\Messages\Infrastructure\MessageRepository;

		return $app->loadMessages();
	}


}