<?php

namespace Medians\Devices\Application;

use Medians\Devices\Infrastructure\DevicesRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Devices\Domain\Device;

class DeviceController 
{

	/*
	// @var Object
	*/
	protected $repo;

	/*
	// @var Device
	*/
	protected $Device;

	/*
	// @var Array
	*/
	protected $app;
	

	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new DevicesRepository($this->app);

	    // Set Categories
	    $this->CategoryRepo = new CategoryRepository($this->app);

	    // Set Categories
	    $this->productsRepo = new ProductsRepository($this->app);
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
	    return render('views/admin/devices/calendar.html.twig', [
	        'title' => __('Devices list'),
	        'app' => $this->app,
	        'products' => $this->productsRepo->getItems(['status'=>true, 'stock'=>true]),
	        'devicesList' => $this->repo->get(50),
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	    ]);
	}


	/**
	 * Admin index orders
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function orders() 
	{
	    return render('views/admin/devices/orders.html.twig', [
	        'title' => __('Devices bookings'),
	        'app' => $this->app,
	        'events' => $this->repo->events($this->app->request(), 10),
	    ]);
	}


	/**
	 * Admin manage items
	 * 
	 * @param Silex\Application $this->app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function manage( ) 
	{

	    return render('views/admin/devices/devices_manage.html.twig', [
	        'title' => __('Devices list'),
	        'app' => $this->app,
	        'devicesList' => $this->repo->getAll(100),
	        'typesList' => $this->CategoryRepo->categories(Device::class),

	    ]);
	}



	public function show(int $id) 
	{

	    return render('views/admin/devices/device.html.twig', [
	        'title' => __('Edit device'),
	        'typesList' => $this->DeviceTypeController->getAll(),
	        'app' => $this->app,
	        'device' => $this->repo->find($id)
	    ]);
	}



	public function edit(int $id ) 
	{

	    return render('views/admin/forms/edit_device.html.twig', [
	        'title' => __('Edit device'),
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	        'app' => $this->app,
	        'device' => $this->repo->find($id)
	    ]);
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$params = (array) $this->app->request()->get('params')['device'];

		try {

			$params['branch_id'] = $this->app->branch->id;
			$Property = $this->repo->store($params);

        	return array('success'=>1, 'result'=>__('Created'), 'reload'=>2);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  update item
	*/
	public function update() 
	{

		$params = (array)  $this->app->request()->get('params')['device'];

		try {

			$params['branch_id'] = $this->app->branch->id;
			$params['status'] = !empty($params['status']) ? 1 : 0;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>__('Updated'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}


	/** 
	 * Delete item
	 */
	public function delete() 
	{	

		$params = (array)  json_decode($this->app->request()->get('params')['device']);

		try {

			$Property = $this->repo->destroy($params);

        	return array('success'=>1, 'result'=>__('Deleted'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}


	public function validate($params) 
	{

		if (empty($params['title']))
		{
			throw new \Exception(__("Empty title"), 1);
		}

		if (empty($params['type']))
		{
			throw new \Exception(__("Empty type"), 1);
		}

	}


	public function addProduct()
	{

		$product = (array)  json_decode($this->app->request()->get('params')['product']);
		$params = (array)  json_decode($this->app->request()->get('params')['device']);

		try {

			$product['qty'] = 1;
			$save = $this->repo->storeProduct($params['id'], $product);

        	return array('status'=>'success', 'result'=> __('Added').' '. $save->product_name);

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}


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

	public function calendar()
	{
		$repo = new DevicesRepository($this->app);

		$data = $repo->get(100);

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


	public function events()
	{

		$repo = new DevicesRepository($this->app);

		$data = $repo->events($this->app->request(), 100);
		
		$newdata = [];
		foreach ($data as $key => $value) {
			if ((date('Y-m-d H:i', strtotime(date($value->end_time)))) == date('Y-m-d 00:00', strtotime(date($value->end_time))))
			{
				if ($value->end_time == '0000-00-00 00:00:00' || $value->end_time == (date('Y-m-d', strtotime(date($value->end_time))).' 00:00:00') )
				{
					$value->end_time = date('Y-m-d 23:59:00', strtotime(date($value->start_time)));
				}
			}

			$newdata[] = $this->filterItem($value, $repo);

		}

		return response(json_encode($newdata));

	}

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


	public function getMinutes($from, $to)
	{
		return round(abs(strtotime($to) - strtotime($from)) / 60,2);
	}


}
