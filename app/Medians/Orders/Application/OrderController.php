<?php

namespace Medians\Orders\Application;

use Medians\Orders\Infrastructure\OrdersRepository;
use Medians\Devices\Application\Device;
use Medians\Calculator\Application\Calculator;
use Medians\Prices\Application\Prices;
use Medians\Discounts\Application\Discount;

use Medians\Orders\Domain\Tax;



use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;


class OrderController
{


	/**
	* @var Object
	*/
	protected $repo;

	function __construct()
	{
		$this->repo = new OrdersRepository();
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
		$this->app = new \config\APP;


    	$params['start'] = $this->app->request()->get('start') ? date('Y-m-d', strtotime(date($this->app->request()->get('start')))) : date('Y-m-d');
    	$params['end'] = ($this->app->request()->get('end') && $this->app->request()->get('start')) ? date('Y-m-d', strtotime(date($this->app->request()->get('end')))) : date('Y-m-d');
    	$params['created_by'] = $this->app->request()->get('created_by') ? $this->app->request()->get('created_by') : null;
    	$params['status'] = $this->app->request()->get('status') ? $this->app->request()->get('status') : null;

	    return render('views/admin/orders/orders.html.twig', [
	        'title' => __('Orders list'),
	        'orders' => $this->repo->getByDate($params)->get(),
	        'todayOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-d' ), 'end'=>date('Y-m-d', strtotime('+1 day') )])->count(),
	        'lastWeekOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-d',strtotime('-1 week')), 'end'=>date('Y-m-d', strtotime('+1 day'))])->count(),
	        'lastMonthOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-01'), 'end'=>date('Y-m-01', strtotime('+1 month'))])->count(),

	    ]);

	}



	/**
	 * Admin index items
	 * 
	 * @param String $code
	 * 
	 */ 
	public function qr_code($code) 
	{	
		$this->app = new \config\APP;
		
		$order = $this->repo->codeOnly($code);

		$options = new QROptions([
			'version'             => 7,
			'scale'               => 20,
			'imageBase64'         => false,
			'bgColor'             => [200, 150, 200],
			'imageTransparent'    => true,
			'drawCircularModules' => true,
			'drawLightModules'    => true,
			'circleRadius'        => 0.4,
		]);


		try{
			echo (new QRCode($options))->render($this->app->CONF['url'].'invoices/print/'.$order->code);
		} catch (Throwable $e){
			exit($e->getMessage());
		}

	    return true;
	}


	/**
	 * Admin show item
	 * 
	 * @param String $code
	 */ 
	public function show($code) 
	{	
		$this->app = new \config\APP;
		
		$order = $this->repo->code($code, $this->app->branch->id);

	    return render('views/admin/orders/order.html.twig', [
	        'title' => __('Invoice'),
	        'override_vue', true,
	        'order' => $order,
	    ]);

	}

	/**
	 * Invoice Print 
	 * 
	 * @param String $code
	 */ 
	public function print($code) 
	{	


		$this->app = new \config\APP;
		
		$order = $this->repo->codeOnly($code);

		$order->branch->settings = array_column($order->branch->with('settings')->first()->settings->toArray(), 'value', 'code');

		if (empty($order->id))
			return null;

	    return render('views/admin/orders/print.html.twig', [
	        'title' => __('Invoice'),
	        'order' => $order,
	        'override_vue' => true,
	    ]);

	}


	/**
	 * Calc tax
	 */
	public function calculateTax($amount)
	{
		return new Tax($this->app->setting('tax'), $amount);

	}  

	/**
	* Genrate unique code 
	*/
	public function genrateCode($branchId) : String
	{
		return $this->repo->generateCode($branchId);
	}


	public function checkout() 
	{

		$this->app = new \config\APP;

		$request = $this->app->request()->get('params');

		$params = (array) json_decode($request['cart']);


		try {

			$data = [];
			$data['branch_id'] = $this->app->branch->id;
			$data['customer_id'] = isset($params[0]->customer->id) ? $params[0]->customer->id : '0';
			$data['tax'] = round((float) str_replace('"', '', $request['tax']), 2); 
			$data['discount'] = round((float) str_replace('"', '', $request['discount']), 2); 
			$data['discount_code'] = '';
			$data['code'] = $this->genrateCode($this->app->branch->id);
			$data['subtotal'] = round((float) str_replace('"', '', $request['subtotal']), 2); 
			$data['total_cost'] = round((float) str_replace('"', '', $request['total_cost']), 2); 
			$data['date'] = date('Y-m-d');
			$data['created_by'] = $this->app->auth()->id;
			$data['status'] = 'paid';
			$data['payment_method'] = $request['payment_method'];

			$save = $this->repo->store($data, $params);

        	return isset($save->id) ? response(__('Order Created')) : 'Not found' ;

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}



	public function calculate($cost, $startTime, $endTime) 
	{

		$interval = date_diff(new \DateTime($startTime) , new \DateTime($endTime));

		return (new Calculator
			( 	
				$cost, 
				$interval->format('%h'), 
				$interval->format('%i')
			)
		)->getCost(0);

	}	


	public function getSubTotal($params)  
	{
		$cost = 0;
		if (!empty($params))
		{
			foreach ($params as $key => $value) 
			{
				$cost = round(((float) $value->subtotal) + ((float) $cost), 2);

				if (!empty($value->products))
				{
					foreach ($value->products as $product) 
					{
						$cost = round(((float) $product->subtotal) + ((float) $cost), 2);
					}		
				}
			}
		}


		return $cost;
	}

	public function calculateCost($item)  
	{
		return $this->calculate($item->subtotal, $item->start_time, $item->end_time );
	}
	

	public function calculateTime($time1, $time2) 
	{

		$start_date = new \DateTime($time1);

		return array_map(function($a){
			return ($a > 9) ? $a : '0'.$a;
		}, (array) $start_date->diff(new \DateTime($time2)));
	}


	public function checkDiscountUsed($discountCode) 
	{
		return $this->repo->getByDiscountCode($discountCode);
	}


	public function handleOrderDiscount($discountCode) : OrderModel
	{
		
		$this->discountCodeObject = (new Discount())->validateCodeWithOrder($discountCode, $this->OrderModel);

		if (count($this->checkDiscountUsed($this->discountCodeObject->code())) >= $this->discountCodeObject->useCount())
		{
			throw new \Exception(__("Error: This code usage limit has exceeded"), 1);
		}

        $this->OrderModel->setDiscountCode($this->discountCodeObject->code());

        $this->OrderModel->setTotalCost($this->costWithDiscount($this->OrderModel));

        $this->editItem();


        return $this->OrderModel;

	}











	/*
	// Calculate Discount
	*/
	public function costWithDiscount(OrderModel $OrderModel) : ?Float
	{
		return ( new Discount)->costWithDiscount($OrderModel);
	}


	/*
	// Count methods
	*/
	public function getCostByMonth($branchId, $month = null)
	{

		$month = empty($month) ? date('Y-m') : $month;
		$nextmonth = date('Y-m', strtotime('+1 month', strtotime($month))) ;

		return $this->repo->getCostByMonth($branchId, $month, $nextmonth);

	} 





}
