<?php

namespace Medians\Transactions\Application;
use \Shared\dbaser\CustomController;

use Medians\Packages\Infrastructure\PackageSubscriptionRepository;
use Medians\Payments\Infrastructure\PaymentRepository;
use Medians\Transactions\Infrastructure\TransactionRepository;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Customer;

class PaymentService
{

	
	public $payment_method;
	public $packageSubscriptionRepo;
	public $transactionRepo;
	

	function __construct($payment_method)
	{

		$this->payment_method = $payment_method;
		
	}


	public function storeSubscriptionTransaction($params, $invoice, $user)
	{
		try {

			$this->transactionRepo = new TransactionRepository();

			$packageSubscriptionClass = new \Medians\Packages\Domain\PackageSubscription;

			$transaction = (array) $params['transaction'];
			$transaction['invoice_id'] = $invoice->invoice_id;
			$transaction['model_id'] = $invoice->user_id;
			$transaction['model_type'] = $invoice->user_type;
			$transaction['item_id'] = $transaction['subscription_id'];
			$transaction['item_type'] = $packageSubscriptionClass::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			return $transactionStored;

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}


	
	public function storeTripTransaction($params, $invoice)
	{
		try {

			$this->transactionRepo = new TransactionRepository();

			$TaxiTrip = new \Medians\Trips\Domain\TaxiTrip;

			$transaction = (array) $params['transaction'];
			$transaction['invoice_id'] = $invoice->invoice_id;
			$transaction['model_id'] = $invoice->user_id;
			$transaction['model_type'] = $invoice->user_type;
			$transaction['item_id'] = $transaction['item_id'];
			$transaction['item_type'] = $TaxiTrip::class;
			$transaction['date'] = date('Y-m-d');
			
			$transactionStored = $this->transactionRepo->store($transaction);
			
			return array('success'=>true,  'result'=>translate('PAYMENT_MADE_SECCUESS'));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}



	public function updatePackageSubscription($params)
	{
		try {
			
			$this->packageSubscriptionRepo = new PackageSubscriptionRepository();
			
			$packageSubscription = $this->packageSubscriptionRepo->update((array) $params['subscription']);

			return array('success'=> true);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	

	public function updateTrip($params, $invoice)
	{
		try {
			
			$taxiTripRepo = new \Medians\Trips\Infrastructure\TaxiTripRepository();
			
			$tripData = (array) $params['trip'];
			$check = $taxiTripRepo->find($tripData['trip_id']);
			$trip = $taxiTripRepo->update($tripData);

			$updateDriverCommission = $this->updateDriverWalletCredit($params, $invoice, $tripData['driver_id']);

			return array('success'=> true);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	public function addInvoice($params)
	{
		try {
			
			$invoiceRepo = new \Medians\Invoices\Infrastructure\InvoiceRepository();
			
			$invoiceInfo = (array) $params['invoice'];

			$data = array();
			$data['code'] = $invoiceRepo->generateCode();
			$data['user_id'] = $params['user_id'];
			$data['user_type'] = Customer::class;
			$data['payment_method'] = $invoiceInfo['payment_method'];
			$data['subtotal'] = $invoiceInfo['subtotal'];
			$data['discount_amount'] = 0;
			$data['total_amount'] = $invoiceInfo['total_amount'];
			$data['date'] = date('Y-m-d');
			$data['status'] = $invoiceInfo['status'];
			$data['notes'] = $invoiceInfo['notes'];
			$data['items'] = (array) $invoiceInfo['items'];

			return $invoiceRepo->store($data);

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	
	
	public function updateWallet($params, $invoice)
	{
		try {

			if ($params['payment_method'] == 'cash')
			{
				return $this->updateDriverWalletDebit($params, $invoice);
			}

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
		
	}
	
	
	/**
	 * Update driver wallet when the payment in Cash only
	 * Increase the Debit balance
	 */
	public function updateDriverWalletDebit($params, $invoice)
	{
		try {

			$app = new \config\APP;
			$user = $app->auth();
			if ($params['payment_method'] != 'cash')
			{
				return;
			}

			$walletRepo = new \Medians\Wallets\Infrastructure\WalletRepository();
			
			$check = $walletRepo->driverWallet($user->driver_id);
			$data = array();
			$data['debit_balance'] = isset($check->debit_balance) ? ($check->debit_balance + $invoice->total_amount) : $invoice->total_amount;

			return isset($check->wallet_id) ? $check->update($data) : null;

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
		
	}
	
	
	/**
	 * Update driver wallet when the payment in Cash only
	 * Increase the Debit balance
	 */
	public function updateDriverWalletCredit($params, $invoice, $driverIid)
	{
		try {

			$app = new \config\APP;

			$walletRepo = new \Medians\Wallets\Infrastructure\WalletRepository();
			
			$check = $walletRepo->driverWallet($driverIid);
			$data = array();
			$commission = $this->handleDriverCommission($invoice);
			$data['credit_balance'] = isset($check->credit_balance) ? ($check->credit_balance + $commission) : $commission;

			return isset($check->wallet_id) ? $check->update($data) : null;

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	public function handleDriverCommission($invoice) 
	{
		// return isset($setting['driver_commission']) 
		// ? ($invoice->total_amount * ($setting['driver_commission'] / 100))
		// : 0;

	}

}
