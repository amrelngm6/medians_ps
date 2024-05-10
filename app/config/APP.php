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

	public $Settings;

	public $capsule;

	public $session;


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
	public function Settings()
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

	/**
	 * Load all request [params] parameter
	 * Used in most of the request
 	 */
	public function params()
	{
		return sanitizeInput($this->request()->get('params'));
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

		return $this->checkMenuAccess($this->adminMenu(), $user);
	}

	
	/**
	 * Return Administrator menu
	 * List of side menu
	 */
	public function adminMenu()
	{
		
		$data = array(
			
			array('permission'=> 'Dashboard.index', 'title'=>__('Dashboard'), 'icon'=>'airplay', 'link'=>'dashboard', 'component'=>'dashboard'),
			array('permission'=>'Dashboard.index', 'title'=>__('Customers'),  'icon'=>'user', 'link'=>'#customers', 'sub'=>
			[
				array('permission'=>'Parents.index', 'title'=>__('Parents'),  'icon'=>'user', 'link'=>'admin/parents', 'component'=>'parents'),
				array('permission'=>'Students.index', 'title'=>__('Students'),  'icon'=>'user', 'link'=>'admin/students', 'component'=>'students'),
				]
			),
			
			array('permission'=>'Vehicles.index', 'title'=>__('Cars'),  'icon'=>'truck', 'link'=>'admin/vehicles', 'component'=>'vehicles'),
			array('permission'=>'Drivers.index', 'title'=>__('Drivers'),  'icon'=>'users', 'link'=>'admin/drivers', 'component'=>'drivers'),
			array('permission'=>'Routes.index', 'title'=>__('Routes'),  'icon'=>'map', 'link'=>'#route', 'sub'=>
				[
					array('permission'=>'Routes.index', 'title'=>__('Routes'),  'icon'=>'map', 'link'=>'admin/routes', 'component'=>'routes'),
					array('permission'=>'PickupLocations.index', 'title'=>__('Locations'),  'icon'=>'map', 'link'=>'admin/locations', 'component'=>'locations'),
					array('permission'=>'Destinations.index', 'title'=>__('Destinations'),  'icon'=>'map', 'link'=>'admin/destinations', 'component'=>'destinations'),
					]
			),

			array('permission'=>'Trips.index', 'title'=>__('trips'),  'icon'=>'briefcase', 'link'=>'admin/trips', 'component'=>'trips'),
			array('permission'=>'HelpMessage.index', 'title'=>__('Help Messages'),  'icon'=>'check-circle', 'link'=>'admin/help_messages', 'component'=>'help_messages'),
			array('permission'=>'Event.index', 'title'=>__('Events'),  'icon'=>'tag', 'link'=>'admin/events', 'component'=>'events'),
	        array('permission'=>'User.index', 'title'=>__('Users'),  'icon'=>'users', 'link'=>'admin/users', 'component'=>'users'),
			
			array('permission'=>'NotificationEvent.index', 'title'=>__('Management'),  'icon'=>'tool', 'link'=>'#management', 'sub'=>
			[
				array('permission'=>'NotificationEvent.index', 'title'=>__('notifications_events'),  'icon'=>'tool', 'link'=>'admin/notifications_events', 'component'=>'notifications_events'),
				// array('permission'=>'Notification.index', 'title'=>__('notifications_log'),  'icon'=>'bell', 'link'=>'admin/notifications', 'component'=>'notifications'),
				array('permission'=> 'SystemSettings.index', 'title'=> __('System Settings'),  'icon'=>'tool', 'link'=>'admin/system_settings', 'component'=>'system_settings'),
				array('permission'=> 'Roles.index', 'title'=> __('ROLES MANAEGMENT'),  'icon'=>'chain', 'link'=>'admin/roles', 'component'=>'roles'),
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

				} else {
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