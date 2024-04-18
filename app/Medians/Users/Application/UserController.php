<?php

namespace Medians\Users\Application;
use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;
use Medians\Roles\Infrastructure\RoleRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Trips\Infrastructure\TripRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Invoices\Infrastructure\InvoiceRepository;


class UserController extends CustomController
{


	/*
	/ @var new CustomerRepository
	*/
	protected $repo;

	protected $app;
	protected $rolesRepo;


	function __construct()
	{
		$this->app = new \config\APP;
		$this->repo = new UserRepository();
		$this->rolesRepo = new RoleRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "id", 'title'=> __('id'), 'fillable'=> true, 'column_type'=>'hidden' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=> true, 'column_type'=>'file' ],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('email'), 'fillable'=> true, 'column_type'=>'email', 'required'=>true  ],
            [ 'key'=> "phone", 'title'=> __('phone'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "password", 'title'=> __('password'), 'fillable'=> true, 'column_type'=>'password' ],
            [ 'key'=> "active", 'title'=> __('status'), 'fillable'=> true, 'column_type'=>'hidden' ],
			[ 'key'=> "role_id", 'title'=> __('Role'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 
				'data' => $this->rolesRepo->get()
			],
        ];
	}

	

	/**
	 * Columns list to view in Overview page 
	 * for User Profile page
	 */ 
	public function overview( ) 
	{
		$user = $this->app->auth();

		return [
            // [ 'key'=> $user->id, 'title'=> __('id') ],
            [ 'key'=> $user->first_name, 'title'=> __('first_name'),  ],
            [ 'key'=> $user->last_name, 'title'=> __('last_name'),  ],
            [ 'key'=> $user->email, 'title'=> __('email')   ],
            [ 'key'=> $user->phone, 'title'=> __('phone')  ],
            [ 'key'=> $user->active ? 'Yes' : 'No', 'title'=> __('status') ],
			[ 'key'=> $user->role->name, 'title'=> __('Role') ],
        ];
	}

	

	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		
		$query = ($this->app->auth()->role_id == 1) ? $this->repo->getAll() : $this->repo->get();

		return render('users', [
	        'title' => __('Users'),
			'load_vue'=> true,
			'users' =>   $query,
			'roles' =>   $this->rolesRepo->getWithUsers(),
	        'overview' => $this->overview(),
	        'fillable' => $this->fillable(),
	    ]);
	} 


	/**
	 * Index page
	 * 
	 */
	public function profile()
	{
		
		$user = $this->app->auth();
		$invoicesRepo = new InvoiceRepository($user->business);

		return render('profile', [
			'load_vue'=> true,
	        'title' => __('Users'),
			'user' =>   $user,
            'stats' => $this->getStats($user->business),
	        'overview' => $this->overview(),
	        'fillable' => $this->fillable(),
	        'invoices' => $invoicesRepo->getUserInvoices($user->id),
	    ]);
	} 

	
	
	public function getStats($business) 
	{	

		$data = [];

        $driverRepo = new DriverRepository($business);
        $data['drivers_count'] = count($driverRepo->get(null));
        $vehicleRepo = new VehicleRepository($business);
        $data['vehicles_count'] = count($vehicleRepo->get(null));
        $routesRepo = new RouteRepository($business);
        $data['routes_count'] = count($routesRepo->get(null));
		$tripsRepo = new TripRepository($business);
        $data['trips_count'] = count($tripsRepo->get(null));

		return $data;
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$params = (array)  $this->app->request()->get('params');

		try {

			if ($this->validate($params)) 
				return $this->validate($params);

			$params['role_id'] = !empty($params['role_id']) ? $params['role_id'] : 3;

			$save = $this->repo->store($params);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created'), 'reload'=>1)
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}



	/**
	*  Validate item store
	*/
	public function validate($params) 
	{
		$check = $this->repo->checkDuplicate($params);

		if (empty($params['first_name']))
			return ['result'=> __('Name required')];

		if (empty($params['email']))
			return ['result'=> __('Email required')];

		if (empty($params['password']))
			return ['result'=> __('Password required')];

		if ($check)
			return ['result'=>$check];

	}

	/**
	*  Validate item update
	*/
	public function validateUpdate($params) 
	{

		if (empty($params['first_name']))
			return ['result'=> __('Name required')];

		if (empty($params['email']))
			return ['result'=> __('Email required')];

		if ($params['id'] != $this->app->auth()->id && $this->app->auth()->role_id != 1)
			return ['result'=> __('Not allowed')];
	}



	/**
	*  Update item
	*/
	public function update() 
	{

		$params = (array)  $this->app->request()->get('params');

		try {

			
			if ($this->validateUpdate($params))
			{
	        	return  $this->validateUpdate($params);
			}			

			if (empty($params['password']))
			{
				unset($params['password']);
			}

			$update = $this->repo->update($params);

        	return isset($update->id) 
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
        	: array('error'=> $update );

        } catch (Exception $e) {
            return  ['error' => $e->getMessage()];
        }
	}

	/**
	*  Update item
	*/
	public function updateStatus() 
	{

		$params = (array)  json_decode($this->app->request()->get('params'));

		try {

			$update = $this->repo->updateStatus($params);

        	echo json_encode( isset($update->id) 
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
        	: array('error'=> $update ));

        } catch (Exception $e) {
            return  ['error' => $e->getMessage()];
        }
	}




}
