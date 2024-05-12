<?php

namespace Medians;

use \Shared\dbaser\CustomController;


class FrontAPIController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;
	protected $app;

	protected $BugReportRepo;



	function __construct()
	{
	
	}


	/**
	 * Model object 
	 * 
	 */
	public function handle()
	{

		$this->app = new \config\APP;

		$type = $this->app->request()->get('type');
		$return = [];
		switch ($type) 
		{
			case 'load_products':
				return (new Products\Application\ProductController)->load_products();
				break;
		}

		$return = isset($controller) ? $controller->find($this->app->request()->get('id')) : $return;

		return response(json_encode(['status'=>true, 'result'=>$return]));
	} 

	/**
	 * Create model 
	 * 
	 */
	public function create()
	{
		
		$app = new \config\APP;
		$request = $app->request();
		
		try {
				
			$return = [];
			switch ($request->get('type')) 
			{
					
				case 'HelpMessage.create':
					return response((new Help\Application\HelpMessageController())->store());
					break;
					
				case 'Cart.create':
					return response((new Cart\Application\CartController())->store());
					break;
		
				case 'HelpMessageComment.create':
					$return =  (new Help\Application\HelpMessageController())->storeComment(); 
					break;
					
				case 'Subscriber.create':
					$return = (new Newsletters\Application\SubscriberController)->store();
					break;
					
				case 'Customer.create':
					$return = (new Customers\Application\CustomerController)->store();
					break;
		
			}

			return response(json_encode($return));

		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function update()
	{
		$app = new \config\APP;
		$request = $app->request();

		switch ($request->get('type')) 
		{
			case 'SystemSettings.update':
                $controller =  new Settings\Application\SystemSettingsController; 
				break;

			case 'AppSettings.update':
                $controller =  new Settings\Application\AppSettingsController; 
				break;

				
			case 'HelpMessage.update':
				$controller =  new Help\Application\HelpMessageController;
				break;
	
				
            case 'Settings.update':
                $controller = new Settings\Application\SettingsController; 
                break;

            case 'User.update':
                $controller = new Users\Application\UserController; 
                break;

            case 'NotificationEvent.update':
                $controller =  new Notifications\Application\NotificationEventController; 
                break;

            case 'Event.update':
				$controller = new Events\Application\EventController;
                break;

			case 'Role.update':
				$controller =  new Roles\Application\RoleController; 
				break;			

			case 'Page.update':
				$controller =  new Pages\Application\PageController; 
				break;
			
			case 'Role.updatePermissions':
				return (new Roles\Application\RoleController)->updatePermissions(); 
				break;
		
			case 'User.updateStatus':
				return (new Users\Application\UserController())->updateStatus();
				break;
	

			case 'City.update':
				$controller = new Locations\Application\CityController;
				break;

			case 'Country.update':
				$controller = new Locations\Application\CountryController;
				break;

			case 'State.update':
				$controller = new Locations\Application\StateController;
				break;

			case 'PaymentMethod.update':
				$controller = new PaymentMethods\Application\PaymentMethodController;
				break;
			
			case 'Product.update':
				$controller = new Products\Application\ProductController;
				break;
			
			case 'ProductCategory.update':
				$controller = new Products\Application\CategoryController;
				break;
			
			case 'Brand.update':
				$controller = new Brands\Application\BrandController;
				break;
			
			case 'Shipping.update':
				$controller = new Shipping\Application\ShippingController;
				break;
			
			case 'Newsletter.update':
				$controller = new Newsletters\Application\NewsletterController;
				break;
			
			case 'Subscriber.update':
				$controller = new Newsletters\Application\SubscriberController;
				break;
			
			case 'Customer.update':
				$controller = new Customers\Application\CustomerController;
				break;
			

		}

		return response(isset($controller) ? json_encode($controller->update()) : []);
	} 

	

	/**
	 * delete model 
	 * 
	 */
	public function delete()
	{

		$app = new \config\APP;
		$request = $app->request();

		try {
			
			$return = [];
			switch ($request->get('type')) 
			{

				case 'User.delete':
					return response((new Users\Application\UserController())->delete());
					break;

				case 'HelpMessage.delete':
					return response((new Help\Application\HelpMessageController())->delete());
					break;

				case 'Role.delete':
					return response((new Roles\Application\RoleController())->delete());
					break;

				case 'NotificationEvent.delete':
					return response((new Notifications\Application\NotificationEventController())->delete());
					break;
			
				case 'Event.delete':
					return response((new Events\Application\EventController())->delete());
					break;
			
				case 'Page.delete':
					return response((new Pages\Application\PageController())->delete());
					break;
		
				case 'City.delete':
					return response((new Locations\Application\CityController())->delete());
					break;

				case 'Country.delete':
					return response((new Locations\Application\CountryController())->delete());
					break;

				case 'State.delete':
					return response((new Locations\Application\StateController())->delete());
					break;
			
				case 'PaymentMethod.delete':
					return response((new PaymentMethods\Application\PaymentMethodController())->delete());
					break;
			
				case 'Brand.delete':
					return response((new Brands\Application\BrandController())->delete());
					break;
			
				case 'Shipping.delete':
					return response((new Shipping\Application\ShippingController())->delete());
					break;
			
				case 'Newsletter.delete':
					return response((new Newsletters\Application\NewsletterController())->delete());
					break;
			
				case 'Subscriber.delete':
					return response((new Newsletters\Application\SubscriberController())->delete());
					break;
			
				case 'Customer.delete':
					return response((new Customers\Application\CustomerController())->delete());
					break;
			
				case 'Product.delete':
					return response((new Products\Application\ProductController())->delete());
					break;
			
			}

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
	} 


	/**
	 * Debug function that takes screenshot 
	 * and save at the server with txt file 
	 * with full log
	 */
	public function bug_report()
	{
		$this->app = new \config\APP;

		$info = $_POST['info'];
		$err = $_POST['err'];
		$root_path_info = pathinfo(dirname(__DIR__));
		$output = date('YmdHis').'-'.$this->app->auth()->id.'-'.$info;
		file_put_contents($root_path_info['dirname'].'/uploads/bugs/'.$output.'.jpg', file_get_contents($_POST['image']));

		$txtLog = $root_path_info['dirname'].'/uploads/bugs/error_bugs.txt'; 
		file_put_contents($txtLog, file_get_contents($txtLog)."\r\n".$output . $err);

		$this->BugReportRepo = new BugReportRepository;

		$data = array();
		$data['user_id'] = $this->app->auth()->id;
		$data['file_name'] = $output.'.jpg';
		$data['info'] =  $info;
		$data['error'] =  $err;
		$this->BugReportRepo->store($data);

	}

}
