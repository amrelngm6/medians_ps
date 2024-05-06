<?php

namespace Medians\Plans\Application;
use \Shared\dbaser\CustomController;

use Medians\Plans\Infrastructure\PlanSubscriptionRepository;
use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Users\Infrastructure\UserRepository;

class PlanSubscriptionController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $planRepo;

	protected $userRepo;

	function __construct()
	{
		$this->repo = new PlanSubscriptionRepository();
		$this->planRepo = new PlanRepository();
		$this->userRepo = new UserRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "subscription_id", 'text'=> "#"],
            [ 'value'=> "plan.name", 'text'=> translate('Plan'), 'sortable'=> true ],
            [ 'value'=> "business.business_name", 'text'=> translate('Business'), 'sortable'=> true ],
            [ 'value'=> "user", 'text'=> translate('User'), 'sortable'=> true ],
            [ 'value'=> "type", 'text'=> translate('Type'), 'sortable'=> true ],
            [ 'value'=> "start_date", 'text'=> translate('From'), 'sortable'=> true ],
            [ 'value'=> "end_date", 'text'=> translate('To'), 'sortable'=> true ],
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
			[ 'key'=> "plan.name", 'title'=> translate('Plan'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "business.business_name", 'title'=> translate('Business'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "user.name", 'title'=> translate('User'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],

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
		return render('plan_subscriptions', [
	        'load_vue' => true,
	        'title' => translate('plan_subscriptions'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
	        'fillable' => $this->fillable(),
	        'plans' => $this->planRepo->get(),
	        'users' => $this->userRepo->getModerators(),
	    ]);
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
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>true)
           	: array('error'=>'Not allowed');

        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}

}
