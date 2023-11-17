<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Bugs\Infrastructure\BugReportRepository;

use Medians\Blog\Infrastructure\BlogRepository;


class APIController extends CustomController
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

		$return = [];
		switch ($this->app->request()->get('type')) 
		{
			case 'HelpMessage.close':
				return json_encode((new Help\Application\HelpMessageController())->close());
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
				case 'User.get_started_save_branch':
					$return = (new Users\Application\GetStartedController())->store_branch();
					break;

				case 'User.get_started_save_setting':
					$return = (new Users\Application\GetStartedController())->store_setting();
					break;

				case 'User.create':
					$return = (new Users\Application\UserController())->store();
					break;

				case 'Student.create':
					$return = (new Students\Application\StudentController())->store();
					break;

				case 'Driver.create':
					$return = (new Drivers\Application\DriverController())->store();
					break;

				case 'Routes.create':
					$return = (new Routes\Application\RouteController())->store();
					break;

				case 'Vehicle.create':
					$return = (new Vehicles\Application\VehicleController())->store();
					break;
					break;

				case 'PickupLocation.create':
					$return = (new Locations\Application\PickupLocationController())->store();
					break;

				case 'Parents.create':
					return response((new Parents\Application\ParentController())->store());
					break;

				case 'HelpMessage.create':
					return response((new Help\Application\HelpMessageController())->store());
					break;
		
				case 'Category.create':
					$return = (new Categories\Application\CategoryController())->store();
					break;
					
				case 'Event.create':
					$return = (new Events\Application\EventController())->store();
					break;


	            case 'User.create':
	                $return =  (new Users\Application\UserController())->store(); 
	                break;

	            case 'Page.create':
	                $return =  (new Pages\Application\PageController())->store(); 
	                break;

	            case 'NotificationEvent.create':
	                $return =  (new Notifications\Application\NotificationEventController())->store(); 
	                break;

	            case 'Role.create':
	                $return =  (new Roles\Application\RoleController())->store(); 
	                break;
				
				
				case 'HelpMessageComment.create':
					$return =  (new Help\Application\HelpMessageController())->storeComment(); 
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

			case 'Branch.update':
                $controller =  new Branches\Application\BranchController; 
				break;

			case 'Device.update':
                $controller =  new Devices\Application\DeviceController; 
				break;
				
			case 'Category.update':
				$controller = new Categories\Application\CategoryController;
				break;

			case 'Student.update':
				$controller = new Students\Application\StudentController;
				break;

			case 'Driver.update':
				$controller = new Drivers\Application\DriverController;
				break;

			case 'Routes.update':
				$controller = new Routes\Application\RouteController;
				break;

			case 'Vehicle.update':
				$controller = new Vehicles\Application\VehicleController;
				break;

			case 'PickupLocation.update':
				$controller = new Locations\Application\PickupLocationController;
				break;

			case 'HelpMessage.update':
				$controller =  new Help\Application\HelpMessageController;
				break;


			case 'Parents.update':
				$controller = new Parents\Application\ParentController;
				break;

            case 'Settings.update':
                $controller = new Settings\Application\SettingsController; 
                break;

            case 'User.update':
                $controller = new Users\Application\UserController; 
                break;

            case 'Page.update':
                $controller =  new Pages\Application\PageController; 
                break;

            case 'NotificationEvent.update':
                $controller =  new Notifications\Application\NotificationEventController; 
                break;

            case 'Vehicle.update':
                $controller =  new Vehicles\Application\VehicleController; 
                break;

            case 'Event.update':
				$controller = new Events\Application\EventController;
                break;

			case 'Role.update':
				$controller =  new Roles\Application\RoleController; 
				break;
			
			case 'Role.updatePermissions':
				$controller =  new Roles\Application\RoleController; 
				break;
			
		}

		return response(isset($controller) ? json_encode($controller->update()) : []);
	} 

	/**
	 * delete model 
	 * 
	 */
	public function search()
	{

		$app = new \config\APP;
		$request = $app->request();

		try {
			
			$return = [];
			switch ($request->get('type')) 
			{
				case 'Customer':
					$return = (new Customers\Application\CustomerController())->search($request->get('search_text'));
					break;

			}

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
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

				case 'Driver.delete':
					return response((new Drivers\Application\DriverController())->delete());
					break;

				case 'Parents.delete':
					return response((new Parents\Application\ParentController())->delete());
					break;

				case 'Route.delete':
					return response((new Routes\Application\RouteController())->delete());
					break;

				case 'PickupLocation.delete':
					return response((new Locations\Application\PickupLocationController())->delete());
					break;

				case 'Student.delete':
					return response((new Students\Application\StudentController())->delete());
					break;

				case 'Page.delete':
					return response((new Pages\Application\PageController())->delete());
					break;

				case 'Vehicle.delete':
					return response((new Vehicles\Application\VehicleController())->delete());
					break;

				case 'HelpMessage.delete':
					return response((new Help\Application\HelpMessageController())->delete());
					break;

				case 'Role.delete':
					return response((new Roles\Application\RoleController())->delete());
					break;

			}

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function updateStatus()
	{

		$app = new \config\APP;
		$request = $app->request();

		$id = $request->get('id');
		$status = $request->get('status');

		$return = [];
		switch ($request->get('model')) 
		{
			case 'Device':
				$return = (new DevicesRepository())->find($id)->update(['status'=>$status]);
				break;
		}

		return response(json_encode($return));
	} 

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
