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
	public  $RouteLocationRepository;
	public  $VehicleRepository;
	public  $StudentRepository;
	public  $HelpMessageRepository;
	public  $BusinessApplicantRepository;

	protected $app;
	public $start;
	public $end;
	public $month_first;
	

	function __construct()
	{
		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->contentRepo = new Content\Infrastructure\ContentRepository($user->business);
		$this->TripRepository = new Trips\Infrastructure\TripRepository($user->business);
		$this->PrivateTripRepository = new Trips\Infrastructure\PrivateTripRepository($user->business);
		$this->VehicleRepository = new Vehicles\Infrastructure\VehicleRepository($user->business);
		$this->RouteRepository = new Routes\Infrastructure\RouteRepository($user->business);
		$this->DriverRepository = new Drivers\Infrastructure\DriverRepository($user->business);
		$this->RouteLocationRepository = new Locations\Infrastructure\RouteLocationRepository($user->business);
		$this->StudentRepository = new Students\Infrastructure\StudentRepository($user->business);
		$this->HelpMessageRepository = new Help\Infrastructure\HelpMessageRepository($user->business);
		$this->BusinessApplicantRepository = new Customers\Infrastructure\BusinessApplicantRepository($user->business);

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
			
			// Name of the Vue components
	        return  render('dashboard', $this->data());
	        
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

			// $trips_charts = $this->TripRepository->getByDateCharts(['start'=>$this->app->request()->get('start') ? $this->start : $this->month_first, 'end'=>$this->end]);
			$trips_charts = $this->TripRepository->getAllByDateCharts(['start'=>$this->app->request()->get('start') ? $this->start : $this->month_first, 'end'=>$this->end]);

			$counts = $this->loadCounts();
            /**
            * Order repository to get
            * Sales for last ( 90 ) Days
            */ 

	        $array = [
	            'title' => 'Dashboard',
		        'load_vue' => true,
				'trips_charts'=>$trips_charts
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

        $data['active_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('status', 'scheduled')->count();
        $data['private_trips_count'] = $this->PrivateTripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['total_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['business_applicant_count'] = $this->BusinessApplicantRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['drivers_count'] = $this->DriverRepository->get()->count();
        $data['routes_count'] = $this->RouteRepository->get()->count();
        $data['route_locations_count'] = $this->RouteLocationRepository->get()->count();
        $data['vehicles_count'] = $this->VehicleRepository->get()->count();
        $data['top_drivers'] = $this->DriverRepository->mostTrips(5);
        $data['top_drivers_list'] = $this->DriverRepository->topDrivers(5);
        $data['latest_students'] = $this->StudentRepository->get(5);
        $data['latest_help_messages'] = $this->HelpMessageRepository->load(5);

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
        $data['latest_help_messages'] = $this->HelpMessageRepository->load(5);

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
