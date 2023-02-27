<?php

namespace Medians\Application;

use Medians\Infrastructure as Repo;


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
				$controller = (new Repo\Users\UserRepository());
				break;
			case 'OrderDevice':
				$controller = (new Repo\Devices\OrderDevicesRepository());
				break;
			case 'Devices':
				return json_encode((new Repo\Devices\DevicesRepository())->getApi());
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
					$return = (new Devices\DeviceController())->store();
					break;
				case 'Category.create':
					$return = (new Categories\CategoryController())->store();
					break;
				case 'Game.create':
					$return = (new Games\GameController())->store();
					break;
				case 'Product.create':
					$return = (new Products\ProductController())->store();
					break;
				case 'OrderDevice.addProduct':
					$return = (new Devices\DeviceController())->addProduct();
					break;
				case 'Stock.create':
					$return = (new Products\StockController())->store();
					break;
				case 'Payment.create':
					$return = (new Payments\PaymentController())->store();
					break;
				case 'Event.create':
					$params = (array)  json_decode($request->get('params')['event']);
					$check = (new Repo\Devices\DevicesRepository())->storeOrder($params);
					$return = isset($check->id) ? ['result'=>'Created'] : ['result'=>'Error'];
					break;

	            case 'User.create':
	                $return =  (new Users\UserController())->store(); 
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
                $return =  (new Devices\DeviceController())->update(); 
				break;
			case 'Category.update':
				$return = (new Categories\CategoryController)->update($request);
				break;
			case 'Game.update':
				$return = (new Games\GameController())->update($request);
				break;
			case 'Product.update':
				$return = (new Products\ProductController())->update();
				break;
			case 'Payment.update':
				$return = (new Payments\PaymentController())->update();
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new Repo\Devices\DevicesRepository())->updateOrder($params);
				$return = isset($check->id) ? ['result'=>'Updated'] : ['result'=>'Error'];
				break;
            case 'Settings.update':
                $return = (new Settings\SettingsController())->update(); 
                break;

            case 'User.update':
                $return =  (new Users\UserController())->update(); 
                break;
		}

		return response(json_encode($return));
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
					$return = (new Devices\DeviceController())->removeProduct();
					break;

				case 'Category.delete':
					return (new Categories\CategoryController())->delete();
					break;

				case 'Game.delete':
					return response((new Games\GameController())->delete());
					break;

				case 'Stock.delete':
					return (new Products\StockController())->delete();
					break;

			}

			return response(json_encode(['status'=>true, 'result'=>$return]));

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
				$return = (new Repo\Devices\DevicesRepository())->find($id)->update(['status'=>$status]);
				break;
		}

		return response(json_encode($return));
	} 

}
