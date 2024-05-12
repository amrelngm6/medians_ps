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
            [ 'value'=> "brand_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> translate('name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> translate('Logo'),  ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
        ];
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "customer_id", 'title'=> "#", 'column_type'=>'hidden'],
			[ 'key'=> "name", 'title'=> translate('Name'), 'required'=>true,  'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "email", 'title'=> translate('Email'), 'required'=>true,  'fillable'=> true, 'column_type'=>'email' ],
			[ 'key'=> "mobile", 'title'=> translate('Mobile'), 'required'=>true,  'fillable'=> true, 'column_type'=>'phone' ],
			[ 'key'=> "birth_date", 'title'=> translate('Date of birth'), 'required'=>true,  'fillable'=> true, 'withLabel'=> true, 'column_type'=>'date' ],
			[ 'key'=> "gender", 'title'=> translate('Gender'),  'fillable'=> true, 'withLabel'=> true, 'column_type'=>'select', 'required'=> true, 'text_key'=>'title',  'data' => 
				[['gender'=> 'male', 'title'=>translate('Male')], ['gender'=> 'female', 'title'=>translate('Female')]]	
			],
			[ 'key'=> "picture", 'title'=> translate('Picture'), 'withLabel'=> true,   'fillable'=> true, 'column_type'=>'file'
			],
        ];
	}

	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		return render('data_table', [
			'items' =>  $this->repo->get(),
	        'title' => translate('Customers'),
	        'load_vue' => true,
			'columns' =>  $this->columns(),
			'fillable' =>  $this->fillable(),
			'object_name' => 'Customer',
			'object_key' => 'customer_id',

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

        	return array('success'=>1, 'result'=> $Item, 'reload'=>1);

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
