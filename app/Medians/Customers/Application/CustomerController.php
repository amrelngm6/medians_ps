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
                'title'=> translate('name'),
                'sortable'=> true,
            ],
            [
                'key'=> "mobile",
                'title'=> translate('mobile'),
                'sortable'=> true,
                'type'=> 'number',
            ],
            [
                'key'=> "bookings_count",
                'title'=> translate('bookings_count'),
                'sortable'=> true,
            ],
            [
                'key'=> "last_invoice_code",
                'title'=> translate('Last invoice'),
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
	        'title' => translate('Customers'),
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
	        'Model' => $this->repo->getClassName(),
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
	        	return array('error'=>translate('Name is required'), 'result'=>translate('Name is required'));

			if (empty($params['mobile']))
	        	return array('error'=> translate('Phone is required'), 'result'=> translate('Phone is required'));

			if (strlen($params['mobile']) != 11)
	        	return array('error'=> translate('MOBILE_ERR'), 'result'=> translate('MOBILE_ERR') );

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


	/**
	 * Login with Google from APP 
	 */
	public function loginWithGoogle() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		print_r($params);
	}
}
