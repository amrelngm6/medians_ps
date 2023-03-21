<?php

namespace Medians;


class DashboardController
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
			
	        return  render('views/admin/dashboard/index.html.twig', $this->data());
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


	/**
	 * Model object 
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
	 * Model object 
	 */
	public function data()
	{

		try {
			
			$DevicesRepository = new Devices\Infrastructure\DevicesRepository($this->app);

			$today_revenue = (new Orders\Infrastructure\OrdersRepository($this->app))->getByDate(['start'=>date('Y-m-d 00:00:00'), 'end'=>date('Y-m-d 23:59:59')])->sum('total_cost');

			$today_payments = (new Payments\Infrastructure\PaymentsRepository($this->app))->getByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->sum('amount');
            
            $latest_order_products =  (new Products\Infrastructure\StockRepository($this->app))->getLatest(5)->get();


            $today_order_products_count =  (new Products\Infrastructure\StockRepository($this->app))->getLatest(1000)->where('type', 'pull')->where('date', date('Y-m-d'))->count();
            
            $latest_unpaid_order_devices = $DevicesRepository->eventsByDate(['start'=>date('Y-m-d'),'end'=>date('Y-m-d')],5)->where('status','!=','paid')->get();

            $latest_paid_order_devices =  $DevicesRepository->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')], 5)->where('status', 'paid')->get();

            $today_orders_count = $DevicesRepository->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'paid')->groupBy('order_code')->count();

            $active_order_devices_count = $DevicesRepository->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'active')->count();

            $today_order_devices_count = $DevicesRepository->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->count();

	        return [
	            'title' => 'Dashboard',
	            'active_order_devices_count' => $active_order_devices_count,
	            'today_order_devices_count' => $today_order_devices_count,
	            'today_orders_count' => $today_orders_count,
	            'latest_paid_order_devices' => $latest_paid_order_devices,
	            'latest_unpaid_order_devices' => $latest_unpaid_order_devices,
	            'latest_order_products' => $latest_order_products,
	            'today_order_products_count' => $today_order_products_count,
	            'today_revenue' => round($today_revenue, 2),
	            'today_payments' => round($today_payments, 2),
		        'formAction' => '/login',
	            // 'formAction' => $this->app->CONF['url'],
	        ];
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


}
