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

		$params = $this->app->params() ? (array)  json_decode($this->app->params()) : [];

		switch ($model) 
		{
			case 'APP':
				$return = ['app'=>$this->app, 'lang'=>(new \helper\Lang($this->app->default_lang))->load()->vueLang()];
				break;

			case 'help_message':
				$return = (new \Medians\Help\Application\HelpMessageController())->storeMobile();
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

			case 'create_trip':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->createTrip($params);
				break;

			case 'end_trip':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->endTrip($params);
				break;

			case 'update_pickup':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->updateTripPickup($params);
				break;

			case 'update_destination':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->updateTripDestination($params);
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
				$return =  (new Parents\Application\ParentController())->signup(); 
				break;

			case 'Parent.login':
				$return =  (new Parents\Application\ParentController())->login(); 
				break;

			case 'Driver.login':
				$return =  (new Drivers\Application\DriverController())->login(); 
				break;

			case 'Parents.resetPassword':
				$return =  (new Parents\Application\ParentController())->resetPassword(); 
				break;

			case 'Drivers.resetPassword':
				$return =  (new Drivers\Application\DriverController())->resetPassword(); 
				break;
			
			case 'notifications':
				$return =  (new Notifications\Application\NotificationController())->loadLatestMobileNotifications(); 
				break;

			case 'student_pickup':
				$return =  (new Locations\Application\PickupLocationController())->loadPickup(); 
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
				$return =  (new Parents\Application\ParentController())->changePassword(); 
				break;
				
			case 'Parents.getActiveParentTrip':
				$return =  (new Trips\Application\TripController())->getActiveParentTrip(); 
				break;
				
				
			case 'Parents.resetChangePassword':
				$return =  (new Parents\Application\ParentController())->resetChangePassword(); 
				break;
				
			case 'Driver.changePassword':
				$return =  (new Drivers\Application\DriverController())->changePassword(); 
				break;
				
			case 'Drivers.resetChangePassword':
				$return =  (new Drivers\Application\DriverController())->resetChangePassword(); 
				break;
				
			case 'Driver.getActiveDriverTrip':
				$return =  (new Trips\Application\TripController())->getActiveDriverTrip(); 
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
				$return = (new Parents\Application\ParentController())->updateMobile(); 
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

			case 'PickupLocation.update':
				$return =  (new Locations\Application\PickupLocationController())->updateDays(); 
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
					return response((new Parents\Application\ParentController())->delete());
					break;

				case 'PickupLocation.delete':
					return response((new Locations\Application\PickupLocationController())->delete());
					break;

				case 'Student.delete':
					return response((new Students\Application\StudentController())->delete());
					break;


			}

			echo json_encode($return);
		
			return true;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
	} 

	
}
