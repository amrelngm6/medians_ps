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
	public function index($request, $app)
	{
		return render('views/admin/customers/list.html.twig', [
			'items' =>  $this->repo->get(),
	        'title' => 'Customers',
	        'app' => $app,
	    ]);
	} 


	/**
	 * Create page
	 * 
	 */
	public function create($request, $app)
	{
		return render('views/admin/customers/create.html.twig', [
	        'title' => 'Customers',
	        'Model' => $this->repo->getModel(),
	        'app' => $app,
	    ]);
	} 





	/**
	*  Store item
	*/
	public function store() 
	{



		$params = (array) json_decode($this->app->request()->get('params')['customer']);

		try {	

			if (empty($params['name']))
	        	return array('error'=>1, 'result'=>'Name is required');

			if (empty($params['mobile']))
	        	return array('error'=>1, 'result'=>'Phone is required');

			if (strlen($params['mobile']) != 11)
	        	return array('error'=>1, 'result'=> __('MOBILE_ERR') );

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
