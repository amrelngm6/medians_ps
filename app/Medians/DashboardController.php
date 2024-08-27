<?php

namespace Medians;

use \Shared\dbaser\CustomController;
use \Medians\Views\Domain\View;
use \Medians\Visits\Domain\Visit;
use Illuminate\Database\Capsule\Manager as DB;

class DashboardController extends CustomController
{

	/**
	* @var Object
	*/
	protected $app;

	public  $contentRepo;
	public  $BookingRepository;
	public  $DoctorRepo;

	public $start;
	public $end;
	public $month_first;
	public $durationDays;
	

	function __construct()
	{
		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->contentRepo = new Content\Infrastructure\ContentRepository();
		$this->DoctorRepo = new Doctors\Infrastructure\DoctorRepository();
		$this->BookingRepository = new Bookings\Infrastructure\BookingRepository();

		
		$setting = $this->app->SystemSetting();
		$defaultStart = isset($setting['default_dashboard_start_date']) ? date('Y-'. $setting['default_dashboard_start_date']) : date('Y-m-d');
		$this->start = $this->app->request()->get('start_date') ? date('Y-m-d', strtotime($this->app->request()->get('start_date'))) : $defaultStart;
		$this->end = $this->app->request()->get('end_date') ? date('Y-m-d', strtotime($this->app->request()->get('end_date'))) : date('Y-m-d');
		$this->end = date('Y-m-d', strtotime($this->end. ' + 1 days'));

		$durationDays = (new \DateTime($this->end))->diff(new \DateTime($this->start));
		$this->durationDays = $durationDays->d + ($durationDays->m); 
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

			$counts = $this->loadCounts();

			$array = [
	            'title' => 'Dashboard',
		        'load_vue' => true,
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

			$counts = $this->loadMasterCounts();

			$array = [
	            'title' => 'Master Dashboard',
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

        $data['bookings_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'type' => 'Booking'])->count();
        // $data['help_messages_count'] = $this->HelpMessageRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        // $data['latest_help_messages'] = $this->HelpMessageRepository->load(5);
        // $data['invoices_count'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();
        // $data['total_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->sum('total_amount');
        // $data['payment_methods_invoices_amount'] = $this->InvoiceRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->selectRaw('SUM(total_amount) as value, payment_method')->groupBy('payment_method')->get();
        // $data['latest_invoices'] = $this->InvoiceRepository->get(5);
        // $data['latest_transactions'] = $this->TransactionRepository->get(5);
        // $data['transactions_count'] = $this->TransactionRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();

        return $data;

	}  


	
	/**
	 * Load countable statstics
	 */
	public function loadMasterCounts()
	{
		$data = [];

        $data['visits_countries'] = array_column(Visit::totalVisits($this->start, $this->end)->select('iso_code', DB::raw('count(*) as total'))->orderBy('updated_at', 'desc')->groupBy('iso_code')->get()->toArray(), 'total', 'iso_code');
        $data['latest_visits'] = View::totalViews($this->start, $this->end)->with('item')->orderBy('updated_at', 'desc')->limit(5)->get();
        $data['top_visits'] = View::totalViews($this->start, $this->end)->with('item')->orderBy('times', 'desc')->limit(5)->get();
        $data['total_visits'] = View::totalViews($this->start, $this->end)->sum('times');
        $data['doctors_count'] = $this->DoctorRepo->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->orderBy('id', 'desc')->limit(10)->get();
        $data['latest_bookings'] = $this->BookingRepository->allEventsByDate(['start'=>$this->start, 'end'=>$this->end])->orderBy('id', 'desc')->limit(10)->get();
        $data['bookings_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'class' => 'Booking'])->count();
        $data['doctors_bookings_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'class' => 'Doctor'])->count();
        $data['contacts_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'class' => 'Contact'])->count();
        $data['offers_bookings_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'class' => 'Offers'])->count();
        $data['onlineconsultation_bookings_count'] = $this->BookingRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end, 'class' => 'OnlineConsultation'])->count();
        $data['bookings_charts_sql'] = $this->BookingRepository->allEventsByDate((['start'=>$this->start, 'end'=>$this->end]))->selectRaw('DATE(created_at) as label, class, COUNT(*) as y')->having('y', '>', 0)->orderBy('label', 'desc')->groupBy('label')->toSql();
        $data['bookings_charts'] = $this->BookingRepository->allEventsByDate((['start'=>$this->start, 'end'=>$this->end]))->selectRaw('DATE(created_at) as label, class, COUNT(*) as y')->having('y', '>', 0)->orderBy('label', 'desc')->groupBy('label','class')->get();
        
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

	
	// public function switchLang($lang)
	// {
	// 	$app = new \config\APP;
	// 	$languages = array_column($app->Languages()->toArray(), 'language_code');

	// 	$_SESSION['site_lang'] = in_array($lang, $languages) ? $lang : 'english';
	// 	$_SESSION['lang'] = in_array($lang, $languages) ? $lang : 'english';

	// 	echo $app->redirect($redirect);
	// }

	
	public function switchLang($lang)
	{
		$app = (new \config\APP);
		
		$languages = array_column($app->Languages()->toArray(), 'language_code');

		if (empty($_SERVER['HTTP_REFERER'])) {
			echo $app->redirect('/');
			return null;
		}

		$prefix = str_replace($this->app->CONF['url'], '', $_SERVER['HTTP_REFERER']);

		if (empty($prefix))
		{
			echo $app->redirect('/'); 
			return true;
		}

		$object = $this->contentRepo->find(urldecode($prefix));
		if (empty($object)){
			echo $app->redirect('/'.$prefix); 
			return true;
		}



		$item = $this->contentRepo->switch_lang($object, $lang);

		$newPrefix = isset($item->prefix) ? "/$item->prefix" : $_SERVER['HTTP_REFERER'];

		$_SESSION['site_lang'] = in_array($lang, $languages) ? $lang : 'arabic';

		$redirectRequest = $app->request()->get('redirect') ?? null;
		$redirect = !empty($redirectRequest) ? $app->CONF['url'].$redirectRequest : $newPrefix;

		echo $app->redirect($redirect);


	}
}
