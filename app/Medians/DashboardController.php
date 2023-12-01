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
	public  $RouteRepository;
	public  $DriverRepository;
	public  $PickupLocationRepository;
	public  $VehicleRepository;
	public  $StudentRepository;
	public  $HelpMessageRepository;

	protected $app;
	public $start;
	public $end;
	public $month_first;
	

	function __construct()
	{
		$this->app = new \config\APP;
		
		$this->contentRepo = new Content\Infrastructure\ContentRepository();
		$this->TripRepository = new Trips\Infrastructure\TripRepository();
		$this->VehicleRepository = new Vehicles\Infrastructure\VehicleRepository();
		$this->RouteRepository = new Routes\Infrastructure\RouteRepository();
		$this->DriverRepository = new Drivers\Infrastructure\DriverRepository();
		$this->PickupLocationRepository = new Locations\Infrastructure\PickupLocationRepository();
		$this->StudentRepository = new Students\Infrastructure\StudentRepository();
		$this->HelpMessageRepository = new Help\Infrastructure\HelpMessageRepository();

		$this->start = $this->app->request()->get('start') ? date('Y-m-d', strtotime($this->app->request()->get('start'))) : date('Y-m-d');
		$this->end = $this->app->request()->get('end') ? date('Y-m-d', strtotime($this->app->request()->get('end'))) : date('Y-m-d');
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

			$trips_charts = $this->TripRepository->getByDateCharts(['start'=>$this->app->request()->get('start') ? $this->start : $this->month_first, 'end'=>$this->end]);

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

        $data['active_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('trip_status', 'Scheduled')->count();
        $data['completed_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('trip_status', 'Completed')->count();
        $data['total_trips_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['drivers_count'] = $this->DriverRepository->get()->count();
        $data['routes_count'] = $this->RouteRepository->get()->count();
        $data['pickup_locations_count'] = $this->PickupLocationRepository->get()->count();
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
