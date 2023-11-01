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
		
		// if (empty($checkLogin->status)) {
		// 	echo json_encode(['error'=> __("User account is not active")]); return null;
		// }

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
			case 'OrderDevice':
				$controller = new OrderDevicesRepository();
				break;
			case 'Devices':
				$return = (new DevicesRepository())->getByBranch($this->app->branch->id);
				break;
			case 'Products':
				$return = (new ProductsRepository())->getItems(['stock'=>true, 'status'=>true]);
				break;
			case 'help_message':
				$return = (new \Medians\Help\Application\HelpMessageController())->storeMobile();
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
				case 'User.get_started_save_branch':
					$return = (new Users\Application\GetStartedController())->store_branch();
					break;

				case 'User.get_started_save_setting':
					$return = (new Users\Application\GetStartedController())->store_setting();
					break;


				case 'User.create':
					$return = (new Users\Application\UserController())->store();
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

		$return = [];
		switch ($request->get('type')) 
		{
			case 'SystemSettings.update':
                $return =  (new Settings\Application\SystemSettingsController())->update(); 
				break;

			case 'Branch.update':
                $return =  (new Branches\Application\BranchController())->update(); 
				break;

			case 'Device.update':
                $return =  (new Devices\Application\DeviceController())->update(); 
				break;
				
			case 'Category.update':
				$return = (new Categories\Application\CategoryController)->update($request);
				break;

			case 'Game.update':
				$return = (new Games\Application\GameController())->update($request);
				break;
			case 'Product.update':
				$return = (new Products\Application\ProductController())->update();
				break;
			case 'Expense.update':
				$return = (new Expenses\Application\ExpenseController())->update();
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->updateOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;

			case 'Booking.update':
				$params = (array)  json_decode($request->get('params'));
				$return = (new DevicesRepository())->updateBooking($params);
				break;


			case 'Event.cancel':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->cancelOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;
            case 'Settings.update':
                $return = (new Settings\Application\SettingsController())->update(); 
                break;

            case 'User.update':
                $return = (new Users\Application\UserController())->update(); 
                break;

            case 'User.update':
                $return =  (new Users\Application\UserController())->update(); 
                break;

            case 'Page.update':
                $return =  (new Pages\Application\PageController())->update(); 
                break;

            case 'NotificationEvent.update':
                $return =  (new Notifications\Application\NotificationEventController())->update(); 
                break;



		}

		return response(json_encode($return));
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
				case 'OrderDevice.removeProduct':
					$return = (new Devices\Application\CalendarController())->removeProduct();
					break;

				case 'Category.delete':
					$return = (new Categories\Application\CategoryController())->delete();
					break;

				case 'Branch.delete':
					$return = (new Branches\Application\BranchController())->delete();
					break;

				case 'Product.delete':
					$return = (new Products\Application\ProductController())->delete();
					break;
					
				case 'Game.delete':
					return response((new Games\Application\GameController())->delete());
					break;
					
				case 'Device.delete':
					return response((new Devices\Application\DeviceController())->delete());
					break;

				case 'User.delete':
					return response((new Users\Application\UserController())->delete());
					break;

				case 'Customer.delete':
					return response((new Customers\Application\CustomerController())->delete());
					break;

				case 'Stock.delete':
					return response((new Products\Application\StockController())->delete());
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
