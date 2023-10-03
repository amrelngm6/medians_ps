<?php

namespace Medians;

use \Shared\dbaser\CustomController;

class MasterDashboardController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;


	protected $app;
	public $DevicesRepository;
	public $OrderDevicesRepository;
	public $PaymentRepository;
	public $CustomerRepository;
	public $start;
	public $end;
	public $StockRepository;
	public $ExpensesRepository;
	public $GamesRepository;
	public $OrderRepository;
	public $start_week;
	public $UserRepository;
	public $BranchRepository;

	function __construct()
	{
		$this->app = new \config\APP;

		$this->UserRepository = new Users\Infrastructure\UserRepository();

		$this->CustomerRepository = new Customers\Infrastructure\CustomerRepository;

	}

	/**
	 * Load dashboard page
	 * 
	 * @return response for Vue  
	 */
	public function index()
	{

		try {
			
			// Name of the Vue components
	        return  render('master_dashboard', $this->data());
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


	/**
	 * Get the response as array and return as JSON
	 * 
	 * @return JSON of the response  
	 */
	public function json()
	{

		try {
			
	        echo  json_encode( $this->data());
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 

	/**
	 * Dashboard response as Array  
	 * 
	 * @return Array  
	 */
	public function data()
	{

		try {
			
			$list = $this->loadList();

			$counts = $this->loadCounts();

			$values = $this->loadValues();

            /**
            * By default get last 7 days 
            * for charts for better analysis
            */ 

	        return [
	            'title' => 'Dashboard',
		        'formAction' => '/login',
		        'load_vue' => true,
	            // 'formAction' => $this->app->CONF['url'],
	        ];
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 



	/**
	 * Load countable statstics
	 */
	public function loadCounts()
	{
		$data = [];


        return $data;

	}  


	/**
	 * Load sum values 
	 */
	public function loadValues()
	{

		$data = [];

        return $data;

	}  


	/**
	 * Load Items List statstics
	 */
	public function loadList()
	{

	}  
}
