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
            [ 'value'=> "code", 'text'=> translate('code'), 'sortable'=> true ],
            [ 'value'=> "plan.name", 'text'=> translate('Plan name'), 'sortable'=> true ],
            [ 'value'=> "access", 'text'=> translate('Limit'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            // [ 'value'=> "delete", 'text'=> translate('delete')  ],
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
			[ 'key'=> "code", 'title'=> translate('Feature code'), 'required'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "access", 'title'=> translate('Access'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'number' ],
			[ 'key'=> "plan_name", 'title'=> translate('plan_name'), 'required'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],

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
	        'title' => translate('plan_features'),
	        'items' => $this->repo->get(),
	        'plans' => $this->planRepo->get(),
	        'columns' => $this->columns(),
	        'fillable' => $this->fillable(),
			'no_create' => true
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
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>translate('Error'), 'error'=>1);


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
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
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
           	? array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1)
           	: array('error'=>translate('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
