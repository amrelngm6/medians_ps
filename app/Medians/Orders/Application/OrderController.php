<?php

namespace Medians\Orders\Application;
use \Shared\dbaser\CustomController;

use Medians\Orders\Infrastructure\OrdersRepository;
use Medians\Devices\Application\Device;
use Medians\Prices\Application\Prices;
use Medians\Discounts\Application\Discount;

use Medians\Orders\Domain\Tax;

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;


class OrderController extends CustomController
{


	/**
	* @var Object
	*/
	protected $repo;

	function __construct()
	{
		$this->checkBranch();
		
		$this->repo = new OrdersRepository();
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
            ],
            [
                'key'=> "",
            ],
            [
                'key'=> "subtotal",
                'title'=> __('subtotal'),
                'sortable'=> true,
            ],
            [
                'key'=> "tax",
                'title'=> __('tax'),
                'sortable'=> true,
            ],
            [
                'key'=> "discount",
                'title'=> __('discount'),
                'sortable'=> true,
            ],
            [
                'key'=> "total_cost",
                'title'=> __('total_cost'),
                'sortable'=> true,
            ],
            [
                'key'=> "date",
                'title'=> __('date'),
                'sortable'=> true,
            ],
            [
                'key'=> "user_name",
                'title'=> __('by'),
                'sortable'=> false,
            ],
            [
                'key'=> "status",
                'title'=> __('status'),
                'sortable'=> false,
            ]
        ];
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


    	// $params['start'] = $this->app->request()->get('start') ? date('Y-m-d', strtotime(date($this->app->request()->get('start')))) : date('Y-m-d');
    	// $params['end'] = ($this->app->request()->get('end') && $this->app->request()->get('start')) ? date('Y-m-d', strtotime(date($this->app->request()->get('end')))) : date('Y-m-d');
    	$params['created_by'] = $this->app->request()->get('created_by') ? $this->app->request()->get('created_by') : null;
    	$params['status'] = $this->app->request()->get('status') ? $this->app->request()->get('status') : null;

	    return render('invoices', [
	    	'load_vue'=> true,
	        'columns' => $this->columns(),
	        'title' => __('Orders list'),
	        'items' => $this->repo->getByDate($params)->limit(1000)->get(),
	        'todayOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-d' ), 'end'=>date('Y-m-d', strtotime('+1 day') )])->count(),
	        'lastWeekOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-d',strtotime('-1 week')), 'end'=>date('Y-m-d', strtotime('+1 day'))])->count(),
	        'lastMonthOrders' => $this->repo->getByDate(['status' => $params['status'], 'start'=>date('Y-m-01'), 'end'=>date('Y-m-01', strtotime('+1 month'))])->count(),

	    ]);

	}



	/**
	 * QR-Code of the invoice as Request 
	 * 
	 * @param String $code
	 * 
	 * @return base64(QRCODE) 
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
	 * Admin show invoice page
	 * 
	 * @param String $code
	 */ 
	public function show($code) 
	{	
		$this->app = new \config\APP;
		
		$order = $this->repo->code($code, $this->app->branch->id);

	    return render('invoice', [
	    	'load_vue'=> true,
	        'title' => __('Invoice'),
	        'override_vue', true,
	        'order' => $order,
	    ]);

	}

	/**
	 * Invoice Print custom page
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

	    return render('views/invoice_print.html.twig', [
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







}
