<?php

namespace Medians\Users\Application;


class GetStartedController 
{


	/*
	/ @var new CustomerRepository
	*/
	protected $app;

	public $planRepo;
	
	public $planSubscriptionRepo;

	function __construct()
	{
		$this->app = new \config\APP;		
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
	        'title' => translate('Get_started'),
	    ]);
		return render('views/admin/get-started.html.twig',['user'=>$this->app->auth()]);

	}


	/**
	*  Store setting for new user
	*/
	public function store_setting() 
	{

	}


	/**
	*  Store business for new user
	*/
	public function saveBusiness() 
	{
		$params = (array)  $this->app->params();

		try {

			$params['status'] = 'on';
			$params['user_id'] = $this->app->auth()->id;
			$save = $this->businessRepo->store($params);

			if (isset($save->business_id))
				$this->saveActiveBusiness($save);

        	return isset($save->business_id) 
           	? array('success'=>1, 'result'=> $save, 'reload'=>1)
        	: array('error'=> $save );

        } catch (Exception $e) {
        	return array('error'=> $e->getMessage() );
        }
	}


	/**
	 * Save the created business 
	 * for the active session
	 * 
	 */ 
	public function saveActiveBusiness($business)
	{

		$user = $this->app->auth();

		$user->update(['active_business'=>$business->business_id]);

		$addDefaultSetting = $this->store_setting($business);

		return $this;
	} 



	/**
	 * Save the created business 
	 * for the active session
	 * 
	 */ 
	public function saveSelectedPlan()
	{

		try {

			$user = $this->app->auth();

			$params = $this->app->params();
			$plan = $this->planRepo->find($params['plan_id']);

			// Check if plan is exist
			if (empty($plan))
				return null;


			// Check if plan is premium 
			if ($plan->type == 'paid')
				return $this->subscribePaidPlan($plan, $params['payment_type']);

			$save = $this->savePlan($plan, $params['payment_type']);

        	return isset($save->plan_id) 
           	? array('success'=>1, 'result'=>translate('Created'))
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	} 

	/**
	 * Subscribe to paid plan
	 * 
	 */
	public function saveFreePlan()
	{
		try {

			$params = $this->app->params();
			$user = $this->app->auth();

			// Store new subscription 
			$planSubscription = [];
			$planSubscription['plan_id'] = $params['plan_id'];
			$planSubscription['business_id'] = $user->business->business_id;
			$planSubscription['payment_type'] = $params['payment_type'];
			$planSubscription['user_id'] = $user->id;
			$planSubscription['start_date'] = date('Y-m-d');
			$planSubscription['end_date'] = date('Y-m-d', strtotime('+1 '.($params['payment_type'] == 'monthly' ? 'month' : 'year'))) ;
	
			$save = $this->planSubscriptionRepo->store($planSubscription);

			return isset($save->plan_id) 
			? array('success'=>1, 'result'=>translate('Subscribed successfully'))
			: array('error'=> $save );

		} catch (Exception $e) {
			return  $e->getMessage();
		}
	} 

	/**
	 * Subscribe to paid plan
	 * 
	 */
	public function subscribePaidPlan($plan, $paymentType='monthly')
	{

	
	} 

	public function validatePagaditoPaymentWebhook()
	{
		error_log('webhook');
		
		$app = new \config\APP;
		$setting = $app->SystemSetting();

		// Pagadito sandbox credentials
		$merchant_id = $setting['pagadito_uid'];
		$api_key = $setting['pagadito_wsk'];
		
		// Transaction details (typically, you'd get these from a POST request)
		$payload = file_get_contents('php://input');
		// $data = json_decode($payload, true);
		$token = $_GET['token'];
		error_log($payload);
		
		try {
			
			// Decode JSON response
			$pagadito = new Pagadito($setting['pagadito_uid'], $setting['pagadito_wsk']);
			$pagadito->mode_sandbox_on();
			
			try {
				// Connect to Pagadito
				if ($pagadito->connect()) {
					// Create transaction
					if ($response = $pagadito->get_status($token)) {
						$status = $pagadito->get_rs_status();
						$response_data = [
							'url' => $status,
						];
					} else {
						$response_data = [
							'error' => 'Transaction execution failed: ' . $pagadito->get_rs_code() . ' - ' . $pagadito->get_rs_message(),
						];
					}
				} else {
					$response_data = [
						'error' => 'Connection failed: ' . $pagadito->get_rs_code() . ' - ' . $pagadito->get_rs_message(),
					];
				}
			} catch (Exception $e) {
				$response_data = [
					'error' => 'Exception: ' . $e->getMessage(),
				];
			}

			// Return response as JSON
			// header('Content-Type: application/json');
			error_log(json_encode($response_data));
			return response(json_encode($response_data));

		} catch (\Throwable $th) {
			error_log($th->getMessage());
			echo json_encode(['error' => $th->getMessage()]);
		}
	}
	
	public function initiatePagaditoPayment()
	{
		$app = new \config\APP;
		$setting = $app->SystemSetting();

		// Pagadito sandbox credentials
		$merchant_id = $setting['pagadito_uid'];
		$api_key = $setting['pagadito_wsk'];

		// Transaction details (typically, you'd get these from a POST request)
		$params = $app->params();
		$amount = $params['amount'];
		$currency = $params['currency'];
		$description = $params['description'];
		$url_ok = $params['url_ok'];
		$url_cancel = $params['url_cancel'];

		try {
			
			// Decode JSON response
			$pagadito = new Pagadito($setting['pagadito_uid'], $setting['pagadito_wsk']);
			$pagadito->mode_sandbox_on();
			
			try {
				// Connect to Pagadito
				if ($pagadito->connect()) {
					// Create transaction

					$pagadito->add_detail(1, $description, $amount);
					
					if ($response = $pagadito->exec_trans($amount, $description, $currency, $url_ok, $url_cancel)) {
						$response_data = [
							'url' => $response,
						];
					} else {
						$response_data = [
							'error' => 'Transaction execution failed: ' . $pagadito->get_rs_code() . ' - ' . $pagadito->get_rs_message(),
						];
					}
				} else {
					$response_data = [
						'error' => 'Connection failed: ' . $pagadito->get_rs_code() . ' - ' . $pagadito->get_rs_message(),
					];
				}
			} catch (Exception $e) {
				$response_data = [
					'error' => 'Exception: ' . $e->getMessage(),
				];
			}

			// Return response as JSON
			echo json_encode($response_data);

			return;

		} catch (\Throwable $th) {
			error_log($th->getMessage());
			echo json_encode(['error' => $th->getMessage()]);
		}
	}

}
