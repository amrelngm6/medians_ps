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
            [
                'key'=> "id",
                'title'=> '#',
                'sortable'=> false,
            ],
            [
                'key'=> "plan_name",
                'title'=> __('Plan'),
                'sortable'=> true,
            ],
            [
                'key'=> "user_name",
                'title'=> __('user_name'),
                'sortable'=> false,
            ],
            [
                'key'=> "branch_name",
                'title'=> __('branch_name'),
                'sortable'=> false,
            ],
            [
                'key'=> "start_date",
                'title'=> __('start_date'),
                'sortable'=> true,
            ],
            [
                'key'=> "end_date",
                'title'=> __('end_date'),
                'sortable'=> true,
            ]
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
	        'items' => $this->getData(),
	        'plans' => $this->planRepo->get(),
	        'columns' => $this->columns(),
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
