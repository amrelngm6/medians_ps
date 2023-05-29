<?php

namespace Medians\Payments\Application;
use \Shared\dbaser\CustomController;

use Medians\Users\Application\GetStartedController;

use Medians\Payments\Infrastructure\PaymentsRepository;
use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Plans\Infrastructure\PlanSubscriptionRepository;

class PaymentController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->checkBranch();
		
		$this->repo = new PaymentsRepository();

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
                'key'=> "branch_name",
                'title'=> __('branch_name'),
                'sortable'=> true,
            ],
            [
                'key'=> "amount",
                'title'=> __('amount'),
                'sortable'=> true,
            ],
            [
                'key'=> "payment_method",
                'title'=> __('payment_method'),
                'sortable'=> true,
            ],
            [
                'key'=> "payment_id",
                'title'=> __('payment_id'),
                'sortable'=> false,
            ],
            [
                'key'=> "model_name",
                'title'=> __('item'),
                'sortable'=> false,
            ],
            [
                'key'=> "user_name",
                'title'=> __('by'),
                'sortable'=> true,
            ],
            [
                'key'=> "date",
                'title'=> __('date'),
                'sortable'=> true,
            ]
        ];
	}

	/**
	 * Admin index items
	 * Loads in vue 
	 */ 
	public function index() 
	{
		return render('payments', [
			'load_vue'=> true,
	        'title' => __('Payments list'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
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
        	$params['branch_id'] = $this->app->branch->id;
        	$params['created_by'] = $this->app->auth()->id;
        	
            return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('error'=>__('Err'));


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
           	: array('error'=>__('Not allowed'));


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

           	$returnData =  $this->repo->delete($params['id'])
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return response($returnData);

	}




	/**
	 * Success payment page 
	 */
	public function payment_success()
	{

		return render('views/front/confirmation.html.twig',['title'=> __('Thanks for payment'),'message'=>__('payment made successfully, enjoy with the service')]);

	}

	/**
	 * Failed  payment page 
	 */
	public function payment_failed()
	{
		return render('views/front/confirmation.html.twig',['title'=> __('PAYMENT_CANCELED'),'message'=>__('payment failed, Please try again')]);

	}

	/**
	 * Subscribe to paid plan
	 * 
	 */
	public function confirmPlanPayment()
	{
		try {
			

			if (!$this->app->request()->get('paymentId'))
				return $this->app->redirect('payment_failed');
			
			$payment = new PaymentService;

			$paymentType = $_SESSION['payment_plan_type']; 
			$plan = $this->planRepo->find($_SESSION['payment_plan_id']);

			$price = number_format($paymentType == 'monthly' ? $plan->monthly_cost : $plan->yearly_cost, 2);

			$payment->title = __('Plan subscription');
			$payment->item_name = $plan->name;
			$payment->item_price = $price;
			$payment->currency = 'USD';
			$payment->sku = 'Plan-'. $plan->id;
			$payment->subtotal = $price;
			$payment->totalcost = $price;

			$excutePayment = $payment->confirmPlanPayment($this->app->request()->get('paymentId'), $this->app->request()->get('PayerID'));

			if (empty($excutePayment->id) || $excutePayment->state != 'approved')
				return $this->app->redirect('payment_failed');

			$GetStartedController = new GetStartedController;
			$savePlan = $GetStartedController->savePlan($plan, $paymentType);
			if (empty($savePlan))
				return $this->app->redirect('payment_failed');

			$params = [];


			$params['amount'] = $excutePayment->transactions[0]->amount->total;
			$params['payment_id'] = $excutePayment->id;
			$params['payment_method'] = 'PayPal';
			$params['created_by'] = $this->app->auth()->id;
			$params['branch_id'] = $this->app->branch->id;
			$params['model_id'] = $savePlan->id;
			$params['model_type'] = get_class((new PlanSubscriptionRepository)->getModel());
			$params['date'] = date('Y-m-d');
	       	$savePayment =  $this->repo->store($params);

	       	if (isset($savePayment->id))
				return $this->app->redirect('payment_success');

		} catch (Exception $e) {
			return $this->app->redirect('payment_failed');
		}
	}  

}
