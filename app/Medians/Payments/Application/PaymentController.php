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
	protected $app;
	protected $planRepo;



	function __construct()
	{
        $this->app = new \config\APP;
		
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
            [ 'value'=> "payment_id", 'text'=> "#"],
            [ 'value'=> "payment_code", 'text'=> __('Payment code'), 'sortable'=> true ],
            [ 'value'=> "payment_method", 'text'=> __('Payment method'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> __('Date'), 'sortable'=> true ],
            [ 'value'=> "plan_subscription.plan.name", 'text'=> __('Plan'), 'sortable'=> false ],
			['value'=>'delete', 'text'=>__('Delete')],
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


	public function confirmPayPalPlanPayment()
	{
		$user = $this->app->auth();
		
		$params = $this->app->request()->get('params');

		$order = json_decode($params['order']);
		
		if ($order->status == 'COMPLETED')
		{
			
			try {
				
				$paymentService = new PaymentService('PayPal');

				$savedSubscription = $paymentService->storePlanSubscription($params, $order, $user); 

				$savePlanPayment = $paymentService->storePlanPayment($order, $savedSubscription, $user); 

				$addInvoice = $paymentService->addInvoice($params, $order, $savedSubscription, $user); 
	
				return (isset($savePlanPayment->payment_id))
				? array('success'=>1, 'result'=>__('PAYMENT_MADE_SECCUESS'), 'reload'=>1)
				: array('error'=>__('Not allowed'));
 
	
			} catch (Exception $e) {
				return array('error'=>$e->getMessage());
			}
			
		}
		
		
		return array('error'=>__('Error'));
		
	}


}
