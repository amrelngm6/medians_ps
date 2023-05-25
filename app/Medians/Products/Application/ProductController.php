<?php

namespace Medians\Products\Application;

use Medians\Products\Infrastructure\ProductsRepository;
use Medians\Devices\Application\DeviceController;

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
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [
                'key'=> "id",
                'title'=> '#',
            ],
            [
                'key'=> "",
                'title'=> '',
            ],
            [
                'key'=> "category_name",
                'title'=> __('category'),
                'sortable'=> true,
            ],
            [
                'key'=> "price",
                'title'=> __('price'),
                'sortable'=> true,
                'type'=>'number'
            ],
            [
                'key'=> "stock",
                'title'=> __('stock'),
                'sortable'=> true,
                'type'=>'number'
            ],
            [
                'key'=> "status",
                'title'=> __('status'),
                'sortable'=> true,
            ]
        ];
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
		return render('products', [
	        'load_vue' => true,
	        'title' => __('Products list'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
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

		return render('products', [
	        'load_vue' => true,
	        'columns' => $this->columns(),
	        'title' => __('Stock alert products'),
	        'items' => $this->repo->getByStock((Int) $this->app->setting('stock_alert')),
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

		return render('products', [
	        'load_vue' => true,
	        'columns' => $this->columns(),
	        'title' => __('Stock out products'),
	        'items' => $this->repo->getByStockOut(),
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
		
		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

           	$returnData =  ($this->repo->delete($params['id']))
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
