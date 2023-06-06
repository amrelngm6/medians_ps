<?php

namespace Medians;

use \Shared\dbaser\CustomController;

class MasterDashboardController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->app = new \config\APP;

        $this->BranchRepository = new Branches\Infrastructure\BranchRepository;

		$this->UserRepository = new Users\Infrastructure\UserRepository();

		$this->CustomerRepository = new Customers\Infrastructure\CustomerRepository;

		$this->PaymentRepository = new Payments\Infrastructure\PaymentsRepository;

		$this->PlanSubscriptionRepository = new Plans\Infrastructure\PlanSubscriptionRepository;

		$this->start = $this->app->request()->get('start') ? date('Y-m-d 00:00:00', strtotime($this->app->request()->get('start'))) : date('Y-m-d 00:00:00');
		$this->end = $this->app->request()->get('start') ? date('Y-m-d 23:59:59', strtotime($this->app->request()->get('end'))) : date('Y-m-d 23:59:59');

		$this->start_week = !$this->app->request()->get('start') || $this->app->request()->get('start') == 'today' 
            ? date('Y-m-d', strtotime('-7 days', strtotime($this->start)))
            : $this->start;
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
            $branches_charts = $this->BranchRepository->getByDateCharts(['start'=>$this->start_week, 'end'=>$this->end]);

	        return [
	            'title' => 'Dashboard',
	            'new_branches' => $counts['new_branches'],
	            'new_subscribers' => $counts['new_subscribers'],
	            'new_customers' => $counts['new_customers'],
	            'total_payments' => $counts['total_payments'],
	            'branches_charts' => $branches_charts,
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

		$data['new_branches'] = $this->BranchRepository->getLatest(['start'=>$this->start,'end'=>$this->end])->count();

		$data['new_subscribers'] = $this->PlanSubscriptionRepository->getLatest(['start'=>$this->start,'end'=>$this->end])->count();

		$data['new_customers'] = $this->CustomerRepository->getLatest(['start'=>$this->start,'end'=>$this->end])->count();

		$data['total_payments'] = $this->PaymentRepository->getLatest(['start'=>$this->start,'end'=>$this->end])->sum('amount');
        
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

		$data = [];

        return $data;

	}  
}
