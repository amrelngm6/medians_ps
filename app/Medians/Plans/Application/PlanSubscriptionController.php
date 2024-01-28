<?php

namespace Medians\Plans\Application;
use \Shared\dbaser\CustomController;

use Medians\Plans\Infrastructure\PlanSubscriptionRepository;
use Medians\Plans\Infrastructure\PlanRepository;

class PlanSubscriptionController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $planRepo;

	function __construct()
	{
		$this->repo = new PlanSubscriptionRepository();
		$this->planRepo = new PlanRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "subscription_id", 'text'=> "#"],
            [ 'value'=> "plan.name", 'text'=> __('Plan'), 'sortable'=> true ],
            [ 'value'=> "business.business_name", 'text'=> __('Business'), 'sortable'=> true ],
            [ 'value'=> "user.name", 'text'=> __('User'), 'sortable'=> true ],
            [ 'value'=> "start_date", 'text'=> __('From'), 'sortable'=> true ],
            [ 'value'=> "end_date", 'text'=> __('To'), 'sortable'=> true ],
            // [ 'value'=> "edit", 'text'=> __('edit')  ],
            // [ 'value'=> "delete", 'text'=> __('delete')  ],
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
			[ 'key'=> "plan.name", 'title'=> __('Plan'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "business.business_name", 'title'=> __('Business'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "user.name", 'title'=> __('User'), 'disabled'=>true, 'disabled'=> true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],

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
	        'title' => __('plan_subscriptions'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
	        'fillable' => $this->fillable(),
	    ]);
	}


	public function getData()
	{
		$this->app = new \config\APP;

		if ($this->app->auth()->role_id === 1)
			return $this->repo->get();

		if ($this->app->auth()->role_id === 3)
			return $this->repo->getByBranch($this->app->branch->id);
	}

}