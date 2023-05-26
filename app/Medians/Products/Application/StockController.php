<?php

namespace Medians\Products\Application;

use Medians\Products\Application\ProductController;


class StockController
{


	function __construct()
	{

		$this->repo = new \Medians\Products\Infrastructure\StockRepository();

		$this->ProductsRepo = new \Medians\Products\Infrastructure\ProductsRepository();
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
                'key'=> "stock",
                'title'=> __('Qty'),
                'sortable'=> true,
            ],
            [
                'key'=> "type",
                'title'=> __('type'),
                'sortable'=> true,
            ],
            [
                'key'=> "date",
                'title'=> __('date'),
                'sortable'=> true,
            ],
            [
                'key'=> "user_name",
                'title'=> __('By'),
                'sortable'=> false,
            ]
        ];
	}



	public function index() 
	{	
		$this->app = new \config\APP;

		$request = $this->app->request();

		$params = [];
    	$params['created_by'] = $request->get('created_by');
    	$params['status'] = $request->get('status');
    	$params['product'] = $request->get('product');
    	$params['by'] = $request->get('by');
    	$params['type'] = $request->get('type');
    	// $params['start'] = $request->get('start') ? date('Y-m-d', strtotime(date($request->get('start')))) : date('Y-m-d');
    	// $params['end'] = ($request->get('end') && $request->get('start')) ? date('Y-m-d',strtotime(date($request->get('end')))) : date('Y-m-d');

	    return render('stock', [
	        'title' => __('Products Stock'),
	        'load_vue' => true,
	        'items' => $this->repo->get($params, 1000),
	        'products' => $this->ProductsRepo->get(),
	        'columns' => $this->columns(),
	    ]);
	}


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
            $params['date'] = date('Y-m-d');

            return !empty($this->repo->store($params)) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>__('Error'), 'error'=>1);


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
	
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

           	$returnData =  $this->repo->delete($params['id'])
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return response($returnData);

	}





}
