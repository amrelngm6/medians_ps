<?php

namespace Medians\Application\Payments;

use Medians\Infrastructure\Payments\PaymentsRepository;

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
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
		return render('views/admin/payments/list.html.twig', [
	        'title' => __('Payments list'),
	        'items' => $this->repo->get(),
	    ]);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function create() 
	{
		return render('views/admin/payments/create.html.twig', [
	        'title' => __('New Payment'),
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
		return render('views/admin/payments/payment.html.twig', [
	        'title' => __('Edit Payment'),
	        'payment' => $this->repo->find($id),
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
