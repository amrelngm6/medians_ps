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
	public function handle($path)
	{

		$this->app = new \config\APP;
		$request = $this->app->request();
		$return = [];
		switch ($path) 
		{
			case 'load_config':
				$return = loadConfig($request->get('component'), []);
				break;
		}

		echo json_encode($return);
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

				case 'User.create':
					$return = (new Users\Application\UserController())->store();
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

				case 'Lead.create':
					return response((new Customers\Application\LeadController())->store());
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
		
				case 'TaxiTrip.create':
					$return = (new Trips\Application\TaxiTripController)->store();
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
	
				case 'ContactForm.create':
					$return = (new Forms\Application\ContactFormController())->store(); 
					break;
	
				case 'Gallery.create':
					$return = (new Gallery\Application\GalleryController())->store(); 
					break;
	
				case 'EmailTemplate.create':
					$return = (new Templates\Application\EmailTemplateController())->store(); 
					break;
					
				case 'Country.create':
					$return = (new Locations\Application\CountryController())->store(); 
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

			case 'Lead.update':
				$controller = new Customers\Application\LeadController;
				break;

			case 'Driver.update':
				$controller = new Drivers\Application\DriverController;
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

			case 'Role.update':
				$controller =  new Roles\Application\RoleController; 
				break;			

			case 'Role.updatePermissions':
				return (new Roles\Application\RoleController)->updatePermissions(); 
				break;
		
			case 'User.updateStatus':
				return (new Users\Application\UserController())->updateStatus();
				break;
	
			case 'Language.update':
				$controller = new Languages\Application\LanguageController;
				break;
				
			case 'Translation.update':
				$controller = new Languages\Application\TranslationController; 
				break;
	
			case 'EmailTemplate.update':
				$controller = new Templates\Application\EmailTemplateController; 
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
			
				case 'TaxiTrip.delete':
					return response((new Trips\Application\TaxiTripController())->delete());
					break;

				case 'BusinessApplicant.delete':
				case 'StudentApplicant.delete':
					return response((new Customers\Application\StudentApplicantController())->delete());
					break;
	
				case 'NewsletterSubscriber.delete':
					return response((new Newsletters\Application\NewsletterSubscriberController())->delete());
					break;
	
				case 'ContactForm.delete':
					return response((new Forms\Application\ContactFormController())->delete());
					break;
	
				case 'Gallery.delete':
					return response((new Gallery\Application\GalleryController())->delete());
					break;
					
				case 'Language.delete':
					return response((new Languages\Application\LanguageController())->delete());
					break;
					
				case 'EmailTemplate.delete':
					return response((new Templates\Application\EmailTemplateController())->delete());
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
