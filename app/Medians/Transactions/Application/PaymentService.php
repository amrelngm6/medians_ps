<?php

namespace Medians\Transactions\Application;
use \Shared\dbaser\CustomController;

use Medians\Packages\Infrastructure\PackageSubscriptionRepository;
use Medians\Payments\Infrastructure\PaymentsRepository;
use Medians\Transactions\Infrastructure\TransactionRepository;
use Medians\Students\Domain\Student;

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

			$class = new Student;

			$invoice = $this->addInvoice($params);

			$transaction = (array) $params['transaction'];
			$transaction['model_id'] = $params['model_id'];
			$transaction['invoice_id'] = $invoice->invoice_id;
			$transaction['model_type'] = $class::class;
			$transaction['item_id'] = $transaction['subscription_id'];
			$transaction['item_type'] = $packageSubscriptionClass::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			return $transactionStored;

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


	public function updateRouteLocation($params)
	{
		try {

			$class = new Student;

			$routeLocationClass = new \Medians\Locations\Domain\RouteLocation;
			
			$updateRouteLocationClass = $routeLocationClass->where('model_id', $params['model_id'])->where('model_type', $class::class)->update(['business_id' => $params['business']->business_id]);

			return array('success'=>$updateRouteLocationClass);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	
	public function updateStudentBusiness($params)
	{
		try {

			$this->transactionRepo = new TransactionRepository($params['business']);

			$class = new Student;

			$updateStudent = $class->find($params['model_id']);

			$update = $updateStudent->update(['business_id' => $this->transactionRepo->business_id]);

			return true;

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
	
	

	public function updateTrip($params)
	{
		try {
			
			$privateTripRepo = new \Medians\Trips\Infrastructure\PrivateTripRepository($params['business']);
			
			$trip = $privateTripRepo->update((array) $params['trip']);

			return array('success'=> true);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	public function addInvoice($params)
	{
		try {
			
			$invoiceRepo = new \Medians\Invoices\Infrastructure\InvoiceRepository($params['business']);
			
			$invoiceInfo = (array) $params['invoice'];

			$data = array();
			$data['business_id'] = $params['business']->business_id;
			$data['code'] = $invoiceRepo->generateCode();
			$data['user_id'] = $invoiceInfo['model_id'];
			$data['user_type'] = Student::class;
			$data['payment_method'] = $invoiceInfo['payment_method'];
			$data['subtotal'] = $invoiceInfo['subtotal'];
			$data['discount_amount'] = 0;
			$data['total_amount'] = $invoiceInfo['total_amount'];
			$data['date'] = date('Y-m-d');
			$data['status'] = $invoiceInfo['status'];
			$data['notes'] = $invoiceInfo['notes'];
			$data['items'] = (array) $invoiceInfo['items'];

			return $invoiceRepo->store((array) $data);

			// return array('success'=>true,  'result'=>__('PAYMENT_MADE_SECCUESS'));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	

}
