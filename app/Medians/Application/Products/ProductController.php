<?php

namespace Medians\Application\Products;

use Medians\Infrastructure\Products\ProductsRepository;
use Medians\Application\Devices\DeviceController;

class ProductController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->repo = new ProductsRepository();
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
		return render('views/admin/products/products.html.twig', [
	        'title' => __('Products list'),
	        'products' => $this->repo->get(),
	        'typesList' => $this->repo->getModel()->categoriesList(),
	        'stock' => new StockController(null),
	    ]);
	}

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function stock_alert() 
	{
		$this->app = new \config\APP;

		return render('views/admin/products/products.html.twig', [
	        'title' => __('Stock alert products'),
	        'products' => $this->repo->getByStock((Int) $this->app->setting('stock_alert')),
	        'typesList' => $this->repo->getModel()->categoriesList(),
	        'stock' => new StockController(null),
	    ]);
	}

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function stock_out() 
	{

		return render('views/admin/products/products.html.twig', [
	        'title' => __('Stock out products'),
	        'products' => $this->repo->getByStockOut(),
	        'typesList' => $this->repo->getModel()->categoriesList(),
	        'stock' => new StockController(null),
	    ]);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function edit($id) 
	{
		return render('views/admin/products/product.html.twig', [
	        'title' => __('EDIT_PAGE'),
	        'product' => $this->repo->find($id),
	        'typesList' => $this->repo->getModel()->categoriesList(),
	        'stock' => new StockController(null),
	    ]);
	}



	// /**
	//  * Get product order page
	//  * 
	//  * @param Silex\Application $app
	//  * @param \Twig\Environment $twig
	//  * 
	//  */ 
	// public function pos(Int $deviceId) 
	// {
		
	//     return render('views/admin/products/pos.html.twig', [
	//         'title' => __('Products list'),
	//         'device' => (new DeviceController)->getItem($deviceId),
	//         'products' => $this->getByBranch($app->branch->id),
	//         'stock' => new StockController(null),
	//     ]);
	// }



	/**
	 * Store item to database
	 * 
	 * @return [] 
	*/
	public function store() 
	{	
		$this->app = new \config\APP;
        
		$params = $this->app->request()->get('params');

        try {
        	$params['created_by'] = $this->app->auth()->id;
        	$params['branch_id'] = $this->app->branch->id;
            return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>__('Error'), 'error'=>1);


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
	
	}



	/**
	 * Update item to database
	 * 
	 * @return [] 
	*/
	public function update() 
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'redirect'=>$this->app->CONF['url'].'products/index')
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}

	/**
	 * Delete item from database
	 * 
	 * @return [] 
	*/
	public function delete() 
	{
		$params = $request->get('params');

        try {

        	$check = $this->getItem($params['id']);

           	$returnData =  (($app->branchSession->id == $check->branchId) && $this->repo->delete($params['id']))
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



	public function updateStock($id, $newVal) : ProductModel
	{

		$this->ProductModel = $this->getItem($id);	
		$this->ProductModel->setStock( $newVal );	

		return $this->executeEdit();
	}




}
