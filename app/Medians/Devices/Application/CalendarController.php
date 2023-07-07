<?php

namespace Medians\Devices\Application;

use \Shared\dbaser\CustomController;

use Medians\Devices\Infrastructure\DevicesRepository;
use Medians\Products\Infrastructure\ProductsRepository;
use Medians\Categories\Infrastructure\CategoryRepository;


class CalendarController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	/**
	* @var Device
	*/
	protected $Device;

	/**
	* @var Array
	*/
	protected $app;
	
	public $productsRepo;
	
	public $CategoryRepo;

	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new DevicesRepository();

	    // Set Categories
	    $this->CategoryRepo = new CategoryRepository();

	    // Set Categories
	    $this->productsRepo = new ProductsRepository();
		
		$this->checkBranch();

	}



	/**
	 * Calendar index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
	    return render('calendar', [
	        'load_vue' => true,
	        'title' => __('Devices list'),
	        'app' => $this->app,
	        'products' => $this->productsRepo->getItems(['status'=>true, 'stock'=>true]),
	        'devicesList' => $this->repo->get(50),
	        'typesList' => $this->CategoryRepo->categories(get_class($this->repo->getModel())),
	    ]);
	}



	/**
	 * Calendar basic data
	 * for handling the view
	 * 
	 */ 
	public function calendar()
	{

		$data = $this->repo->get(100);

		foreach ($data as $key => $value) {
			$data[$key]->businessHours = [(object) [
				'days'=>[0],
				'daysOfWeek' => [0, 1, 2, 3, 4, 5, 6],
				'disabledDates' => [],
				'startTime' => "00:000",
				'endTime' => "06:00",
				'status' => true
			], (object) [
				'days'=>[0],
				'daysOfWeek' => [0, 1, 2, 3, 4, 5, 6],
				'disabledDates' => [],
				'startTime' => "13:000",
				'endTime' => "23:59",
				'status' => true
			
			]];

		}

		return response(json_encode(['data'=>$data, 'status'=>TRUE]));
	}


	/**
	 * Load events for Calendar
	 * 
	 */ 
	public function events()
	{
		$params = $this->app->request()->query->all();

		$data = $this->repo->events($params, 100);
		
		$newdata = [];
		foreach ($data as $key => $value) {
			if ((date('Y-m-d H:i', strtotime(date($value->end_time)))) == date('Y-m-d 00:00', strtotime(date($value->end_time))))
			{
				if ($value->end_time == '0000-00-00 00:00:00' || $value->end_time == (date('Y-m-d', strtotime(date($value->end_time))).' 00:00:00') )
				{
					$value->end_time = date('Y-m-d 23:59:00', strtotime(date($value->start_time)));
				}
			}

			$newdata[] = $this->filterItem($value, $this->repo);

		}

		return response(json_encode($newdata));

	}


	/**
	 * Filter items for calendar view
	 * 
	 */ 
	public function filterItem($event, $repo)
	{

		$event->id = $event->id;
		$event->duration_minutes = $event->duration;
		$event->title = isset($event->game->name) ? $event->game->name : $event->device->name;
		$event->resourceId = $event->device_id;
		$event->start = $event->start_time;
		$event->from = $event->start_time;
		$event->start_time = date('H:i', strtotime(date($event->start_time)));
		$event->end = $event->end_time;
		$event->to = $event->end_time;
		$event->end_time = date('H:i', strtotime(date($event->end)));
		$event->date = date('Y-m-d', strtotime(date($event->from)));
		$event->backgroundColor = '#f56954';
		$event->borderColor = '#000';
		$event->display = isset($event->display )? $event->display : 'block';
		$event->draggable = true;
		$event->allow = true;
		$event->url = 'javascript:;';
		$event->classNames = $event->status.' ';
		$event->classNames .= $event->order_code ? 'bg-orange-500' : 'bg-gradient-purple';
		$event->classes = $event->classNames;
		$event->games = $repo->getGames($event->device->type);

		return $event;
	}



	/** 
	 * Add product to active booking
	 * 
	 */ 
	public function addProduct()
	{

		$product = (array)  json_decode($this->app->request()->get('params')['product']);
		$params = (array)  json_decode($this->app->request()->get('params')['booking']);

		try {

			$product['qty'] = 1;
			$save = $this->repo->storeProduct($params['id'], $product);

        	return array('status'=>'success', 'result'=> __('Added').' '. $save->product_name);

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}

	/**
	 * Remove product from booking
	 * 
	 */ 
	public function removeProduct()
	{

		$params = (array)  json_decode($this->app->request()->get('params')['product']);

		try {

			$save = $this->repo->removeProduct($params['id']);

        	return array('status'=>'success', 'result'=> $save);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}


}
