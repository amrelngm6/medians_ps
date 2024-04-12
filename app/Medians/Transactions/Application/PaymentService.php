<?php

namespace Medians\Transactions\Application;
use \Shared\dbaser\CustomController;

use Medians\Packages\Infrastructure\PackageSubscriptionRepository;
use Medians\Payments\Infrastructure\PaymentsRepository;
use Medians\Transactions\Infrastructure\TransactionRepository;

class PaymentService
{

	
	public $payment_method;
	public $packageSubscriptionRepo;
	public $transactionRepo;
	

	function __construct($payment_method)
	{

		$this->payment_method = $payment_method;
		
	}


	public function storeSubscriptionTransaction($params)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$packageSubscriptionClass = new \Medians\Packages\Domain\PackageSubscription;

			$class = new \Medians\Students\Domain\Student;

			$transaction = (array) $params['transaction'];
			$transaction['model_id'] = $params['model_id'];
			$transaction['model_type'] = $class::class;
			$transaction['item_id'] = $transaction['subscription_id'];
			$transaction['item_type'] = $packageSubscriptionClass::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			return array('success'=>true,  'result'=>__('PAYMENT_MADE_SECCUESS'));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	
	public function storeTripTransaction($params)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$PrivateTrip = new \Medians\Trips\Domain\PrivateTrip;
			$class = new \Medians\Customers\Domain\Parents;

			$transaction = (array) $params['transaction'];
			$transaction['model_id'] = $params['model_id'];
			$transaction['model_type'] = $class::class;
			$transaction['item_id'] = $transaction['item_id'];
			$transaction['item_type'] = $PrivateTrip::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			return array('success'=>true,  'result'=>__('PAYMENT_MADE_SECCUESS'));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	public function updateRouteLocation($params, $class)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$routeLocationClass = new \Medians\Locations\Domain\RouteLocation;
			
			$updateRouteLocationClass = $routeLocationClass->where('model_id', $params['model_id'])->where('model_type', $class::class)->update(['business_id' => $this->transactionRepo->business_id]);

			return array('success'=>true);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	
	public function updateStudentBusiness($params)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$class = new \Medians\Students\Domain\Student;

			$updateStudent = $class->find($params['model_id']);

			$update = $updateStudent->update(['business_id' => $this->transactionRepo->business_id]);

			return $this->updateRouteLocation($params, $class);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	public function updatePackageSubscription($params)
	{
		try {
			
			$this->packageSubscriptionRepo = new PackageSubscriptionRepository($params['business']);
			
			$packageSubscription = $this->packageSubscriptionRepo->update((array) $params['subscription']);

			return array('success'=> true);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	

}
