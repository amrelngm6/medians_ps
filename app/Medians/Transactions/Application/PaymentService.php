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


	public function storeTransaction($params)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$studentClass = new \Medians\Students\Domain\Student;
			
			$packageSubscriptionClass = new \Medians\Packages\Domain\PackageSubscription;

			$transaction = (array) $params['transaction'];
			$transaction['model_id'] = $params['student_id'];
			$transaction['model_type'] = $studentClass::class;
			$transaction['item_id'] = $transaction['subscription_id'];
			$transaction['item_type'] = $packageSubscriptionClass::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			$updateStudent = $studentClass->find($params['student_id'])->update('business_id', $transactionStored->business_id);

			return array('success'=>true,  'result'=>__('PAYMENT_MADE_SECCUESS'));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	public function updatePackageSubscription($params)
	{
		try {
			
			$this->packageSubscriptionRepo = new PackageSubscriptionRepository($params['business']);
			
			// Update subscription status
			$packageSubscription = $this->packageSubscriptionRepo->update((array) $params['subscription']);

			return $packageSubscription;

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	

}
