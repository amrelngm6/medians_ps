<?php

namespace Medians;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Bugs\Infrastructure\BugReportRepository;


class APIController
{

	/**
	* @var Object
	*/
	protected $repo;



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
		switch ($this->app->request()->get('model')) 
		{
			case 'User':
				$controller = new UserRepository();
				break;
			case 'OrderDevice':
				$controller = new OrderDevicesRepository();
				break;
			case 'Devices':
				return json_encode((new DevicesRepository())->getApi());
				break;
			case 'Products':
				$return = (new ProductsRepository())->getItems(['stock'=>true, 'status'=>true]);
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
				case 'Device.create':
					$return = (new Devices\Application\DeviceController())->store();
					break;
				case 'Category.create':
					$return = (new Categories\Application\CategoryController())->store();
					break;
				case 'Game.create':
					$return = (new Games\Application\GameController())->store();
					break;
				case 'Product.create':
					$return = (new Products\Application\ProductController())->store();
					break;
				case 'OrderDevice.addProduct':
					$return = (new Devices\Application\DeviceController())->addProduct();
					break;
				case 'Stock.create':
					$return = (new Products\Application\StockController())->store();
					break;
				case 'Payment.create':
					$return = (new Payments\Application\PaymentController())->store();
					break;
				case 'Customer.create':
				case 'Customers.create':
					$return = (new Customers\Application\CustomerController())->store();
					break;
				case 'Event.create':
					$params = (array)  json_decode($request->get('params')['event']);
					$check = (new DevicesRepository())->storeOrder($params);
					$return = isset($check->id) ? ['result'=>'Created'] : ['result'=>'Error'];
					break;

	            case 'User.create':
	                $return =  (new Users\Application\UserController())->store(); 
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
			case 'Payment.update':
				$return = (new Payments\Application\PaymentController())->update();
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->updateOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;
			case 'Event.cancel':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->cancelOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;
            case 'Settings.update':
                $return = (new Settings\Application\SettingsController())->update(); 
                break;

            case 'Users.update':
                $return = (new Users\Application\UserController())->update(); 
                break;

            case 'User.update':
                $return =  (new Users\Application\UserController())->update(); 
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
					$return = (new Devices\Application\DeviceController())->removeProduct();
					break;

				case 'Category.delete':
					$return = (new Categories\Application\CategoryController())->delete();
					break;

				case 'Product.delete':
					$return = (new Products\Application\ProductController())->delete();
					break;
					
				case 'Game.delete':
					return response((new Games\Application\GameController())->delete());
					break;

				case 'Stock.delete':
					return (new Products\Application\StockController())->delete();
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
