<?php

namespace Medians\Payments\Application;

use Medians\Payments\Infrastructure\PaymentsRepository;

class PaymentController
{

	/*
	// @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->repo = new PaymentsRepository();
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
                'sortable'=> false,
            ],
            [
                'key'=> "name",
                'title'=> __('name'),
                'sortable'=> false,
            ],
            [
                'key'=> "amount",
                'title'=> __('amount'),
                'sortable'=> true,
            ],
            [
                'key'=> "invoice_id",
                'title'=> __('invoice_number'),
                'sortable'=> false,
            ],
            [
                'key'=> "user_name",
                'title'=> __('by'),
                'sortable'=> true,
            ],
            [
                'key'=> "date",
                'title'=> __('date'),
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
		return render('payments', [
			'load_vue'=> true,
	        'title' => __('Payments list'),
	        'items' => $this->repo->get(),
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

		$params = $this->app->request()->get('params')['payment'];

        try {
        	$params['branch_id'] = $this->app->branch->id;
        	$params['created_by'] = $this->app->auth()->id;
        	
            return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('error'=>__('Err'));


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

		$params = $this->app->request()->get('params')['payment'];

        try {


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'redirect'=>$this->app->CONF['url'].'payments/index')
           	: array('error'=>__('Not allowed'));


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

           	$returnData =  $this->repo->delete($params['id'])
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return response($returnData);

	}





}
