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
	protected $repo;

	protected $app;


	/**
	 * Login through Mobile API
	 */
	public function login()
	{
		$Auth = new Auth\Application\AuthService;

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $Auth->checkLogin($params->email, $Auth->encrypt($params->password));

		if (empty($checkLogin->id))
		{
			echo json_encode(['error'=> $checkLogin]);

			return null;
		}

		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		echo json_encode(
		[
			'success'=>true, 
			'user_id'=>$checkLogin->id, 
			'driver_id'=> isset($checkLogin->driver->driver_id) ? $checkLogin->driver->driver_id : null, 
			'token'=>$generateToken->value
		]);
	}  


	/**
	 * Driver Login through Mobile API
	 */
	public function driver_login()
	{
		$Auth = new Auth\Application\AuthService;
		$repo = new Drivers\Infrastructure\DriverRepository;

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->driver_id)) {
			echo json_encode(['error'=> __("User credentials not valid")]); return null;
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->driver_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		echo json_encode(
		[
			'success'=>true, 
			'driver_id'=> isset($checkLogin->driver_id) ? $checkLogin->driver_id : null, 
			'token'=>$generateToken->value
		]);
	}  



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

			case 'help_message':
				$return = (new \Medians\Help\Application\HelpMessageController())->storeMobile();
				break;
				
			case 'help_messages':
				$return = (new \Medians\Help\Application\HelpMessageController())->loadHelpMessages();
				break;

			case 'create_trip':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->createTrip($params);
				break;

			case 'end_trip':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->endTrip($params);
				break;

			case 'update_pickup':
				$return = (new \Medians\Trips\Infrastructure\TripRepository())->updateTrip($params);
				break;

			case 'trips':
				$return = (new \Medians\Trips\Application\TripController())->loadTrips($params);
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

			case 'Parents.resetPassword':
				$return =  (new Parents\Application\ParentController())->resetPassword(); 
				break;

			case 'notifications':
				$return =  (new Notifications\Application\NotificationController())->loadLatestMobileNotifications(); 
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
					
	            case 'Student.create':
	                return  (new Students\Application\StudentController())->addStudent(); 
	                break;


			}

			return json_encode($return);

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

            case 'Driver.update':
				$return = (new Drivers\Application\DriverController())->updateMobile(); 
                break;

			case 'Notification.update':
				$return =  (new Notifications\Application\NotificationController())->update(); 
				break;

			case 'Student.updateStudentInfo':
				$return =  (new Students\Application\StudentController())->updateStudentInfo(); 
				break;

		}

		return json_encode($return);
	} 

	/**
	 * Search model 
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


			}

			return response(json_encode($return));

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
