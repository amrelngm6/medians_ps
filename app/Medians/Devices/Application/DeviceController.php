<?php

namespace Medians\Devices\Application;
use \Shared\dbaser\CustomController;

use Medians\Devices\Infrastructure\DevicesRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Products\Infrastructure\ProductsRepository;
use Medians\Games\Infrastructure\GameRepository;

class DeviceController extends CustomController 
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
	

	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new DevicesRepository();

	    // Set Games
	    $this->gamesRepo = new GameRepository();

	    // Set Categories
	    $this->CategoryRepo = new CategoryRepository();

	    // Set Categories
	    $this->productsRepo = new ProductsRepository();
	    
		$this->checkBranch();

	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function ordersColumns( ) 
	{

		return [
            [
                'key'=> "id",
                'title'=> "#",
            ],
            [
                'key'=> "title",
                'title'=> __('title'),
                'sortable'=> true,
            ],
            [
                'key'=> "booking_type",
                'title'=> __('booking_type'),
                'sortable'=> true,
            ],
            [
                'key'=> "start_time",
                'title'=> __('start_time'),
                'sortable'=> true,
                // 'type'=>'number'
            ],
            [
                'key'=> "end_time",
                'title'=> __('end_time'),
                'sortable'=> true,
            ],
            [
                'key'=> "duration_time",
                'title'=> __('duration'),
                'sortable'=> true,
            ],
            [
                'key'=> "order_code",
                'title'=> __('Order'),
                'sortable'=> false,
            ],
            [
                'key'=> "subtotal",
                'title'=> __('Subtotal'),
                'sortable'=> true,
            ],
            [
                'key'=> "products_subtotal",
                'title'=> __('Products'),
                'sortable'=> true,
            ],
            [
                'key'=> "total_cost",
                'title'=> __('Products'),
                'sortable'=> true,
            ],
            [
                'key'=> "status",
                'title'=> __('status'),
                'sortable'=> true,
            ]
        ];
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

		try {
			
			$params = $this->app->request()->query->all();

		    return render('devices_orders', [
		        'load_vue' => true,
		        'title' => __('Devices bookings'),
		        'app' => $this->app,
		        'columns' => $this->ordersColumns(),
		        'items' => $this->query($params),
		    ]);
		} catch (Exception $e) {
			
		}
	}


	public function query($params)
	{
		$params['branch_id'] = $this->app->branch->id;
		return $this->repo->device_orders($params, 1000);
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

	    return render('manage_devices', [
	        'load_vue' => true,
	        'title' => __('Devices list'),
	        'app' => $this->app,
	        'devicesList' => $this->repo->getAll(100),
	        'games' => $this->gamesRepo->get(100),
	        'typesList' => $this->CategoryRepo->categories(get_class($this->repo->getModel())),

	    ]);
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$this->checkFeatureAccess('devices_count', count($this->repo->get()));

		$params = (array) $this->app->request()->get('params');

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

		$params = (array)  $this->app->request()->get('params');

		try {

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

		$params = (array)  json_decode($this->app->request()->get('params'));

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

}
