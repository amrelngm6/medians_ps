<?php

namespace Medians\Payments\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Application\SystemSettingsController;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

class PaymentService
{


	public $title;
	public $item_name;
	public $item_price;
	public $currency;
	public $sku;
	public $subtotal;
	public $totalcost;


	function __construct()
	{

		$this->app = new \config\APP;

		$setting = (new SystemSettingsController)->getAll();


		// After Step 1
		$this->apiContext = new ApiContext(
		        new \PayPal\Auth\OAuthTokenCredential(
		            $setting['paypal_api_key'],
		            $setting['paypal_api_secret']
		        )
		);

	    $this->apiContext->setConfig(
	        array(
	            'mode' => strtolower($setting['paypal_mode']),
	            'log.LogEnabled' => true,
	            'log.FileName' => '/PayPal.log',
	            'log.LogLevel' => 'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
	            'cache.enabled' => true,
	        )
	    );

	}


	public function getPaymentUrl()
	{


		
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item1 = new Item();
		$item1->setName($this->item_name)
		    ->setCurrency($this->currency)
		    ->setQuantity(1)
		    ->setSku("123123") // Similar to `item_number` in Classic API
		    ->setPrice($this->item_price);

		$itemList = new ItemList();
		$itemList->setItems(array($item1));

		$details = new Details();
		$details->setShipping(0)
		    ->setTax(0)
		    ->setSubtotal($this->subtotal);

		$amount = new Amount();
		$amount->setCurrency($this->currency)
		    ->setTotal($this->totalcost)
		    ->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription($this->title)
		    ->setInvoiceNumber(uniqid());

		$baseUrl = $this->app->CONF['url'];
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("{$baseUrl}plan_payment?success=true")
		    ->setCancelUrl("{$baseUrl}plan_payment?success=false");

		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		$request = clone $payment;

		try {
		    $payment->create($this->apiContext);
		} catch (Exception $ex) {
		    exit(1);
		}

		$approvalUrl = $payment->getApprovalLink();

		return $approvalUrl;

	}


	public function confirmPlanPayment($paymentId, $PayerId)
	{

		$this->app = new \config\APP;

	    $payment = Payment::get($paymentId, $this->apiContext);


	    $execution = new PaymentExecution();
	    $execution->setPayerId($PayerId);


	    $transaction = new Transaction();
	    $amount = new Amount();
	    $details = new Details();

	    $details->setShipping(0)
		    ->setTax(0)
		    ->setSubtotal($this->subtotal);

	    $amount->setCurrency($this->currency);
	    $amount->setTotal($this->totalcost);
	    $amount->setDetails($details);
	    $transaction->setAmount($amount);

	    $execution->addTransaction($transaction);

	    try {

	        $result = $payment->execute($execution, $this->apiContext);
	        try {
        	    $payment = Payment::get($paymentId, $this->apiContext);
	        } catch (Exception $ex) {
	        	exit(1);
	        }
	    } catch (Exception $ex) {
	    	exit(1);
    	}

		return json_decode($payment);

	}


}
