<?php

namespace Medians\Users\Application;
use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;
use Medians\Roles\Infrastructure\RoleRepository;


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
            [ 'key'=> "profile_image", 'title'=> __('picture'), 'fillable'=> true, 'column_type'=>'profile_image' ],
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
			'load_vue'=> true,
			'users' =>   $query,
			'roles' =>   $this->rolesRepo->get(),
	        'title' => __('Users'),
	        'fillable' => $this->fillable(),
	    ]);
	} 


	/**
	 * Index page
	 * 
	 */
	public function index_users()
	{
		return render('users', [
			'load_vue'=> true,
			'users' =>   $this->repo->getAll(),
	        'title' => __('Users'),
	    ]);
	} 


	/** 
	 * Query users
	 */
	public function queryByRole($role_id)
	{
		return	$this->repo->getModel()->with('Role')->where('role_id', $role_id)->get();

	} 



	/**
	 * Create page
	 * 
	 */
	public function create()
	{
		return render('views/admin/users/create.html.twig', [
	        'title' => __('Users'),
	        'Model' => $this->repo->getModel(),
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id)
	{

		return render('views/admin/users/create.html.twig', [
	        'title' => __('Users'),
	        'Model' => $this->repo->find($id),
	    ]);
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

			if (isset($params['id'])) 
				return __('ERR');

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

		$params = (array)  $this->app->params();

		try {

			
			if ($this->validateUpdate($params))
			{
	        	return  $this->validateUpdate($params);
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

		$params = (array)  json_decode($this->app->params());

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
