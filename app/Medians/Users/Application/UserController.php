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
            [ 'key'=> "id", 'title'=> translate('id'), 'fillable'=> true, 'column_type'=>'hidden' ],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=> true, 'column_type'=>'file' ],
            [ 'key'=> "first_name", 'title'=> translate('first_name'), 'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "last_name", 'title'=> translate('last_name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('email'), 'fillable'=> true, 'column_type'=>'email', 'required'=>true  ],
            [ 'key'=> "phone", 'title'=> translate('phone'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "password", 'title'=> translate('password'), 'fillable'=> true, 'column_type'=>'password' ],
            [ 'key'=> "active", 'title'=> translate('status'), 'fillable'=> true, 'column_type'=>'hidden' ],

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
            // [ 'key'=> $user->id, 'title'=> translate('id') ],
            [ 'key'=> $user->first_name, 'title'=> translate('first_name'),  ],
            [ 'key'=> $user->last_name, 'title'=> translate('last_name'),  ],
            [ 'key'=> $user->email, 'title'=> translate('email')   ],
            [ 'key'=> $user->phone, 'title'=> translate('phone')  ],
            [ 'key'=> $user->active ? 'Yes' : 'No', 'title'=> translate('status') ],
			[ 'key'=> $user->role->name, 'title'=> translate('Role') ],
        ];
	}

	

	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		$user = $this->app->auth();

		return render('users', [
	        'title' => translate('Users'),
			'load_vue'=> true,
			'roles' =>  $this->rolesRepo->getWithUsers($user),
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
		$invoicesRepo = new InvoiceRepository();

		return render('profile', [
			'load_vue'=> true,
	        'title' => translate('Users'),
			'user' =>   $user,
            'stats' => $this->getStats(),
	        'overview' => $this->overview(),
	        'fillable' => $this->fillable(),
	        'invoices' => $invoicesRepo->getUserInvoices($user->id),
	    ]);
	} 

	
	
	public function getStats() 
	{	

		$data = [];

        $driverRepo = new DriverRepository();
        $data['drivers_count'] = count($driverRepo->get(null));
        $vehicleRepo = new VehicleRepository();
        $data['vehicles_count'] = count($vehicleRepo->get(null));
        $routesRepo = new RouteRepository();
        $data['routes_count'] = count($routesRepo->get(null));
		$tripsRepo = new TripRepository();
        $data['trips_count'] = count($tripsRepo->get(null));

		return $data;
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$params = (array)  $this->app->params();

		try {

			if ($this->validate($params)) 
				return $this->validate($params);

			$params['role_id'] = !empty($params['role_id']) ? $params['role_id'] : 3;

			$save = $this->repo->store($params);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>translate('Created'), 'reload'=>1)
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
			return ['result'=> translate('Name required')];

		if (empty($params['email']))
			return ['result'=> translate('Email required')];

		if (empty($params['password']))
			return ['result'=> translate('Password required')];

		if ($check)
			return ['result'=>$check];

	}

	/**
	*  Validate item update
	*/
	public function validateUpdate($params) 
	{

		if (empty($params['first_name']))
			return ['result'=> translate('Name required')];

		if (empty($params['email']))
			return ['result'=> translate('Email required')];

		if ($params['id'] != $this->app->auth()->id && $this->app->auth()->role_id != 1)
			return ['result'=> translate('Not allowed')];
	}



	/**
	*  Update item
	*/
	public function update() 
	{

		$params = (array)  $this->app->params();

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
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
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

		$params = (array)  json_decode($this->app->params());

		try {

			$update = $this->repo->updateStatus($params);

        	echo json_encode( isset($update->id) 
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
        	: array('error'=> $update ));

        } catch (Exception $e) {
            return  ['error' => $e->getMessage()];
        }
	}




}
