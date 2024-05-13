<?php

namespace Medians\Plans\Application;
use \Shared\dbaser\CustomController;

use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Plans\Infrastructure\PlanFeatureRepository;

class PlanController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $featuresRepo;


	function __construct()
	{
		$this->repo = new PlanRepository();
		$this->featuresRepo = new PlanFeatureRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "plan_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> translate('Plan name'), 'sortable'=> true ],
            [ 'value'=> "type", 'text'=> translate('type'), 'sortable'=> true ],
            [ 'value'=> "monthly_cost", 'text'=> translate('Cost per month'), 'sortable'=> true ],
            [ 'value'=> "yearly_cost", 'text'=> translate('Cost per year'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
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
            [ 'key'=> "plan_id", 'title'=> "#", 'column_type'=>'hidden'],
			[ 'key'=> "name", 'title'=> translate('plan_name'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "type", 'title'=> translate('Plan Payment'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 
				'data' => [['name'=>'Free', 'type'=>'free'], ['name'=>'Paid', 'type'=>'paid']]
			],
			[ 'key'=> "monthly_cost", 'title'=> translate('Cost per month'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
			[ 'key'=> "yearly_cost", 'title'=> translate('Cost per year'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'number' ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'checkbox' ],

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
		return render('plans', [
	        'load_vue' => true,
	        'title' => translate('Plans'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
	        'items' => $this->repo->get(),
	        'features' => $this->featuresRepo->getGrouped(),
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
        
		$params = $this->app->params();

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

		$params = $this->app->params();

        try {

			$params['status'] = isset($params['status']) ? $params['status'] : null;

           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>true)
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

		$params = $this->app->params();

        try {

           	return  ($this->repo->delete($params['plan_id']))
            ? array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1)
           	: array('error'=>translate('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
