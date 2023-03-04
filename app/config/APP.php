<?php

namespace config;

use Twig\Environment;
use \NoahBuscher\Macaw\Macaw;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use \Medians\Application as apps;

use \Medians\Infrastructure\Settings\SettingsRepository;



class APP 
{

	// public $auth;

	public $branch;

	public $CONF;

	public $currentPage;

	public $Settings;



	function __construct()
	{
		$this->currentPage = $this->request()->getPathInfo();

		$this->CONF = (new apps\Configuration())->getCONFArray();

		$this->branch = isset($this->auth()->branch) ? $this->auth()->branch : null;

	}

	public function Settings()
	{
		return  (new apps\Settings\SettingsController())->getAll();
	}

	public function setting($code)
	{
		return (new SettingsRepository)->getByCode($code);
	}

	public function auth()
	{
		return (new apps\Auth\AuthService( new \Medians\Infrastructure\Users\UserRepository($this), $this ))->checkSession();
	}

	public static function request()
	{
		return Request::createFromGlobals();
	}


	public static function redirect($url)
	{
		return new RedirectResponse($url);
	}

	public function  run()
	{
		Macaw::dispatch();

		return true;

	}


	/**
	 * Template for Twig render 
	 */
	public function template()
	{
		$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('./app'), 
		    [
		        //'cache' => '/app/cache',
		        'debug' => true,
		    ]
		);

		$twig->addFilter(new \Twig\TwigFilter('html_entity_decode', 'html_entity_decode'));

		return $twig;
	}

	
	/**
	* Return 
	* List of side menu
	*/
	public function menu()
	{
		$data = array(
			array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
			array('title'=>__('Bookings'),  'icon'=>'fa-calendar', 'link'=>'', 'sub'=>
				[
					array('title'=>__('Calendar'),  'icon'=>'fa-dashboard', 'link'=>'devices/calendar2'),
	                array('title'=>__('All bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders'),
	                array('title'=>__('Active bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=active'),
	                array('title'=>__('Completed bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=completed'),
	                array('title'=>__('Paid bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices/orders?status=paid'),
				]
			),
			array('title'=>__('Devices'),  'icon'=>'fa-desktop', 'link'=>'', 'sub'=>
				[
	                array('title'=>__('manage devices'),  'icon'=>'fa-dashboard', 'link'=>'devices/manage'),
	                array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'devices/categories'),
	                array('title'=>__('games'),  'icon'=>'fa-dashboard', 'link'=>'games'),
				]
			),
	        array('title'=>__('Products'),  'icon'=>'fa-shopping-cart', 'link'=>'', 'sub'=>
	            [
	                array('title'=>__('Products list'),  'icon'=>'fa-dashboard', 'link'=>'products/index'),
	                array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'products/categories'),
	            ]
	        ),
	        array('title'=>__('Stock'),  'icon'=>'fa-warehouse', 'link'=>'', 'sub'=>
	            [
	                array('title'=>__('Stock log'),  'icon'=>'fa-dashboard', 'link'=>'stock/index'),
	                array('title'=>__('Stock alert products'),  'icon'=>'fa-dashboard', 'link'=>'products/stock_alert'),
	                array('title'=>__('Stock out products'),  'icon'=>'fa-dashboard', 'link'=>'products/stock_out'),
	            ]
	        ),
	        array('title'=>__('Orders'),  'icon'=>'fa-file-invoice', 'link'=>'', 'sub'=>
	            [
	                array('title'=>__('Orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index'),
	                array('title'=>__('Paid orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=paid'),
	                array('title'=>__('Refund orders'),  'icon'=>'fa-dashboard', 'link'=>'orders/index?status=refund'),
	            ]
	        ),
	        array('title'=>__('Payments'),  'icon'=>'fa-credit-card', 'link'=>'payments'),
	        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'', 'sub'=>
	            [
	                array('title'=>__('Users'),  'icon'=>'fa-dashboard', 'link'=>'users/'),
	                array('title'=>__('add_User'),  'icon'=>'fa-dashboard', 'link'=>'users/create'),
	            ]
	        ),


			array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'settings'),
			array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
		);

		return $data;
	}

}