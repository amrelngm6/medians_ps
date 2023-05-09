<?php

namespace Medians\Customers\Application;

use Medians\Customers\Infrastructure as Repo;



class CustomerController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new Repo\CustomerRepository();


	}


	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		return render('views/admin/customers/list.html.twig', [
			'items' =>  $this->repo->get(),
	        'title' => 'Customers',
	        'app' => $this->app,
	    ]);
	} 


	/**
	 * Create page
	 * 
	 */
	public function create()
	{
		return render('views/admin/customers/create.html.twig', [
	        'title' => 'Customers',
	        'Model' => $this->repo->getModel(),
	        'app' => $this->app,
	    ]);
	} 





	/**
	*  Store item
	*/
	public function store() 
	{


		$params_request = $this->app->request()->get('params');
		$params = isset($params_request['customer']) ? (array) json_decode($params_request['customer']) : $params_request;

		try {	

			if (empty($params['name']))
	        	return array('error'=>__('Name is required'), 'result'=>__('Name is required'));

			if (empty($params['mobile']))
	        	return array('error'=> __('Phone is required'), 'result'=> __('Phone is required'));

			if (strlen($params['mobile']) != 11)
	        	return array('error'=> __('MOBILE_ERR'), 'result'=> __('MOBILE_ERR') );

			$params['created_by'] = $this->app->auth()->id;
			$Item = $this->repo->store($params);

        	return array('success'=>1, 'result'=> $Item);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  Store item
	*/
	public function update($request, $app) 
	{

		$params = (array)  json_decode($request->get('params')['customer']);

		try {

			$this->repo->app = $app;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}


	/**
	 * Find customer by mobile
	 */

	public function search($text)
	{
		$data = $this->repo->search($text);


		echo json_encode(array('success'=>1, 'result'=> $data->toArray()));

	}  

}
