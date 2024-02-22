<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Bugs\Infrastructure\BugReportRepository;


class MobileAPIController extends CustomController
{

	/**
	* @var Object
	*/
	protected $app;


	
	/**
	 * Model object 
	 * 
	 */
	public function handle($model = null)
	{
		$this->app = new \config\APP;
		$return = [];
		$model = empty($model) ? $this->app->request()->get('model') : $model;

		$params = $this->app->request()->get('params') ? (array)  json_decode($this->app->request()->get('params')) : [];

		switch ($model) 
		{
			case 'APP':
				$return = ['app'=>$this->app, 'lang'=>(new \helper\Lang($this->app->default_lang))->load()->vueLang()];
				break;
		
			case 'app_settings':
				$return = (new \Medians\Settings\Application\AppSettingsController())->loadSetting();
				break;

			case 'help_messages':
				$return = (new \Medians\Help\Application\HelpMessageController())->loadHelpMessages();
				break;
	
			case 'parent_help_message':
				$return = (new \Medians\Help\Application\HelpMessageController())->parentStore();
				break;
				
			case 'parent_help_messages':
				$return = (new \Medians\Help\Application\HelpMessageController())->loadParentHelpMessages();
				break;

			case 'Route.start_trip':
				$return = (new \Medians\Trips\Application\TripController())->createTrip();
				break;

			case 'Route.active_trip':
				$return = (new \Medians\Trips\Application\TripController())->getActiveTrip();
				break;

			case 'Trip.update_location':
				$return = (new \Medians\Trips\Application\TripController())->updateLocation();
				break;

			case 'Trip.alarm_location':
				$return = (new \Medians\Trips\Application\TripController())->alarmLocation();
				break;

			case 'Route.end_trip':
				$return = (new \Medians\Trips\Application\TripController())->endTrip();
				break;

			case 'update_pickup':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->updateTripPickup($params);
				break;

			case 'trips':
				$return = (new \Medians\Trips\Application\TripController())->loadTrips($params);
				break;
			
			case 'student_trips':
				$return = (new \Medians\Trips\Application\TripController())->loadStudentTrips($params);
				break;

			case 'Vehicle.update':
				$return =  (new Vehicles\Application\VehicleController())->updateLocation($params); 
				break;

			case 'Parent.signup':
				$return =  (new Customers\Application\ParentController())->signup(); 
				break;

			case 'Parent.login':
				$return =  (new Customers\Application\ParentController())->login(); 
				break;

			case 'Driver.login':
				$return =  (new Drivers\Application\DriverController())->login(); 
				break;

			case 'getDriver':
				$return =  (new Drivers\Application\DriverController())->getDriver($this->app->request()->get('driver_id')); 
				break;

			case 'Parents.resetPassword':
				$return =  (new Customers\Application\ParentController())->resetPassword(); 
				break;

			case 'Drivers.resetPassword':
				$return =  (new Drivers\Application\DriverController())->resetPassword(); 
				break;
			
			case 'notifications':
				$return =  (new Notifications\Application\NotificationController())->loadLatestMobileNotifications(); 
				break;

			case 'student_pickup':
				$return =  (new Locations\Application\RouteLocationController())->loadPickup(); 
				break;
				
			case 'student_locations':
				$return =  (new Students\Application\StudentController())->loadLocations(); 
				break;
				
			case 'Student.upload_picture':
				$return =  (new Students\Application\StudentController())->uploadPicture(); 
				break;
				
			case 'Driver.upload_picture':
				$return =  (new Drivers\Application\DriverController())->uploadPicture(); 
				break;
				
			case 'Parents.changePassword':
				$return =  (new Customers\Application\ParentController())->changePassword(); 
				break;
				
			case 'Parents.getActiveParentTrip':
				$return =  (new Trips\Application\TripController())->getActiveParentTrip(); 
				break;
				
				
			case 'Parents.resetChangePassword':
				$return =  (new Customers\Application\ParentController())->resetChangePassword(); 
				break;
				
			case 'Driver.changePassword':
				$return =  (new Drivers\Application\DriverController())->changePassword(); 
				break;
				
			case 'Driver.getActiveDriverTrip':
				$return =  (new Trips\Application\TripController())->getActiveDriverTrip(); 
				break;
				
			case 'Driver.start_trip':
				$return =  (new Trips\Application\PrivateTripController())->startTrip(); 
				break;
				
			case 'Driver.end_trip':
				$return =  (new Trips\Application\PrivateTripController())->endTrip(); 
				break;

		}

		echo json_encode($return);
		
		return true;
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
			switch ($request->get('model')) 
			{
				case 'User.create':
					$return = (new Users\Application\UserController())->store();
					break;
					
				case 'HelpMessageComment.create':
					return  (new Help\Application\HelpMessageController())->storeDriverComment(); 
					break;
			
				case 'HelpMessage.create':
					$return = (new \Medians\Help\Application\HelpMessageController())->storeMobile();
					break;

				case 'HelpMessageComment.parent_comment':
					return  (new Help\Application\HelpMessageController())->storeParentComment(); 
					break;
						
	            case 'Student.create':
	                return  (new Students\Application\StudentController())->addStudent(); 
	                break;


			}

			echo json_encode($return);
		
			return true;

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

		$return = [];
		switch ($request->get('model')) 
		{

            case 'User.update':
                $return = (new Users\Application\UserController())->update(); 
                break;

            case 'Parent.update':
				$return = (new Customers\Application\ParentController())->updateMobile(); 
                break;

            case 'Driver.update':
				$return = (new Drivers\Application\DriverController())->updateMobile(); 
                break;

			case 'Notification.update':
				$return =  (new Notifications\Application\NotificationController())->update(); 
				break;

			case 'Student.updateStudentInfo':
				$return =  (new Students\Application\StudentController())->updateStudentInfo(); 
				break;

			case 'RouteLocation.update':
				$return =  (new Locations\Application\RouteLocationController())->updateDays(); 
				break;

		}

		echo json_encode($return);
		
		return true;
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
				
				
				case 'Driver.delete':
					return response((new Drivers\Application\DriverController())->delete());
					break;

				case 'Parents.delete':
					return response((new Customers\Application\ParentController())->delete());
					break;

				case 'RouteLocation.delete':
					return response((new Locations\Application\RouteLocationController())->delete());
					break;

				case 'Student.delete':
					return response((new Students\Application\StudentController())->delete());
					break;

				case 'Notification.delete':
					return response((new Notifications\Application\NotificationController())->delete());
					break;


			}

			echo json_encode($return);
		
			return true;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
	} 

	
}
