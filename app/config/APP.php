<?php

namespace config;

use Twig\Environment;
use \Shared\RouteHandler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Medians\Settings\Infrastructure\SettingsRepository;

use \Medians\Auth\Application\AuthService;


class APP 
{

	public $default_lang = 'english';

	public $lang_code = 'english';

	public $lang;

	public $auth;

	public $hasBranches = false;

	public $CONF;

	public $currentPage;

	public $capsule;

	public $session;
	
	public $setting;


	function __construct()
	{

		// $this->setLang(); // Set the active language 

		$this->currentPage = $this->request()->getPathInfo(); // Filter the request URI to get the current page

		$this->CONF = (new \config\Configuration())->getCONFArray();  // Load configuration as Array

		$this->capsule = (new \config\Configuration())->checkDB(); // Check database connection

		$this->auth(); // Check active secttion

	}

	public function setLang()
	{
		if (!empty($this->request()->headers->get('lang')))
		{
			$_SESSION['site_lang'] = $this->request()->headers->get('lang');
			$_SESSION['lang'] = $this->request()->headers->get('lang');
		}

		if (isset($_SERVER['HTTP_REFERER']))
		{
			$arr = explode('/', $_SERVER['HTTP_REFERER']);

			if (in_array(end($arr), array_column($this->Languages()->toArray(), 'language_code') ))
			{
				$_SESSION['site_lang'] = end($arr);
				$_SESSION['lang'] = end($arr);
			}
		}
		
		$_SESSION['lang'] = isset($_SESSION['site_lang']) ? $_SESSION['site_lang'] : $this->lang_code;
		$this->lang = $_SESSION['lang']; // Check active language

		return $this;
	}



	/**
	 * Load Sysetem Settings
	 */ 
	public function SystemSetting()
	{
		$output = (new \Medians\Settings\Application\SystemSettingsController())->getAll();
		return $output;
	}

	/**
	 * Load languages
	 */ 
	public function Languages()
	{
		$output = (new \Medians\Languages\Application\LanguageController())->getAll();
		return $output;
	}
	

	/**
	 * Get setting value by code 
	 * return value
	 */ 
	public function setting($code)
	{
		return (new SettingsRepository)->getByCode($code);
	}

	public function auth()
	{
		
		$request = Request::createFromGlobals();
		
		$this->session = !empty($this->session) ? $this->session : (new AuthService())->checkSession();

		return $this->session ? $this->session : $this->checkAPISession();
	}

	/**
	 * Check if the request is through mobile
	 */
	public function checkAPISession()
	{
		if (!empty($this->request()->headers->get('token')))
		{
			return  (new AuthService())->checkAPISession($this->request()->headers->get('token'), $this->request()->headers->get('userType'));
		}
	}  


	public static function request()
	{
		return Request::createFromGlobals();
	}

	/**
	 * Load all request [params] parameter
	 * Used in most of the request
 	 */
	public function params()
	{
		$params = $this->request()->get('params');
		if (!$params)
			return;

		return sanitizeInput(is_array($params) ? $params : (array) json_decode($params));
	}
  
	public static function redirect($url)
	{
		echo "<img width='100%' src='/uploads/img/redirect.gif' /><style>*{margin:0;color:#fff; overflow:hidden}</style>";
		echo new RedirectResponse($url);
		exit();
	}

	public function  run()
	{
		RouteHandler::dispatch();

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
	public function renderTemplate($code)
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

		if ($user->role_id == 1)
			return $this->superAdminMenu();
			
		return $this->checkMenuAccess($this->adminMenu(), $user);
	}

	
	/**
	 * Return Administrator menu
	 * List of side menu
	 */
	public function adminMenu()
	{
		$user = $this->auth();

		$data = array(
			
			array('permission'=> 'Dashboard.index', 'title'=>translate('Dashboard'), 'icon'=>'airplay', 'link'=>'dashboard', 'component'=>'dashboard'),
			
			array('title'=>translate('Customers'),  'icon'=>'user', 'link'=>'#customers', 'sub'=>
			[
				array('permission'=>'Parents.index', 'title'=>translate('Parents'),  'icon'=>'user', 'link'=>'admin/parents', 'component'=>'data_table'),
				array('permission'=>'Students.index', 'title'=>translate('Students'),  'icon'=>'user', 'link'=>'admin/students', 'component'=>'data_table'),
				array('permission'=>'Employees.index', 'title'=>translate('Employees'),  'icon'=>'user', 'link'=>'admin/employees', 'component'=>'data_table'),
			]
			),
			
			array('title'=>translate('Crew'),  'icon'=>'users', 'link'=>'#crew', 'sub'=>
			[
				array('permission'=>'Drivers.index', 'title'=>translate('Drivers'),  'icon'=>'users', 'link'=>'admin/drivers', 'component'=>'drivers'),
				array('permission'=>'SuperVisors.index', 'title'=>translate('Supervisors'),  'icon'=>'users', 'link'=>'admin/supervisors', 'component'=>'supervisors'),
			]
			),

			array('title'=>translate('Routes'),  'icon'=>'map', 'link'=>'#route', 'sub'=>
			[
				array('permission'=>'Routes.index', 'title'=>translate('Routes'),  'icon'=>'map', 'link'=>'admin/routes', 'component'=>'routes'),
				array('permission'=>'RouteLocations.index', 'title'=>translate('Locations'),  'icon'=>'map', 'link'=>'admin/locations', 'component'=>'locations'),
				]
			),
			
			array('title'=>translate('Trips'),  'icon'=>'map-pin', 'link'=>'#TaxiTrips', 'sub'=>
			[
				array('permission'=>'Trips.index', 'title'=>translate('Route trips'),  'icon'=>'map-pin', 'link'=>'admin/trips', 'component'=>'trips'),
				array('permission'=>'TaxiTrips.index', 'title'=>translate('Taxi Trips'),  'icon'=>'map', 'link'=>'admin/taxi_trips', 'component'=>'taxi_trips'),
			]
			),

			array('title'=>translate('Vehicles'),  'icon'=>'truck', 'link'=>'#vehicles', 'sub'=>
			[
				array('permission'=>'Vehicles.index', 'title'=>translate('Vehicles'),  'icon'=>'truck', 'link'=>'admin/vehicles', 'component'=>'vehicles'),
				array('permission'=>'VehicleTypes.index', 'title'=>translate('Vehicle Types'),  'icon'=>'truck', 'link'=>'admin/vehicle_types', 'component'=>'vehicle_types'),
			]
			),
			array('title'=>translate('Applicants'),  'icon'=>'file', 'link'=>'#applicants', 'sub'=>
			[
				array('permission'=>'DriverApplicants.index', 'title'=>translate('Driver applicants'),  'icon'=>'users', 'link'=>'admin/driver_applicants', 'component'=>'data_table'),
				array('permission'=>'StudentApplicants.index', 'title'=>translate('Students applicants'),  'icon'=>'credit-card', 'link'=>'admin/student_applicants', 'component'=>'data_table'),
			]
			),
			
			array('title'=>translate('Subscriptions'),  'icon'=>'cloud-lightning', 'link'=>'#packages', 'sub'=>
			[
				array('permission'=>'Packages.index', 'title'=>translate('Manage Packages'),  'icon'=>'credit-card', 'link'=>'admin/packages', 'component'=>'packages'),
				array('permission'=>'PackageSubscriptions.index', 'title'=>translate('Subscriptions'),  'icon'=>'credit-card', 'link'=>'admin/package_subscriptions', 'component'=>'package_subscriptions'),
				array('permission'=>'Vacations.index', 'title'=>translate('Vacations'),  'icon'=>'user', 'link'=>'admin/vacations', 'component'=>'vacations')
			]
			),
			

			array('title'=>translate('Finance'),  'icon'=>'credit-card', 'link'=>'#finance', 'sub'=>
			[
				array('permission'=> 'Transaction.index', 'title'=> translate('Transactions'), 'icon'=>'credit-card', 'link'=>'admin/transactions', 'component'=>'transactions'),
				array('permission'=> 'Invoice.index', 'title'=> translate('Invoices'), 'icon'=>'credit-card', 'link'=>'admin/invoices', 'component'=>'invoices'),
				array('permission'=> 'Withdrawals.index', 'title'=> translate('Withdrawals'), 'icon'=>'credit-card', 'link'=>'admin/withdrawals', 'component'=>'withdrawals'),
				array('permission'=> 'Wallets.index', 'title'=> translate('Wallets'), 'icon'=>'credit-card', 'link'=>'admin/wallets', 'component'=>'wallets'),
				array('permission'=> 'CollectedCash.index', 'title'=> translate('collected_cash'), 'icon'=>'credit-card', 'link'=>'admin/collected_cash', 'component'=>'collected_cash'),
				]
			),
			array( 'title'=>translate('Management'),  'icon'=>'tool', 'link'=>'#management', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=>'Gallery.index', 'title'=>translate('Gallery'),  'icon'=>'tool', 'link'=>'admin/gallery', 'component'=>'gallery'),
				array('permission'=>'HelpMessage.index', 'title'=>translate('Help Messages'),  'icon'=>'help-circle', 'link'=>'admin/help_messages', 'component'=>'help_messages'),
			]
			),
			array('permission'=>'Dashboard.index', 'title'=> translate('Logout'),  'icon'=>'log-out', 'link'=>'logout'),
		);

		return $data;
	}
	
	/**
	 * Return Superadmin menu
	 * List of side menu
	 */
	public function superAdminMenu()
	{
		
		$data = array(
			
			array('permission'=> 'Dashboard.index', 'title'=>translate('Dashboard'), 'icon'=>'airplay', 'link'=>'dashboard', 'component'=>'master_dashboard'),
			
			array('permission'=>'Leads.index', 'title'=>translate('Leads'),  'icon'=>'user', 'link'=>'admin/leads', 'component'=>'data_table'),

			array( 'title'=>translate('Users'),  'icon'=>'tool', 'link'=>'#users', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=>'User.index', 'title'=>translate('Users'),  'icon'=>'users', 'link'=>'admin/users', 'component'=>'users'),
				array('permission'=> 'Roles.index', 'title'=> translate('ROLES MANAEGMENT'),  'icon'=>'tool', 'link'=>'admin/roles', 'component'=>'roles'),
			]
			),
		
			array( 'title'=>translate('Management'),  'icon'=>'target', 'link'=>'#management', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=>'NotificationEvent.index', 'title'=>translate('notifications_events'),  'icon'=>'tool', 'link'=>'admin/notifications_events', 'component'=>'notifications_events'),
				array('permission'=>'EmailTemplate.index', 'title'=>translate('Email Templates'),  'icon'=>'tag', 'link'=>'admin/email_templates', 'component'=>'email_templates'),
				array('permission'=>'Event.index', 'title'=>translate('Events'),  'icon'=>'tag', 'link'=>'admin/events', 'component'=>'events'),
			]
			),

			array('permission'=>'HelpMessage.index', 'title'=>translate('Help Messages'),  'icon'=>'help-circle', 'link'=>'admin/help_messages', 'component'=>'help_messages'),

			array( 'title'=>translate('localization'),  'icon'=>'mic', 'link'=>'#localization', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=>'Language.index', 'title'=>translate('Languages'),  'icon'=>'tag', 'link'=>'admin/languages', 'component'=>'languages'),
				array('permission'=>'Translation.index', 'title'=>translate('Translations'),  'icon'=>'tag', 'link'=>'admin/translations', 'component'=>'translations'),
			]
			),
			array( 'title'=>translate('Settings'),  'icon'=>'tool', 'link'=>'#setting', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=> 'SystemSettings.index', 'title'=> translate('System Settings'),  'icon'=>'tool', 'link'=>'admin/system_settings', 'component'=>'system_settings'),
				array('permission'=> 'AppSettings.index', 'title'=> translate('APP Settings'),  'icon'=>'tool', 'link'=>'admin/parent_app_settings', 'component'=>'parent_app_settings'),
			]
			),
			
			array('permission'=>'Logout', 'title'=> translate('Logout'),  'icon'=>'log-out', 'link'=>'logout'),
		);

		return $data;
	}

	/**
	 * Check permission of the menu link
	 * @param String $permission
	 * @param Instance User $user
	 */
	public function checkMenuAccess($menu, $user)
	{
	
		$newMenu = [];
		if ($user->role_id > 1 )
		{
			foreach ($menu as $key => $item)
			{
				if (isset($item['sub'])) 
				{
					foreach ($item['sub'] as $k => $sub)
					{
						$newMenu[$key]['sub'][] = isset($user->permissions[$sub['permission']]) ? $sub : null;
					}
					$newMenu[$key]['sub'] = array_values(array_filter($newMenu[$key]['sub']));
					if (isset($newMenu[$key]['sub']))
					{
						$newMenu[$key]['title'] = $item['title'];
						$newMenu[$key]['icon'] = $item['icon'];
						$newMenu[$key]['link'] = $item['link'];
					}

				} elseif ($item) {
					$newMenu[$key] = isset($user->permissions[$item['permission']]) ? $item : null;
				}

				if (empty($newMenu[$key]['sub']) && empty($newMenu[$key]['permission']) )
					$newMenu[$key] = null;
			}

			return array_values(array_filter($newMenu));
		}
		return $menu;
	}


	
	
	/**
	 * Check permission of the menu link
	 * @param String $permission
	 * @param Instance User $user
	 */
	public function checkMenuPermissionsAccess($menu, $user)
	{
		if ($user->role_id == 3 )
		{
			return $menu;
		}

		$newMenu = [];
		if ($user->role_id > 3 )
		{
			foreach ($menu as $key => $item)
			{
				if (isset($item['sub'])) 
				{

					foreach ($item['sub'] as $k => $sub)
					{
						$newMenu[$key]['sub'][] = isset($user->permissions[$sub['permission']]) ? $sub : null;
					}
					$newMenu[$key]['sub'] = array_values(array_filter($newMenu[$key]['sub']));
					if (isset($newMenu[$key]['sub']))
					{
						$newMenu[$key]['title'] = $item['title'];
						$newMenu[$key]['icon'] = $item['icon'];
						$newMenu[$key]['link'] = $item['link'];
					}

				} else {
					$newMenu[$key] = isset($user->permissions[$item['permission']]) ? $item : null;
				}

				if (empty($newMenu[$key]['sub']) && empty($newMenu[$key]['permission']) )
					$newMenu[$key] = null;
			}

			return array_values(array_filter($newMenu));
		}
	}

}