<?php

namespace Medians\Branches\Application;

use \Shared\dbaser\CustomController;

use Medians\Branches\Infrastructure\BranchRepository;
use Medians\Users\Infrastructure\UserRepository;


class BranchController extends CustomController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	public $app;


	function __construct()
	{
		
		$this->repo = new BranchRepository();

		$this->userRepo = new UserRepository();

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
                'title'=> __('branch_name'),
                'sortable'=> true,
            ],
            [
                'key'=> "owner_name",
                'title'=> __('owner_name'),
                'sortable'=> false,
            ],
            [
                'key'=> "info",
                'title'=> __('info'),
                'sortable'=> false,
            ],
            [
                'key'=> "status",
                'title'=> __('status'),
                'sortable'=> true,
            ]
        ];
	}

	/**
	 * Index page
	 * 
	 */
	public function index()
	{

		$this->app = new \config\APP;

		$this->checkBranch();

		return render('branches', [

			'load_vue' => true,
			'columns' => $this->columns(),
			'items' => $this->getData(),
			'users' => $this->getUsers(),
	        'title' => __('branches'),
	    ]);
	} 

	/**
	 * Index page
	 * 
	 */
	public function getData()
	{
		return ($this->app->auth()->role_id === 1) ? $this->repo->get() : [$this->repo->find($this->app->branch->id)];
	} 

	/**
	 * Index page
	 * 
	 */
	public function getUsers()
	{
		return ($this->app->auth()->role_id === 1) ? $this->userRepo->get() : $this->userRepo->find($this->app->auth()->id);
	} 
	


	/**
	*  Store item
	*/
	public function store_branch() 
	{

		$this->app = new \config\APP;

		$params = (array)  $this->app->request()->get('params');

		try {

			$params['status'] = 'on';
			$save = $this->repo->store($params);

			if (isset($save->id))
				$this->saveActiveBranch($save);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created'), 'reload'=>1)
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}


	/**
	 * Save the created branch 
	 * for the active session
	 * 
	 */ 
	public function saveActiveBranch($branch)
	{

		$user = $this->app->auth();

		$user->update(['active_branch'=>$branch->id]);

		return $this;
	} 




	public function store() 
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function update()
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;
            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{


		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');
		
        try {

            if ($this->repo->delete($params['id']))
            {
                return array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1);
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


}
