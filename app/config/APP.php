<?php

namespace config;

use Twig\Environment;
use \NoahBuscher\Macaw\Macaw;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Medians\Settings\Infrastructure\SettingsRepository;

use \Medians\Auth\Application\AuthService;


class APP 
{

	public $default_lang = 'arabic';

	public $lang_code = 'en';

	public $auth;

	public $branch;

	public $CONF;

	public $currentPage;

	public $Settings;



	function __construct()
	{

		$this->setLang();
		$this->currentPage = $this->request()->getPathInfo();

		$this->CONF = (new \config\Configuration())->getCONFArray();

		$this->branch = $this->active_branch();
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

		$check = !empty($this->auth) ? $this->auth : (new AuthService())->checkSession();
		$this->branch = isset($check->branch) ? $check->branch : null; 
		return $check;
	}

	public function active_branch()
	{
		$this->auth();

		return $this->branch;
	}

	public static function request()
	{
		return Request::createFromGlobals();
	}


	public static function redirect($url)
	{
		echo new RedirectResponse($url) ;
		die();
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
	* Return Administrator menu
	* List of side menu
	*/
	public function menu()
	{
		$user = $this->auth();

		if (empty($user))
			return null;

		if ($user->role_id === 1)
			return $this->masterMenu();
		else 
			return $this->adminMenu();
	}

	

	/**
	* Return Administrator menu
	* List of side menu
	*/
	public function masterMenu()
	{

		$data = array(
			array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
	        array('title'=>__('Branches'),  'icon'=>'fa-users', 'link'=>'admin/branches', 'component'=>'branches'),
			array('title'=>__('Plans'),  'icon'=>'fa-desktop', 'link'=>'admin/#plans', 'sub'=>
				[
	                array('title'=>__('plans'),  'icon'=>'', 'link'=>'admin/plans', 'component'=>'plans'),
	                array('title'=>__('plan_features'),  'icon'=>'', 'link'=>'admin/plan_features', 'component'=>'plan_features'),
	                array('title'=>__('plan_subscriptions'), 'icon'=>'', 'link'=>'admin/plan_subscriptions', 'component'=>'plan_subscriptions'),
			        array('title'=>__('payments'),  'icon'=>'fa-credit-card', 'link'=>'admin/payments', 'component'=>'payments'),
				]
			),

	        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'admin/index_users', 'component'=>'users'),
	        array('title'=>__('Customers'),  'icon'=>'fa-user', 'link'=>'admin/customers', 'component'=>'customers'),
			array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'admin/system_settings', 'component'=>'system_settings'),
			array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
		);

		return $data;
	}


	/**
	* Return Administrator menu
	* List of side menu
	*/
	public function adminMenu()
	{

		$data = array(
			array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
			array('title'=>__('Bookings'),  'icon'=>'fa-calendar', 'link'=>'#bookings', 'sub'=>
				[
					array('title'=>__('Calendar'),  'icon'=>'fa-dashboard', 'link'=>'admin/calendar'),
	                array('title'=>__('All bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?all=true', 'component'=>'devices_orders'),
	                array('title'=>__('Active bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=active', 'component'=>'devices_orders'),
	                array('title'=>__('Upcoming bookings'), 'icon'=>'fa-dashboard','link'=>'admin/devices_orders?status=new', 'component'=>'devices_orders'),
	                array('title'=>__('Completed bookings'), 'icon'=>'fa-dashboard','link'=>'admin/devices_orders?status=completed', 'component'=>'devices_orders'),
	                array('title'=>__('Paid bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=paid', 'component'=>'devices_orders'),
	                array('title'=>__('Canceled bookings'), 'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=canceled', 'component'=>'devices_orders'),
				]
			),
			array('title'=>__('Devices'),  'icon'=>'fa-desktop', 'link'=>'#devices', 'sub'=>
				[
	                array('title'=>__('manage devices'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices/manage', 'component'=>'manage_devices'),
	                array('title'=>__('games'),  'icon'=>'fa-dashboard', 'link'=>'admin/games'),
	                array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices/categories', 'component'=>'categories'),
				]
			),
	        array('title'=>__('Orders'),  'icon'=>'fa-file-invoice', 'link'=>'#invoices', 'sub'=>
	            [
	                array('title'=>__('Orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?all=true', 'component'=>'invoices'),
	                array('title'=>__('Paid orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?status=paid', 'component'=>'invoices'),
	                array('title'=>__('Refund orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?status=refund', 'component'=>'invoices'),
	            ]
	        ),
	        array('title'=>__('Products'),  'icon'=>'fa-shopping-cart', 'link'=>'#products', 'sub'=>
	            [
	                array('title'=>__('Products list'),  'icon'=>'fa-dashboard', 'link'=>'admin/products'),
	                array('title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/categories', 'component'=>'categories'),
	                array('title'=>__('Stock alert products'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/stock_alert', 'component'=>'products'),
	                array('title'=>__('Stock out products'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/stock_out', 'component'=>'products'),
	            ]
	        ),
	        array('title'=>__('Stock'),  'icon'=>'fa-warehouse', 'link'=>'admin/stock' , 'component'=>'stock'),
	        array('title'=>__('Expenses'),  'icon'=>'fa-credit-card', 'link'=>'admin/expenses', 'component'=>'expenses'),
	        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'admin/users', 'component'=>'users'),
	        array('title'=>__('Customers'),  'icon'=>'fa-user', 'link'=>'admin/customers', 'component'=>'customers'),
	        array('title'=>__('Branches'),  'icon'=>'fa-users', 'link'=>'admin/branches', 'component'=>'branches'),
			array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'admin/settings', 'component'=>'settings'),
			array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
		);

		return $data;
	}

	
}