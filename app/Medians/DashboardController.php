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
		
		// $this->checkBranch();

        $this->OrderRepository = new Orders\Infrastructure\OrdersRepository;

		$this->DevicesRepository = new Devices\Infrastructure\DevicesRepository();

		$this->OrderDevicesRepository = new Devices\Infrastructure\OrderDevicesRepository;

		$this->StockRepository = new Products\Infrastructure\StockRepository;

		$this->ExpensesRepository = new Expenses\Infrastructure\ExpensesRepository;

		$this->GamesRepository = new Games\Infrastructure\GameRepository();

		$this->start = $this->app->request()->get('start') ? date('Y-m-d 00:00:00', strtotime($this->app->request()->get('start'))) : date('Y-m-d 00:00:00');
		$this->end = $this->app->request()->get('end') ? date('Y-m-d 23:59:59', strtotime($this->app->request()->get('end'))) : date('Y-m-d 23:59:59');


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
			
			$list = $this->loadList();

			$counts = $this->loadCounts();

			$values = $this->loadValues();


            /**
            * Order repository to get
            * Sales for last ( 90 ) Days
            */ 

            $orders_charts = !$this->app->request()->get('start') || $this->app->request()->get('start') == 'today' 
            ? $this->OrderRepository->getByDateCharts(['start'=>date('Y-m-d', strtotime('-7 days', strtotime($this->start))), 'end'=>$this->end])
            : $this->OrderRepository->getByDateCharts(['start'=>$this->start, 'end'=>$this->end])
            ;

            // $ExpensesRepo = new Expenses\Infrastructure\ExpensesRepository;
            // $expenses_charts = $ExpensesRepo->getByDateCharts(['start'=>$this->start, 'end'=>$this->end]);

	        return [
	            'title' => 'Dashboard',
	            'active_order_devices_count' => $counts['active_order_devices_count'],
	            'order_devices_count' => $counts['order_devices_count'],
	            'orders_count' => $counts['orders_count'],
	            'order_products_count' => $counts['order_products_count'],
	            'avg_bookings_count' => $counts['avg_bookings_count'],
	            'avg_products_count' => $counts['avg_products_count'],
	            'latest_paid_order_devices' => $list['latest_paid_order_devices'],
	            'latest_unpaid_order_devices' => $list['latest_unpaid_order_devices'],
	            'latest_order_products' => $list['latest_order_products'],
	            'order_products_revenue' => $values['order_products_revenue'],
	            'avg_sales' => $values['avg_sales'],
	            'avg_bookings' => $values['avg_bookings'],
	            'income' => round($values['income'], 2),
	            'bookings_income' => round($values['bookings_income'], 2),
	            'revenue' => round(round($values['income'], 2) - round($values['expenses'], 2) - round($values['tax'], 2), 2),
	            'expenses' => round($values['expenses'], 2),
	            'tax' => round($values['tax'], 2),
	            'most_played_games' => $this->GamesRepository->mostPlayed(['start'=>$this->start, 'end'=>$this->end]),
	            'most_played_devices' => $this->DevicesRepository->mostPlayed(['start'=>$this->start, 'end'=>$this->end]),
	            'orders_charts' => $orders_charts,
	            // 'expenses_charts' => $expenses_charts,
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

        $data['orders_count'] = $this->DevicesRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('status', 'paid')->groupBy('order_code')->count();

        $data['active_order_devices_count'] = $this->DevicesRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->where('status', 'active')->count();

        $data['order_devices_count'] = $this->DevicesRepository->eventsByDate(['start'=>$this->start, 'end'=>$this->end])->count();

        $data['order_products_count'] =  $this->StockRepository->getByBranch(1000)->where('type', 'pull')->where('date' ,'>=', $this->start)->count();

		$data['avg_bookings_count'] = $this->OrderDevicesRepository->getAVGBookingsCountByBranch(['start'=>$this->start, 'end'=>$this->end]);

		$data['avg_products_count'] = $this->OrderDevicesRepository->getAVGProductsCount(['start'=>$this->start, 'end'=>$this->end]);

        return $data;

	}  


	/**
	 * Load sum values 
	 */
	public function loadValues()
	{

		$data = [];

		$data['bookings_income'] = $this->OrderDevicesRepository->loadBookingsIncome(['start'=>$this->start, 'end'=>$this->end]);

        $data['order_products_revenue'] =  $this->OrderDevicesRepository->loadProductsIncome(['start'=>$this->start, 'end'=>$this->end]);

		$data['income'] = $this->DevicesRepository->getSumByDate('subtotal', $this->start, $this->end);

		$data['tax'] = $this->DevicesRepository->getSumByDate('tax', $this->start, $this->end);

		$data['expenses'] = $this->ExpensesRepository->getSumByDate('amount', $this->start, $this->end);
        
		$data['avg_sales'] = $this->OrderRepository->getAVGSales(['start'=>$this->start, 'end'=>$this->end]);

		$data['avg_bookings'] = $this->OrderDevicesRepository->getAVGBookings(['start'=>$this->start, 'end'=>$this->end]);

        return $data;

	}  


	/**
	 * Load Items List statstics
	 */
	public function loadList()
	{

		$data = [];

        $data['latest_order_products'] =  $this->StockRepository->getLatest(5)->whereBetween('date',[$this->start, $this->end])->get();
        
        $data['latest_paid_order_devices'] =  $this->DevicesRepository->eventsByDate(['start'=>$this->start,'end'=>$this->end], 5)
        ->where('status', 'paid')
		->limit(5)
		->orderBy('id', 'DESC')->groupBy('device_id')->get();

        $data['latest_unpaid_order_devices'] = $this->DevicesRepository->eventsByDate(['start'=>$this->start,'end'=>$this->end],5)->where('status','!=','paid')->get();

        return $data;

	}  
}
