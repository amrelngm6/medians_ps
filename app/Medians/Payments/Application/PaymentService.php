<?php

namespace Medians\Payments\Application;
use \Shared\dbaser\CustomController;

use Medians\Plans\Infrastructure\PlanSubscriptionRepository;
use Medians\Payments\Infrastructure\PaymentsRepository;

class PaymentService
{

	
	public $app;
	public $payment_method;
	public $planSubscriptionRepo;
	public $paymentRepo;
	

	function __construct($payment_method)
	{

		$this->app = new \config\APP;

		$this->payment_method = $payment_method;
		
		$this->planSubscriptionRepo = new PlanSubscriptionRepository();
		$this->paymentRepo = new PaymentsRepository();

	}


	public function storePlanSubscription($order, $user)
	{

		$item = $order->purchase_units[0];

		$planSubscription = [];
		$planSubscription['plan_id'] = $item->reference_id;
		$planSubscription['business_id'] = $user->business->business_id;
		$planSubscription['user_id'] = $user->id;
		$planSubscription['start_date'] = date('Y-m-d');
		$planSubscription['end_date'] = $item->custom_id == 'monthly' ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year')) ;

		return $this->planSubscriptionRepo->store($planSubscription);
	}
	
	
	public function storePlanPayment($order, $planSubscription, $user)
	{
		$item = $order->purchase_units[0];

		$payment['payment_code'] = $order->id;
		$payment['business_id'] = $user->business->business_id;
		$payment['amount'] = $item->amount->value;
		$payment['model_id'] = $planSubscription->subscription_id;
		$payment['model_type'] = PlanSubscription::class;
		$payment['date'] = date('Y-m-d');
		$payment['payment_method'] = 'PayPal';
		$payment['created_by'] = $user->id;

		return $this->paymentRepo->store($payment);


	}
	

}
