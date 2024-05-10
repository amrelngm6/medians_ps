<?php

namespace Medians\Customers\Application;
use \Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure as Repo;



class CustomerController extends CustomController
{


	/*
	/ @var new CustomerRepository
	*/
	protected $repo;

	protected $app;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new Repo\CustomerRepository();


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
                'key'=> "name",
                'title'=> __('name'),
                'sortable'=> true,
            ],
            [
                'key'=> "mobile",
                'title'=> __('mobile'),
                'sortable'=> true,
                'type'=> 'number',
            ],
            [
                'key'=> "bookings_count",
                'title'=> __('bookings_count'),
                'sortable'=> true,
            ],
            [
                'key'=> "last_invoice_code",
                'title'=> __('Last invoice'),
                'sortable'=> false,
            ]
        ];
	}

	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		return render('customers', [
			'items' =>  $this->repo->get(),
	        'title' => __('Customers'),
	        'load_vue' => true,
			'columns' =>  $this->columns(),
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


		$params_request = $this->app->params();
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
	*  Update item
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
	 * 
	 * @param String
	 * 
	 * @return JSON
	 */
	public function search($text)
	{
		$data = $this->repo->search($text);


		echo json_encode(array('success'=>1, 'result'=> $data->toArray()));

	}  

}
