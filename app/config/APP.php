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

	public $lang_code = 'en';

	public $lang;

	public $auth;

	public $hasBranches = false;

	public $CONF;

	public $currentPage;

	public $business_setting;

	public $capsule;

	public $session;
	
	public $setting;


	function __construct()
	{

		$this->setLang(); // Set the active language 

		$this->currentPage = $this->request()->getPathInfo(); // Filter the request URI to get the current page

		$this->CONF = (new \config\Configuration())->getCONFArray();  // Load configuration as Array

		$this->capsule = (new \config\Configuration())->checkDB(); // Check database connection

		$this->auth(); // Check active secttion

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
		$this->lang = $_SESSION['lang']; // Check active language

	}


	/**
	 * Load all setting for a branch 
	 * return as Array
	 */ 
	public function BusinessSettings()
	{
		return  (new \Medians\Settings\Application\SettingsController())->getAll();
	}

	/**
	 * Load Sysetem Settings
	 */ 
	public function SystemSetting()
	{
		return  (new \Medians\Settings\Application\SystemSettingsController())->getAll();
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


	public static function redirect($url)
	{
		echo "<img width='100%' src='/src/assets/img/redirect.gif' /><style>*{margin:0;color:#fff; overflow:hidden}</style>";
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
			
			array('permission'=> 'Dashboard.index', 'title'=>__('Dashboard'), 'icon'=>'airplay', 'link'=>'dashboard', 'component'=>'dashboard'),
			array( 'title'=>__('Businesses'),  'icon'=>'wind', 'link'=>'#businesses', 'sub'=>
			[
				array('permission'=>'Companies.index', 'title'=>__('Companies'),  'icon'=>'user', 'link'=>'admin/companies', 'component'=>'companies'),
				array('permission'=>'Schools.index', 'title'=>__('Schools'),  'icon'=>'user', 'link'=>'admin/schools', 'component'=>'schools'),
			]
			),
			(isset($user->business->type) && strtolower($user->business->type) == 'company') 
			? array('permission'=>'PrivateTrips.index', 'title'=>__('Private trips'),  'icon'=>'pocket', 'link'=>'admin/private_trips', 'component'=>'private_trips')
			: null,
			
			array('title'=>__('Customers'),  'icon'=>'user', 'link'=>'#customers', 'sub'=>
			[
				array('permission'=>'Parents.index', 'title'=>__('Parents'),  'icon'=>'user', 'link'=>'admin/parents', 'component'=>'parents'),
				array('permission'=>'Students.index', 'title'=>__('Students'),  'icon'=>'user', 'link'=>'admin/students', 'component'=>'students'),
				array('permission'=>'SuperVisors.index', 'title'=>__('Supervisors'),  'icon'=>'users', 'link'=>'admin/supervisors', 'component'=>'supervisors'),
				array('permission'=>'Employees.index', 'title'=>__('Employees'),  'icon'=>'user', 'link'=>'admin/employees', 'component'=>'employees')

			]
			),
			
			array('title'=>__('Trips'),  'icon'=>'map', 'link'=>'#PrivateTrips', 'sub'=>
			[
				array('permission'=>'Trips.index', 'title'=>__('Route trips'),  'icon'=>'map-pin', 'link'=>'admin/trips', 'component'=>'trips'),
				array('permission'=>'PrivateTrips.index', 'title'=>__('Private Trips'),  'icon'=>'map', 'link'=>'admin/private_trips', 'component'=>'private_trips'),
			]
			),
			
			array('title'=>__('Vehicles'),  'icon'=>'truck', 'link'=>'#vehicles', 'sub'=>
			[
				array('permission'=>'Vehicles.index', 'title'=>__('Vehicles'),  'icon'=>'truck', 'link'=>'admin/vehicles', 'component'=>'vehicles'),
				array('permission'=>'VehicleTypes.index', 'title'=>__('Vehicle Types'),  'icon'=>'truck', 'link'=>'admin/vehicle_types', 'component'=>'vehicle_types'),
			]
			),

			array('title'=>__('Drivers'),  'icon'=>'users', 'link'=>'#drivers', 'sub'=>
			[
				array('permission'=>'Drivers.index', 'title'=>__('Drivers'),  'icon'=>'users', 'link'=>'admin/drivers', 'component'=>'drivers'),
				array('permission'=>'DriverApplicants.index', 'title'=>__('Driver applicants'),  'icon'=>'users', 'link'=>'admin/driver_applicants', 'component'=>'driver_applicants'),
			]
			),

			array('title'=>__('Routes'),  'icon'=>'map', 'link'=>'#route', 'sub'=>
			[
				array('permission'=>'Routes.index', 'title'=>__('Routes'),  'icon'=>'map', 'link'=>'admin/routes', 'component'=>'routes'),
				array('permission'=>'RouteLocations.index', 'title'=>__('Locations'),  'icon'=>'map', 'link'=>'admin/locations', 'component'=>'locations'),
				]
			),
			
			array('title'=>__('Subscriptions'),  'icon'=>'cloud-lightning', 'link'=>'#packages', 'sub'=>
			[
				array('permission'=>'Packages.index', 'title'=>__('Manage Packages'),  'icon'=>'credit-card', 'link'=>'admin/packages', 'component'=>'packages'),
				array('permission'=>'PackageSubscriptions.index', 'title'=>__('Subscriptions'),  'icon'=>'credit-card', 'link'=>'admin/package_subscriptions', 'component'=>'package_subscriptions'),
				array('permission'=>'BusinessApplicants.index', 'title'=>__('Business applicants'),  'icon'=>'credit-card', 'link'=>'admin/business_applicants', 'component'=>'business_applicants'),
			]
			),
			

			array('title'=>__('Finance'),  'icon'=>'credit-card', 'link'=>'#finance', 'sub'=>
			[
				array('permission'=> 'Transaction.index', 'title'=> __('Transactions'), 'icon'=>'credit-card', 'link'=>'admin/transactions', 'component'=>'transactions'),
				array('permission'=> 'Invoice.index', 'title'=> __('Invoices'), 'icon'=>'credit-card', 'link'=>'admin/invoices', 'component'=>'invoices'),
			]
			),
			
			array('permission'=>'HelpMessage.index', 'title'=>__('Help Messages'),  'icon'=>'help-circle', 'link'=>'admin/help_messages', 'component'=>'help_messages'),
			array('permission'=>'Event.index', 'title'=>__('Events'),  'icon'=>'tag', 'link'=>'admin/events', 'component'=>'events'),
			array('permission'=> 'Settings.index', 'title'=> __('Business Settings'),  'icon'=>'tool', 'link'=>'admin/settings', 'component'=>'settings'),
			array('permission'=>'PlanSubscriptions.index', 'title'=>__('Plan subscriptions'),  'icon'=>'check-circle', 'link'=>'admin/plan_subscriptions', 'component'=>'plan_subscriptions'),
			
			array('permission'=>'Dashboard.index', 'title'=> __('Logout'),  'icon'=>'log-out', 'link'=>'logout'),
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
			
			array('permission'=> 'Dashboard.index', 'title'=>__('Dashboard'), 'icon'=>'airplay', 'link'=>'dashboard', 'component'=>'master_dashboard'),
			array( 'title'=>__('Businesses'),  'icon'=>'wind', 'link'=>'#businesses', 'sub'=>
			[
				array('permission'=>'Companies.index', 'title'=>__('Companies'),  'icon'=>'user', 'link'=>'admin/companies', 'component'=>'companies'),
				array('permission'=>'Schools.index', 'title'=>__('Schools'),  'icon'=>'user', 'link'=>'admin/schools', 'component'=>'schools'),
			]
			),
			

			array('permission'=>'Event.index', 'title'=>__('Events'),  'icon'=>'tag', 'link'=>'admin/events', 'component'=>'events'),
	        array('permission'=>'User.index', 'title'=>__('Users'),  'icon'=>'users', 'link'=>'admin/users', 'component'=>'users'),
			
			array( 'title'=>__('Service Locations'),  'icon'=>'map-pin', 'link'=>'#locations', 'sub'=>
			[
				array('permission'=>'Countries.index', 'title'=>__('Countries'),  'icon'=>'tool', 'link'=>'admin/countries', 'component'=>'countries'),
				array('permission'=>'States.index', 'title'=>__('States'),  'icon'=>'tool', 'link'=>'admin/states', 'component'=>'states'),
				array('permission'=>'Cities.index', 'title'=>__('Cities'),  'icon'=>'tool', 'link'=>'admin/cities', 'component'=>'cities'),
			]
			),
			array( 'title'=>__('Plans'),  'icon'=>'check-circle', 'link'=>'#plan', 'sub'=>
			[
				array('permission'=>'Plans.index', 'title'=>__('Plans'),  'icon'=>'tool', 'link'=>'admin/plans', 'component'=>'plans'),
				array('permission'=>'PlanFeatures.index', 'title'=>__('Plan features'),  'icon'=>'tool', 'link'=>'admin/plan_features', 'component'=>'plan_features'),
				array('permission'=>'PlanSubscriptions.index', 'title'=>__('Plan subscriptions'),  'icon'=>'tool', 'link'=>'admin/plan_subscriptions', 'component'=>'plan_subscriptions'),
			]
			),
			
			array('title'=>__('Finance'),  'icon'=>'credit-card', 'link'=>'#finance', 'sub'=>
			[
				array('permission'=>'Payments.index', 'title'=>__('Plan Payments'),  'icon'=>'tool', 'link'=>'admin/payments', 'component'=>'payments'),
				array('permission'=> 'Invoice.index', 'title'=> __('Invoices'), 'icon'=>'credit-card', 'link'=>'admin/invoices', 'component'=>'invoices'),
			]
			),
			
			array('permission'=>'HelpMessage.index', 'title'=>__('Help Messages'),  'icon'=>'help-circle', 'link'=>'admin/help_messages', 'component'=>'help_messages'),
			array( 'title'=>__('Management'),  'icon'=>'tool', 'link'=>'#management', 'superadmin'=> true, 'sub'=>
			[
				array('permission'=>'Pages.index', 'title'=>__('Front Pages'),  'icon'=>'tool', 'link'=>'admin/pages', 'component'=>'pages'),
				array('permission'=>'NotificationEvent.index', 'title'=>__('notifications_events'),  'icon'=>'tool', 'link'=>'admin/notifications_events', 'component'=>'notifications_events'),
				array('permission'=> 'SystemSettings.index', 'title'=> __('System Settings'),  'icon'=>'tool', 'link'=>'admin/system_settings', 'component'=>'system_settings'),
				array('permission'=> 'Roles.index', 'title'=> __('ROLES MANAEGMENT'),  'icon'=>'tool', 'link'=>'admin/roles', 'component'=>'roles'),
			]
			),
			
			array('permission'=>'Logout', 'title'=> __('Logout'),  'icon'=>'log-out', 'link'=>'logout'),
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