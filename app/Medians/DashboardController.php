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

	protected $app;
	public $start;
	public $end;
	

	function __construct()
	{
		$this->app = new \config\APP;
		
		$this->contentRepo = new Content\Infrastructure\ContentRepository();
		$this->TripRepository = new Trips\Infrastructure\TripRepository();
		$this->VehicleRepository = new Vehicles\Infrastructure\VehicleRepository();
		$this->RouteRepository = new Routes\Infrastructure\RouteRepository();
		$this->DriverRepository = new Drivers\Infrastructure\DriverRepository();
		$this->PickupLocationRepository = new Locations\Infrastructure\PickupLocationRepository();

		$this->start = $this->app->request()->get('start') ? date('Y-m-d', strtotime($this->app->request()->get('start'))) : date('Y-m-d');
		$this->end = $this->app->request()->get('end') ? date('Y-m-d', strtotime($this->app->request()->get('end'))) : date('Y-m-d');

	}

	/**
	 * Load dashboard page
	 * 
	 * @return response for Vue  
	 */
	public function index()
	{
		$this->checkBranch();

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
			
			$counts = $this->loadCounts();
            /**
            * Order repository to get
            * Sales for last ( 90 ) Days
            */ 

	        $array = [
	            'title' => 'Dashboard',
		        'load_vue' => true,
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
        $data['help_messages_count'] = $this->TripRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['drivers_count'] = $this->DriverRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['routes_count'] = $this->RouteRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['pickup_locations_count'] = $this->PickupLocationRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        $data['vehicles_count'] = $this->VehicleRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();

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

		$object = $this->contentRepo->find(urldecode($prefix));
		if (empty($object)){
			echo (new \config\APP)->redirect('/'.$prefix); 
			return true;
		}

		$item = $this->contentRepo->switch_lang($object);

		echo (new \config\APP)->redirect('/'.$item->prefix); 
		
		$_SESSION['site_lang'] = in_array($lang, ['arabic', 'english']) ? $lang : 'arabic';

		// echo (new \config\APP)->redirect($_SERVER['HTTP_REFERER']);
	}

}
