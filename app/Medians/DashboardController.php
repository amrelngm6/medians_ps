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
	public  $PrivateTripRepository;
	public  $RouteRepository;
	public  $DriverRepository;
	public  $DriverApplicantRepository;
	public  $RouteLocationRepository;
	public  $VehicleRepository;
	public  $StudentRepository;
	public  $HelpMessageRepository;
	public  $BusinessApplicantRepository;
	public  $InvoiceRepository;
	public  $TransactionRepository;
	public  $PackageSubscriptionRepository;
	public  $BusinessRepository;
	public  $CustomerRepository;
	public  $PlanSubscriptionRepository;

	protected $app;
	public $start;
	public $end;
	public $month_first;
	

	function __construct()
	{
		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->BusinessRepository = new Businesses\Infrastructure\BusinessRepository();
		$this->contentRepo = new Content\Infrastructure\ContentRepository($user->business);
		$this->TripRepository = new Trips\Infrastructure\TripRepository($user->business);
		$this->PrivateTripRepository = new Trips\Infrastructure\PrivateTripRepository($user->business);
		$this->VehicleRepository = new Vehicles\Infrastructure\VehicleRepository($user->business);
		$this->RouteRepository = new Routes\Infrastructure\RouteRepository($user->business);
		$this->DriverRepository = new Drivers\Infrastructure\DriverRepository($user->business);
		$this->DriverApplicantRepository = new Drivers\Infrastructure\DriverApplicantRepository($user->business);
		$this->RouteLocationRepository = new Locations\Infrastructure\RouteLocationRepository($user->business);
		$this->StudentRepository = new Students\Infrastructure\StudentRepository($user->business);
		$this->HelpMessageRepository = new Help\Infrastructure\HelpMessageRepository($user->business);
		$this->CustomerRepository = new Customers\Infrastructure\CustomerRepository();
		$this->BusinessApplicantRepository = new Customers\Infrastructure\BusinessApplicantRepository($user->business);
		$this->InvoiceRepository = new Invoices\Infrastructure\InvoiceRepository($user->business);
		$this->TransactionRepository = new Transactions\Infrastructure\TransactionRepository($user->business);
		$this->PackageSubscriptionRepository = new Packages\Infrastructure\PackageSubscriptionRepository($user->business);
		$this->PlanSubscriptionRepository = new Plans\Infrastructure\PlanSubscriptionRepository($user->business);

		$this->start = $this->app->request()->get('start_date') ? date('Y-m-d', strtotime($this->app->request()->get('start_date'))) : date('Y-m-d');
		$this->end = $this->app->request()->get('end_date') ? date('Y-m-d', strtotime($this->app->request()->get('end_date'))) : date('Y-m-d');
		$this->month_first = date('Y-m-01');
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
			$private_trips_charts = $this->PrivateTripRepository->getAllByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$applicants = $this->BusinessApplicantRepository->get(5);

			$counts = $this->loadCounts();

			$array = [
	            'title' => 'Dashboard',
		        'load_vue' => true,
				'trips_charts'=>$trips_charts,
				'private_trips_charts'=>$private_trips_charts,
				'applicants'=>$applicants,
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
			$private_trips_charts = $this->PrivateTripRepository->masterByDateCharts(['start'=>$this->start, 'end'=>$this->end]);
			$applicants = $this->BusinessApplicantRepository->get(5);

			$counts = $this->loadCounts();

			$array = [
	            'title' => 'Master Dashboard',
		        'load_vue' => true,
				'trips_charts'=>$trips_charts,
				'private_trips_charts'=>$private_trips_charts,
				'businesses'=>$applicants,
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

        $data['businesses_count'] = $this->BusinessRepository->masterByDateCount(['start'=>$this->start, 'end'=>$this->end]);
        $data['top_businesses'] = $this->BusinessRepository->masterByDate(['start'=>$this->start, 'end'=>$this->end], 5);
        $data['customers_count'] = $this->CustomerRepository->masterByDateCount(['start'=>$this->start, 'end'=>$this->end]);
        $data['plan_subscriptions'] = $this->PlanSubscriptionRepository->getLatest(['start'=>$this->start, 'end'=>$this->end], 5);
        $data['private_trips_count'] = $this->PrivateTripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['total_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['latest_help_messages'] = $this->HelpMessageRepository->allEventsByDate(['start'=>$this->start,'end'=>$this->end], 5);
        $data['invoices_count'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['latest_invoices'] = $this->InvoiceRepository->get(5);

        return $data;

	}  


	
	/**
	 * Load countable statstics
	 */
	public function loadAllCounts()
	{
		$data = [];

        $data['active_trips_count'] = $this->TripRepository->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('status', 'scheduled')->count();
        $data['completed_trips_count'] = $this->TripRepository->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('status', 'completed')->count();
        $data['total_trips_count'] = $this->TripRepository->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['drivers_count'] = $this->DriverRepository->get()->count();
        $data['routes_count'] = $this->RouteRepository->get()->count();
        $data['route_locations_count'] = $this->RouteLocationRepository->get()->count();
        $data['vehicles_count'] = $this->VehicleRepository->get()->count();
        $data['top_drivers'] = $this->DriverRepository->mostTrips(5);
        $data['top_drivers_list'] = $this->DriverRepository->topDrivers(5);
        $data['latest_students'] = $this->StudentRepository->get(5);

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

		echo (new \config\APP)->redirect('/'); 
		
		$_SESSION['site_lang'] = in_array($lang, ['arabic', 'english']) ? $lang : 'arabic';

		// echo (new \config\APP)->redirect($_SERVER['HTTP_REFERER']);
	}

}
