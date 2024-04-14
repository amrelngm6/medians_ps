<?php

namespace Medians\Packages\Application;
use \Shared\dbaser\CustomController;

use Medians\Packages\Infrastructure\PackageRepository;

class PackageController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;



	function __construct()
	{
		$this->app = new \config\APP;

		$this->repo = new PackageRepository($this->app->auth()->business);
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "package_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> __('Package name'), 'sortable'=> true ],
            [ 'value'=> "description", 'text'=> __('Description'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('edit')  ],
            [ 'value'=> "delete", 'text'=> __('delete')  ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "package_id", 'title'=> "#", 'column_type'=>'hidden'],
			[ 'key'=> "name", 'title'=> __('package_name'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "description", 'title'=> __('Desc'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'textarea' ],
			[ 'key'=> "single_cost_month", 'title'=> __('1-Trip Cost per-month'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "single_cost_quarter", 'title'=> __('1-Trip Cost per-quarter'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "single_cost_year", 'title'=> __('1-Trip Cost per-year'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "double_cost_month", 'title'=> __('2-Trip Cost per-month'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "double_cost_quarter", 'title'=> __('2-Trip Cost per-quarter'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "double_cost_year", 'title'=> __('1-Trip Cost per-year'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
            [ 'key'=> "status", 'title'=> __('Status'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'checkbox' ],

        ];
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
		return render('packages', [
	        'load_vue' => true,
	        'title' => __('Packages'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
	        'items' => $this->repo->get(),
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
        
		$params = $this->app->request()->get('params');

        try 
		{
        	$user = $this->app->auth();

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;
			$params['business_id'] = $user->business->business_id;
			$params['created_by'] = $user->id;
            
			return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>__('Error'), 'error'=>1);


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

		$params = $this->app->request()->get('params');

        try {

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;

           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>true)
           	: array('error'=>'Not allowed');


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

           	return  ($this->repo->delete($params['package_id']))
            ? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}

	
	/**
	 * Load private trip for Driver
	 */
	public function load_business_packages()
	{
		$user = $this->app->auth();

		if (empty($user)) { return null; }
		
		$businessId = (array) $this->app->request()->get('busness_id');

		return $this->repo->loadByBusiness($businessId);

	}

	

}
