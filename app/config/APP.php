<?php

namespace config;

use Twig\Environment;
use \NoahBuscher\Macaw\Macaw;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Medians\Settings\Infrastructure\SettingsRepository;



class APP 
{

	public $default_lang = 'arabic';

	public $lang_code = 'en';
	// public $auth;

	public $branch;

	public $CONF;

	public $currentPage;

	public $Settings;



	function __construct()
	{

		$this->setLang();
		$this->currentPage = $this->request()->getPathInfo();

		$this->CONF = (new \config\Configuration())->getCONFArray();

		$this->branch =  (object) array('id'=>1);

	}

	public function setLang()
	{
		if (isset($_SERVER['HTTP_REFERER']))
		{
			$arr = explode('/', $_SERVER['HTTP_REFERER']);

			if (in_array(end($arr), ['arabic', 'english']))
			{
				$_SESSION['site_lang'] = end($arr);
				$_SESSION['lang'] = end($arr);
			}
		}
		
		$_SESSION['lang'] = isset($_SESSION['site_lang']) ? $_SESSION['site_lang'] : $this->lang_code;

	}

	public function specializations()
	{
		return  (new \Medians\Specializations\Infrastructure\SpecializationRepository())->get_root();
	}

	public function Settings()
	{
		return  (new \Medians\Settings\Application\SettingsController())->getAll();
	}

	public function setting($code)
	{
		return (new SettingsRepository)->getByCode($code);
	}

	public function auth()
	{
		return (new \Medians\Auth\Application\AuthService( new \Medians\Users\Infrastructure\UserRepository($this), $this ))->checkSession();
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
	 * Template for Twig render 
	 */
	public function renderTemplate($code, $data=null)
	{
		$twig = $this->template()->createTemplate($code);

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
			array('title'=>__('Bookings'),  'icon'=>'fa-calendar', 'link'=>'#bookings', 'sub'=>
				[
					array('title'=>__('Calendar'),  'icon'=>'fa-dashboard', 'link'=>'calendar'),
	                array('title'=>__('All bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices_orders?all=true', 'component'=>'devices_orders'),
	                array('title'=>__('Active bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices_orders?status=active', 'component'=>'devices_orders'),
	                array('title'=>__('Upcoming bookings'), 'icon'=>'fa-dashboard','link'=>'devices_orders?status=new', 'component'=>'devices_orders'),
	                array('title'=>__('Completed bookings'), 'icon'=>'fa-dashboard','link'=>'devices_orders?status=completed', 'component'=>'devices_orders'),
	                array('title'=>__('Paid bookings'),  'icon'=>'fa-dashboard', 'link'=>'devices_orders?status=paid', 'component'=>'devices_orders'),
	                array('title'=>__('Canceled bookings'), 'icon'=>'fa-dashboard', 'link'=>'devices_orders?status=canceled', 'component'=>'devices_orders'),
				]
			),
			array('title'=>__('Devices'),  'icon'=>'fa-desktop', 'link'=>'#devices', 'sub'=>
				[
	                array('title'=>__('manage devices'),  'icon'=>'fa-dashboard', 'link'=>'devices/manage', 'component'=>'manage_devices'),
	                // array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'devices/categories'),
	                array('title'=>__('games'),  'icon'=>'fa-dashboard', 'link'=>'games'),
				]
			),
	        array('title'=>__('Products'),  'icon'=>'fa-shopping-cart', 'link'=>'#products', 'sub'=>
	            [
	                array('title'=>__('Products list'),  'icon'=>'fa-dashboard', 'link'=>'products'),
	                array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'products/categories', 'component'=>'categories'),
	                array('title'=>__('Stock alert products'),  'icon'=>'fa-dashboard', 'link'=>'products/stock_alert', 'component'=>'products'),
	                array('title'=>__('Stock out products'),  'icon'=>'fa-dashboard', 'link'=>'products/stock_out', 'component'=>'products'),
	            ]
	        ),
	        array('title'=>__('Stock'),  'icon'=>'fa-warehouse', 'link'=>'stock' , 'component'=>'stock'),
	        array('title'=>__('Orders'),  'icon'=>'fa-file-invoice', 'link'=>'#invoices', 'sub'=>
	            [
	                array('title'=>__('Orders'),  'icon'=>'fa-dashboard', 'link'=>'invoices?all=true', 'component'=>'invoices'),
	                array('title'=>__('Paid orders'),  'icon'=>'fa-dashboard', 'link'=>'invoices?status=paid', 'component'=>'invoices'),
	                array('title'=>__('Refund orders'),  'icon'=>'fa-dashboard', 'link'=>'invoices?status=refund', 'component'=>'invoices'),
	            ]
	        ),
	        array('title'=>__('Payments'),  'icon'=>'fa-credit-card', 'link'=>'payments', 'component'=>'payments'),
	        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'users', 'component'=>'users'),
	        array('title'=>__('Customers'),  'icon'=>'fa-user', 'link'=>'customers', 'component'=>'customers'),
	        // array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'#users', 'sub'=>
	        //     [
	        //         array('title'=>__('Users'),  'icon'=>'fa-dashboard', 'link'=>'users/'),
	        //         array('title'=>__('add_User'),  'icon'=>'fa-dashboard', 'link'=>'users/create'),
	        //     ]
	        // ),


			array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'settings', 'component'=>'settings'),
			array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
		);

		return $data;
	}

	
}