<?php

namespace Medians;

use \Shared\dbaser\CustomController;

class DashboardController extends CustomController
{

	/**
	* @var Object
	*/
	public  $contentRepo;
	public  $TripRepository;
	public  $TaxiTripRepository;
	public  $RouteRepository;
	public  $DriverRepository;
	public  $DriverApplicantRepository;
	public  $RouteLocationRepository;
	public  $VehicleRepository;
	public  $StudentRepository;
	public  $HelpMessageRepository;
	public  $InvoiceRepository;
	public  $TransactionRepository;
	public  $PackageSubscriptionRepository;
	public  $CustomerRepository;
	public  $StudentApplicantRepository;

	protected $app;
	public $start;
	public $end;
	public $month_first;
	

	function __construct()
	{
		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->contentRepo = new Content\Infrastructure\ContentRepository();
		$this->TripRepository = new Trips\Infrastructure\TripRepository();
		$this->TaxiTripRepository = new Trips\Infrastructure\TaxiTripRepository();
		$this->VehicleRepository = new Vehicles\Infrastructure\VehicleRepository();
		$this->RouteRepository = new Routes\Infrastructure\RouteRepository();
		$this->DriverRepository = new Drivers\Infrastructure\DriverRepository();
		$this->DriverApplicantRepository = new Drivers\Infrastructure\DriverApplicantRepository();
		$this->RouteLocationRepository = new Locations\Infrastructure\RouteLocationRepository();
		$this->StudentRepository = new Students\Infrastructure\StudentRepository();
		$this->HelpMessageRepository = new Help\Infrastructure\HelpMessageRepository();
		$this->CustomerRepository = new Customers\Infrastructure\CustomerRepository();
		$this->StudentApplicantRepository = new Customers\Infrastructure\StudentApplicantRepository();
		$this->InvoiceRepository = new Invoices\Infrastructure\InvoiceRepository();
		$this->TransactionRepository = new Transactions\Infrastructure\TransactionRepository();

		
		$setting = $this->app->SystemSetting();
		$defaultStart = isset($setting['default_dashboard_start_date']) ? date('Y-'. $setting['default_dashboard_start_date']) : date('Y-m-d');
		$this->start = $this->app->request()->get('start_date') ? date('Y-m-d', strtotime($this->app->request()->get('start_date'))) : $defaultStart;
		$this->end = $this->app->request()->get('end_date') ? date('Y-m-d', strtotime($this->app->request()->get('end_date'))) : date('Y-m-d');
		
	}

	/**
	 * Load dashboard page
	 * 
	 * @return response for Vue  
	 */
	public function index()
	{
		try {
			
			$user = $this->app->auth();

			// Name of the Vue components
	        return $user->role_id == 1 ?  render('master_dashboard', $this->master_data()) :   render('dashboard', $this->data());
	        
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

			$user = $this->app->auth();
			
	        return json_encode($user->role_id == 1 ?  $this->master_data() :   $this->data());
	        
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

			$trips_charts = $this->TripRepository->getAllByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$taxi_trips_charts = $this->TaxiTripRepository->getAllByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$applicants = $this->StudentApplicantRepository->get(5);

			$counts = $this->loadCounts();

			$array = [
	            'title' => 'Dashboard',
		        'load_vue' => true,
				'trips_charts'=>$trips_charts,
				'taxi_trips_charts'=>$taxi_trips_charts,
				'applicants'=>$applicants,
				'start'=>$this->start,
				'end'=>$this->end,
	        ];

			return array_merge($counts, $array);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 



	
	/**
	 * Dashboard response for Master
	 * 
	 * @return Array  
	 */
	public function master_data()
	{

		try {

			$trips_charts = $this->TripRepository->masterByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$taxi_trips_charts = $this->TaxiTripRepository->masterByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$applicants = $this->StudentApplicantRepository->get(5);

			$counts = $this->loadMasterCounts();

			$array = [
	            'title' => 'Master Dashboard',
		        'load_vue' => true,
				'trips_charts'=>$trips_charts,
				'taxi_trips_charts'=>$taxi_trips_charts,
				'applicants'=>$applicants,
	        ];

			return array_merge($counts, $array);
	        
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

        $data['customers_count'] = $this->CustomerRepository->masterByDateCount(['start'=>$this->start, 'end'=>$this->end]);
        $data['taxi_trips_count'] = $this->TaxiTripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['total_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['route_locations_count'] = $this->RouteLocationRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['student_applicant_count'] = $this->StudentApplicantRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['drivers_count'] = $this->DriverRepository->get()->count();
        $data['routes_count'] = $this->RouteRepository->get()->count();
        $data['vehicles_count'] = $this->VehicleRepository->get()->count();
        $data['top_drivers'] = $this->DriverRepository->mostTrips(5);
        $data['top_drivers_list'] = $this->DriverRepository->topDrivers(5);
        $data['latest_subscriptions'] = $this->PackageSubscriptionRepository->get(5);
        $data['driver_applicants'] = $this->DriverApplicantRepository->get(5);
        $data['latest_help_messages'] = $this->HelpMessageRepository->load(5);
        $data['invoices_count'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['total_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->sum('total_amount');
        $data['payment_methods_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->selectRaw('SUM(total_amount) as value, payment_method')->groupBy('payment_method')->get();
        $data['latest_invoices'] = $this->InvoiceRepository->get(5);
        $data['latest_transactions'] = $this->TransactionRepository->get(5);
        $data['transactions_count'] = $this->TransactionRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['subscriptions_count'] = $this->PackageSubscriptionRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();

        return $data;

	}  


	
	/**
	 * Load countable statstics
	 */
	public function loadMasterCounts()
	{
		$data = [];

        $data['customers_count'] = $this->CustomerRepository->masterByDateCount(['start'=>$this->start, 'end'=>$this->end]);
        $data['taxi_trips_count'] = $this->TaxiTripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['total_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['latest_help_messages'] = $this->HelpMessageRepository->allEventsByDate(['start'=>$this->start,'end'=>$this->end], 5);
        $data['invoices_count'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['latest_invoices'] = $this->InvoiceRepository->get(5);
		$data['invoices_charts'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->selectRaw('date as label, COUNT(*) as y')->having('y', '>', 0)->orderBy('y', 'desc')->groupBy('label')->get();
		$data['total_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->sum('total_amount');
        $data['payment_methods_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->selectRaw('SUM(total_amount) as value, payment_method')->groupBy('payment_method')->get();
        
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

	
	public function switchLang($lang)
	{

		if (empty($_SERVER['HTTP_REFERER'])) {
			echo (new \config\APP)->redirect('/');
			return null;
		}

		$prefix = str_replace($this->app->CONF['url'], '', $_SERVER['HTTP_REFERER']);

		if (empty($prefix))
		{
			echo (new \config\APP)->redirect('/'); 
			return true;
		}

		
		$_SESSION['site_lang'] = in_array($lang, ['arabic', 'english']) ? $lang : 'arabic';

		echo (new \config\APP)->redirect($_SERVER['HTTP_REFERER']);
	}

}
