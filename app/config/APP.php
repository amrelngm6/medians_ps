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

	public $lang_code = 'ar';

	public $lang;

	public $auth;

	public $branch;

	public $CONF;

	public $currentPage;

	public $Settings;

	public $capsule;



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
		// return true;
		$check = !empty($this->auth) ? $this->auth : (new AuthService())->checkSession();
		$this->branch = !empty($this->branch) ? $this->branch : (isset($check->branch) ? $check->branch : $this->checkAPISession()->branch);
		return $check ? $check : $this->checkAPISession();
	}

	/**
	 * Check if the request is through mobile
	 */
	public function checkAPISession()
	{
		if (!empty($this->request()->headers->get('token')))
		{
			$check = (new AuthService())->checkAPISession($this->request()->headers->get('token'));
			return $check;
		}
		return (object) ['branch'=>null];
	}  

	public function setBranch($branch)
	{
		$this->branch = $branch; 
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
		echo "<img width='100%' src='/src/assets/img/redirect.gif' /><style>*{margin:0;color:#fff; overflow:hidden}</style>";
		echo new RedirectResponse($url);
		exit();
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

		if ($user->role_id === 1)
			return $this->masterMenu();
		elseif ($user->role_id === 3)
			return $this->checkMenuAccess($this->adminMenu(), $user);
		elseif ($user->role_id === 4)
			return $this->checkMenuAccess($this->adminMenu(), $user);
	}

	

	/**
	* Return Administrator menu
	* List of side menu
	*/
	public function masterMenu()
	{

		$data = array(
			array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard', 'component'=>'master_dashboard'),
	        array('title'=>__('Branches'),  'icon'=>'fa-users', 'link'=>'admin/branches', 'component'=>'branches'),
			array('title'=>__('Plans'),  'icon'=>'fa-desktop', 'link'=>'#plans', 'sub'=>
				[
	                array('title'=>__('plans'),  'icon'=>'', 'link'=>'admin/plans', 'component'=>'plans'),
	                array('title'=>__('plan_features'),  'icon'=>'', 'link'=>'admin/plan_features', 'component'=>'plan_features'),
	                array('title'=>__('plan_subscriptions'), 'icon'=>'', 'link'=>'admin/plan_subscriptions', 'component'=>'plan_subscriptions'),
			        array('title'=>__('payments'),  'icon'=>'fa-credit-card', 'link'=>'admin/payments', 'component'=>'payments'),
				]
			),

			array('title'=>__('notifications'),  'icon'=>'fa-desktop', 'link'=>'#notifications', 'sub'=>
				[
	                array('title'=>__('notifications_log'),  'icon'=>'', 'link'=>'admin/notifications', 'component'=>'notifications'),
	                array('title'=>__('notifications_events'),  'icon'=>'', 'link'=>'admin/notifications_events', 'component'=>'notifications_events'),
				]
			),

	        array('title'=>__('Pages'),  'icon'=>'fa-pages', 'link'=>'admin/pages', 'component'=>'pages'),
	        array('title'=>__('Blog'),  'icon'=>'fa-article', 'link'=>'admin/blog', 'component'=>'blog'),
	        array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'admin/users', 'component'=>'users'),
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
			array('permission'=>'Dashboard.index', 'title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard', 'component'=>'dashboard'),
			array('permission'=>'OrderDevice.follow', 'title'=>__('bookings_follow'),  'icon'=>'fa-tv', 'link'=>'admin/devices/booking_follow', 'component'=>"booking_follow"),
			array('title'=>__('Bookings'),  'icon'=>'fa-calendar', 'link'=>'#bookings', 'sub'=>
				[
					array('permission'=>'OrderDevice.calendar', 'title'=>__('Calendar'),  'icon'=>'fa-dashboard', 'link'=>'admin/calendar', 'component'=>"calendar"),
	                array('permission'=>'OrderDevice.index', 'title'=>__('All bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?all=true', 'component'=>'devices_orders'),
	                array('permission'=>'OrderDevice.active', 'title'=>__('Active bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=active', 'component'=>'devices_orders'),
	                array('permission'=>'OrderDevice.upcoming', 'title'=>__('Upcoming bookings'), 'icon'=>'fa-dashboard','link'=>'admin/devices_orders?status=new', 'component'=>'devices_orders'),
	                array('permission'=>'OrderDevice.completed', 'title'=>__('Completed bookings'), 'icon'=>'fa-dashboard','link'=>'admin/devices_orders?status=completed', 'component'=>'devices_orders'),
	                array('permission'=>'OrderDevice.paid', 'title'=>__('Paid bookings'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=paid', 'component'=>'devices_orders'),
	                array('permission'=>'OrderDevice.canceled', 'title'=>__('Canceled bookings'), 'icon'=>'fa-dashboard', 'link'=>'admin/devices_orders?status=canceled', 'component'=>'devices_orders'),
				]
			),
			array('title'=>__('Devices'),  'icon'=>'fa-desktop', 'link'=>'#devices', 'sub'=>
				[
	                array('permission'=>'Device.manage', 'title'=>__('manage devices'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices/manage', 'component'=>'manage_devices'),
	                array('permission'=>'Game.index', 'title'=>__('games'),  'icon'=>'fa-dashboard', 'link'=>'admin/games', 'component' => 'games'),
	                array('permission'=>'Category.devices', 'title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'admin/devices/categories', 'component'=>'categories'),
				]
			),
	        array('title'=>__('Orders'),  'icon'=>'fa-file-invoice', 'link'=>'#invoices', 'sub'=>
	            [
	                array('permission'=>'Order.index', 'title'=>__('Orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?all=true', 'component'=>'invoices'),
	                array('permission'=>'Order.paid', 'title'=>__('Paid orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?status=paid', 'component'=>'invoices'),
	                array('permission'=>'Order.refund', 'title'=>__('Refund orders'),  'icon'=>'fa-dashboard', 'link'=>'admin/invoices?status=refund', 'component'=>'invoices'),
	            ]
	        ),
	        array('title'=>__('Products'),  'icon'=>'fa-shopping-cart', 'link'=>'#products', 'sub'=>
	            [
	                array('permission'=>'Product.index', 'title'=>__('Products list'),  'icon'=>'fa-dashboard', 'link'=>'admin/products', 'component'=>'products'),
	                array('permission'=>'Category.products', 'title'=>__('categories'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/categories', 'component'=>'categories'),
	                array('permission'=>'Product.stock_alert', 'title'=>__('Stock alert products'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/stock_alert', 'component'=>'products'),
	                array('permission'=>'Product.stock_out', 'title'=>__('Stock out products'),  'icon'=>'fa-dashboard', 'link'=>'admin/products/stock_out', 'component'=>'products'),
	            ]
	        ),
	        array('permission'=>'Stock.index', 'title'=>__('Stock'),  'icon'=>'fa-warehouse', 'link'=>'admin/stock' , 'component'=>'stock'),
	        array('permission'=>'Expense.index', 'title'=>__('Expenses'),  'icon'=>'fa-credit-card', 'link'=>'admin/expenses', 'component'=>'expenses'),
	        array('permission'=>'Customer.index', 'title'=>__('Customers'),  'icon'=>'fa-user', 'link'=>'admin/customers', 'component'=>'customers'),
	        array('permission'=>'User.index', 'title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'admin/users', 'component'=>'users'),
	        array('title'=>__('Account'),  'icon'=>'fa-cogs', 'link'=>'#account', 'sub'=>
	            [
					array('permission'=>'Setting.index', 'title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'admin/settings', 'component'=>'settings'),
	                array('permission'=>'Notification.index', 'title'=>__('notifications_log'),  'icon'=>'', 'link'=>'admin/notifications', 'component'=>'notifications'),
			        array('permission'=>'Branch.index', 'title'=>__('Branches'),  'icon'=>'fa-users', 'link'=>'admin/branches', 'component'=>'branches'),
	                array('permission'=>'PlanSubscription.index', 'title'=>__('plan_subscriptions'), 'icon'=>'', 'link'=>'admin/plan_subscriptions', 'component'=>'plan_subscriptions'),
	            ]
	        ),
			array('permission'=>'Logout', 'title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
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