<?php

namespace Medians\Devices\Application;

use \Shared\dbaser\CustomController;

use Medians\Devices\Infrastructure\DevicesRepository;
use Medians\Products\Infrastructure\ProductsRepository;
use Medians\Categories\Infrastructure\CategoryRepository;


class BookingController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	/**
	* @var Device
	*/
	protected $Device;

	/**
	* @var Array
	*/
	protected $app;
	
	public $productsRepo;
	
	public $CategoryRepo;

	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new DevicesRepository();

	    // Set Categories
	    $this->CategoryRepo = new CategoryRepository();

	    // Set Categories
	    $this->productsRepo = new ProductsRepository();
		
		$this->checkBranch();

	}



	/**
	 * Calendar index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
	    return render('booking_follow', [
	        'load_vue' => true,
	        'title' => __('Devices list'),
	        'products' => $this->productsRepo->getItems(['status'=>true, 'stock'=>true]),
	        'devicesList' => $this->repo->getWithBookings(50),
	        // 'typesList' => $this->CategoryRepo->categories(get_class($this->repo->getModel())),
	    ]);
	}



	/** 
	 * Add product to active booking
	 * 
	 */ 
	public function addProduct()
	{

		$product = (array)  json_decode($this->app->request()->get('params')['product']);
		$params = (array)  json_decode($this->app->request()->get('params')['device']);

		try {

			$product['qty'] = 1;
			$save = $this->repo->storeProduct($params['id'], $product);

        	return array('status'=>'success', 'result'=> __('Added'));

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}

	/**
	 * Remove product from booking
	 * 
	 */ 
	public function removeProduct()
	{

		$params = (array)  json_decode($this->app->request()->get('params')['product']);

		try {

			$save = $this->repo->removeProduct($params['id']);

        	return array('status'=>'success', 'result'=> $save);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}


}
