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
			case 'create_trip':
				return (new \Medians\Trips\Application\TripController())->createTrip();
				break;

			case 'HelpMessage.close':
				return (new Help\Application\HelpMessageController())->close();
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

				case 'Payment.paypal_payment_confirmation':
					$return = (new Payments\Application\PaymentController())->confirmPayPalPlanPayment();
					break;

				case 'User.create':
					$return = (new Users\Application\UserController())->store();
					break;

				case 'User.get_started_save_business':
					$return = (new Users\Application\GetStartedController())->saveBusiness();
					break;

				case 'User.get_started_save_plan':
					$return = (new Users\Application\GetStartedController())->saveSelectedPlan();
					break;

				case 'User.get_started_save_free_plan':
					$return = (new Users\Application\GetStartedController())->saveFreePlan();
					break;

				case 'Student.create':
					$return = (new Students\Application\StudentController())->store();
					break;

				case 'Driver.create':
					$return = (new Drivers\Application\DriverController())->store();
					break;

				case 'Route.create':
					$return = (new Routes\Application\RouteController())->store();
					break;

				case 'Vehicle.create':
					$return = (new Vehicles\Application\VehicleController())->store();
					break;
					break;

				case 'RouteLocation.create':
					$return = (new Locations\Application\RouteLocationController())->store();
					break;

				case 'Parents.create':
					return response((new Customers\Application\ParentController())->store());
					break;

				case 'HelpMessage.create':
					return response((new Help\Application\HelpMessageController())->store());
					break;
		
				case 'Event.create':
					$return = (new Events\Application\EventController())->store();
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
	
				case 'Vacation.create':
					$return =  (new Vacations\Application\VacationController())->store(); 
					break;
					
				case 'Company.create':
				case 'School.create':
					$return =  (new Businesses\Application\BusinessController())->store(); 
					break;
					
				case 'Plan.create':
					$return =  (new Plans\Application\PlanController())->store(); 
					break;
				
				case 'PlanFeature.create':
					$return =  (new Plans\Application\PlanFeatureController())->store(); 
					break;
				
				case 'Employee.create':
					$return =  (new Customers\Application\EmployeeController())->store(); 
					break;
				
				case 'Page.create':
					$return =  (new Pages\Application\PageController())->store(); 
					break;

		
				case 'Package.create':
					$return = (new Packages\Application\PackageController)->store();
					break;
		
		
				case 'PaymentMethod.create':
					$return = (new PaymentMethods\Application\PaymentMethodController)->store();
					break;
		
				case 'PackageSubscription.create':
					$return = (new Packages\Application\PackageSubscriptionController)->store();
					break;
		
				case 'VehicleType.create':
					$return = (new Vehicles\Application\VehicleTypeController)->store();
					break;
		
				case 'SuperVisor.create':
					$return = (new Customers\Application\SuperVisorController)->store();
					break;
		
				case 'PrivateTrip.create':
					$return = (new Trips\Application\PrivateTripController)->store();
					break;

				case 'BusinessWithdrawal.create':
					$return = (new Wallets\Application\BusinessWithdrawalController)->store();
					break;
			
				case 'CollectedCash.create':
					$return = (new Wallets\Application\CollectedCashController)->store();
					break;
			
				case 'Language.create':
					$return = (new Languages\Application\LanguageController)->store();
					break;
					
				case 'Translation.create':
					$return = (new Languages\Application\TranslationController())->store(); 
					break;
					
				case 'NewsletterSubscriber.create':
					$return = (new Newsletters\Application\NewsletterSubscriberController())->store(); 
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

			case 'Student.update':
				$controller = new Students\Application\StudentController;
				break;

			case 'Driver.update':
				$controller = new Drivers\Application\DriverController;
				break;

			case 'Route.update':
				$controller = new Routes\Application\RouteController;
				break;

			case 'Vehicle.update':
				$controller = new Vehicles\Application\VehicleController;
				break;

			case 'RouteLocation.update':
				$controller = new Locations\Application\RouteLocationController;
				break;

			case 'HelpMessage.update':
				$controller =  new Help\Application\HelpMessageController;
				break;
	
			case 'Parents.update':
				$controller = new Customers\Application\ParentController;
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

            case 'Vehicle.update':
                $controller =  new Vehicles\Application\VehicleController; 
                break;

            case 'Event.update':
				$controller = new Events\Application\EventController;
                break;

            case 'Vacation.update':
				$controller = new Vacations\Application\VacationController;
                break;

			case 'Role.update':
				$controller =  new Roles\Application\RoleController; 
				break;			

			case 'Business.update':
			case 'School.update':
			case 'Company.update':
				$controller =  new Businesses\Application\BusinessController; 
				break;			
				
			case 'Plan.update':
				$controller =  new Plans\Application\PlanController; 
				break;
			
			case 'PlanFeature.update':
				$controller =  new Plans\Application\PlanFeatureController; 
				break;
			
			case 'Employee.update':
				$controller =  new Customers\Application\EmployeeController; 
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
	
			case 'Package.update':
				$controller = new Packages\Application\PackageController;
				break;
			
			case 'PaymentMethod.update':
				$controller = new PaymentMethods\Application\PaymentMethodController;
				break;
			
			case 'PackageSubscription.update':
				$controller = new Packages\Application\PackageSubscriptionController;
				break;
			
			case 'VehicleType.update':
				$controller = new Vehicles\Application\VehicleTypeController;
				break;
			
			case 'SuperVisor.update':
				$controller = new Customers\Application\SuperVisorController;
				break;
			
			case 'PrivateTrip.update':
				$controller = new Trips\Application\PrivateTripController;
				break;
				
			case 'Trip.update':
				$controller = new Trips\Application\TripController;
				break;
			
			case 'DriverApplicant.update':
				$controller = new Drivers\Application\DriverApplicantController;
				break;
			
			case 'BusinessApplicant.update':
				$controller = new Customers\Application\BusinessApplicantController;
				break;
			
			case 'PlanSubscription.update':
				$controller = new Plans\Application\PlanSubscriptionController;
				break;
			
			case 'BusinessWithdrawal.update':
				$controller = new Wallets\Application\BusinessWithdrawalController;
				break;
		
			case 'Withdrawal.update':
				$controller = new Wallets\Application\WithdrawalController;
				break;
		
			case 'Currency.update':
				$controller = new Currencies\Application\CurrencyService;
				break;
				
			case 'Language.update':
				$controller = new Languages\Application\LanguageController;
				break;
				
			case 'Translation.update':
				$controller = new Languages\Application\TranslationController; 
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

				case 'Driver.delete':
					return response((new Drivers\Application\DriverController())->delete());
					break;

				case 'Parents.delete':
					return response((new Customers\Application\ParentController())->delete());
					break;

				case 'Route.delete':
					return response((new Routes\Application\RouteController())->delete());
					break;

				case 'RouteLocation.delete':
					return response((new Locations\Application\RouteLocationController())->delete());
					break;

				case 'Student.delete':
					return response((new Students\Application\StudentController())->delete());
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

				case 'NotificationEvent.delete':
					return response((new Notifications\Application\NotificationEventController())->delete());
					break;
			
				case 'Event.delete':
					return response((new Events\Application\EventController())->delete());
					break;
			
				case 'School.delete':
				case 'Company.delete':
					return response((new Businesses\Application\BusinessController())->delete());
					break;
			
				case 'Plan.delete':
					return response((new Plans\Application\PlanController())->delete());
					break;
			
				case 'PlanFeature.delete':
					return response((new Plans\Application\PlanFeatureController())->delete());
					break;
			
				case 'Employee.delete':
					return response((new Customers\Application\EmployeeController())->delete());
					break;
					break;
			
				case 'Page.delete':
					return response((new Pages\Application\PageController())->delete());
					break;
		
				case 'Package.delete':
					return response((new Packages\Application\PackageController())->delete());
					break;
			
			
				case 'PaymentMethod.delete':
					return response((new PaymentMethods\Application\PaymentMethodController())->delete());
					break;
			
				case 'PackageSubscription.delete':
					return response((new Packages\Application\PackageSubscriptionController())->delete());
					break;
			
				case 'VehicleType.delete':
					return response((new Vehicles\Application\VehicleTypeController())->delete());
					break;
			
				case 'SuperVisor.delete':
					return response((new Customers\Application\SuperVisorController())->delete());
					break;
			
				case 'PrivateTrip.delete':
					return response((new Trips\Application\PrivateTripController())->delete());
					break;

				case 'BusinessApplicant.delete':
					return response((new Customers\Application\BusinessApplicantController())->delete());
					break;
	
				case 'BusinessWithdrawal.delete':
					return response((new Wallets\Application\BusinessWithdrawalController())->delete());
					break;
	
				case 'NewsletterSubscriber.delete':
					return response((new Newsletters\Application\NewsletterSubscriberController())->delete());
					break;
	

			}

		} catch (Exception $e) {
			throw new Exception( $e->getMessage(), 1);
					
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
