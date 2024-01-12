<?php

namespace Medians\Plans\Application;
use \Shared\dbaser\CustomController;

use Medians\Plans\Infrastructure\PlanFeatureRepository;
use Medians\Plans\Infrastructure\PlanRepository;

class PlanFeatureController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $planRepo;

	function __construct()
	{
		$this->repo = new PlanFeatureRepository();
		$this->planRepo = new PlanRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "feature_id", 'text'=> "#"],
            [ 'value'=> "plan.name", 'text'=> __('Plan name'), 'sortable'=> true ],
            [ 'value'=> "code", 'text'=> __('code'), 'sortable'=> true ],
            [ 'value'=> "access", 'text'=> __('Limit'), 'sortable'=> true ],
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
            [ 'key'=> "feature_id", 'title'=> "#", 'column_type'=>'hidden'],
			[ 'key'=> "plan_id", 'title'=> __('Plan'), 
				'sortable'=> true, 'fillable'=> true, 'required'=>true, 'column_type'=>'select','text_key'=>'name', 
				'data' => $this->planRepo->get()  
			],
			[ 'key'=> "code", 'title'=> __('Feature code'), 'required'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "access", 'title'=> __('Access'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'number' ],

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
		return render('plan_features', [
	        'load_vue' => true,
	        'title' => __('plan_features'),
	        'items' => $this->repo->get(),
	        'plans' => $this->planRepo->get(),
	        'columns' => $this->columns(),
	        'fillable' => $this->fillable(),
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

        try {
        	$params['created_by'] = $this->app->auth()->id;
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


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
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

           	$returnData =  ($this->repo->delete($params['feature_id']))
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
