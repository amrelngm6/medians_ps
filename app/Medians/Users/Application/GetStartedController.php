<?php

namespace Medians\Users\Application;

use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Plans\Infrastructure\PlanSubscriptionRepository;

use Medians\Settings\Application\SettingsController;
use Medians\Payments\Application\PaymentService;

class GetStartedController 
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	protected $app;

	public $planRepo;
	
	public $planSubscriptionRepo;

	function __construct()
	{
		$this->app = new \config\APP;		


		$this->planSubscriptionRepo = new PlanSubscriptionRepository();

		$this->planRepo = new PlanRepository();
		
	}



	/**
	 * Get-started page 
	 * for set configuration
	 */
	public function get_started()
	{

		return render('get_started', [
			'load_vue'=> true,
			'plans' =>   $this->planRepo->get(),
	        'title' => __('Get_started'),
	    ]);
		return render('views/admin/get-started.html.twig',['user'=>$this->app->auth()]);

	}





	/**
	*  Store setting for new user
	*/
	public function store_setting() 
	{
		return (new SettingsController)->update();
	}



	
	/**
	 * Save the created branch 
	 * for the active session
	 * 
	 */ 
	public function saveActivePlan()
	{

		try {

			$user = $this->app->auth();

			$params = $this->app->params();
			$plan = $this->planRepo->find($params['plan_id']);

			// Check if plan is exist
			if (empty($plan))
				return null;

			// Check if plan is free
			if (!empty($plan->paid))
				return $this->subscribePaidPlan($plan, $params['payment_type']);

			$save = $this->savePlan($plan, $params['payment_type']);

        	return isset($save->id) 
           	? array('success'=>1, 'result'=>__('Created'))
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	} 

	/**
	 * Subscribe to paid plan
	 * 
	 */
	public function savePlan($plan, $paymentType='monthly')
	{

		$days = ($paymentType == 'monthly') ? 30 : 365;

		$params = [];
		// Store new subscription 
    	$params['plan_id'] = $plan->id;
    	$params['user_id'] = $this->app->auth()->id;
    	$params['start_date'] = date('Y-m-d');
    	$params['end_date'] = date('Y-m-d', strtotime('+'.$days.' days', strtotime(date('Y-m-d'))));

		return $this->planSubscriptionRepo->store($params);

	} 

	/**
	 * Subscribe to paid plan
	 * 
	 */
	public function subscribePaidPlan($plan, $paymentType='monthly')
	{

		$payment = new PaymentService;

		$price = number_format($paymentType == 'monthly' ? $plan->monthly_cost : $plan->yearly_cost, 2);

		$payment->title = __('Plan subscription');
		$payment->item_name = $plan->name;
		$payment->item_price = $price;
		$payment->currency = 'USD';
		$payment->sku = 'Plan-'. $plan->id;
		$payment->subtotal = $price;
		$payment->totalcost = $price;

		$payment_url = $payment->getPaymentUrl($payment);

		$_SESSION['payment_plan_id'] = $plan->id;
		$_SESSION['payment_plan_type'] = $paymentType;

    	return !empty($payment_url) 
       	? array('success'=>1, 'result'=>__('Will be redirected to payment page'), 'payment_url'=>$payment_url)
    	: array('error'=> __('invalid Plan') );
	} 


}
