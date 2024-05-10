<?php
namespace Medians\Vehicles\Application;

use Shared\dbaser\CustomController;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class VehicleController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	public $routeRepo;
	public $driverRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new VehicleRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->routeRepo = new RouteRepository();
		$this->driverRepo = new DriverRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "vehicle_id", 'text'=> "#"],
            [ 'value'=> "route.route_name", 'text'=> __('Route')],
            [ 'value'=> "vehicle_name", 'text'=> __('vehicle_name'), 'sortable'=> true ],
            [ 'value'=> "plate_number", 'text'=> __('plate_number'), 'sortable'=> true ],
            [ 'value'=> "maintenance_status", 'text'=> __('maintenance_status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('edit')  ],
            [ 'value'=> "delete", 'text'=> __('delete')  ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "vehicle_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "vehicle_name", 'title'=> __('vehicle_name'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "maintenance_status", 'title'=> __('maintenance_status'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "route_id", 'title'=> __('Route'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'route_name', 
				'data' => $this->routeRepo->get()
			],
            [ 'key'=> "driver_id", 'title'=> __('Driver'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 
				'data' => $this->driverRepo->get()
			],
            [ 'key'=> "plate_number", 'title'=> __('plate_number'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "capacity", 'title'=> __('capacity'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'number' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=> true, 'column_type'=>'file' ],

        ];
	}

	

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( ) 
	{
		
		try {
			
		    return render('vehicles', [
		        'load_vue' => true,
		        'title' => __('Vehicles'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'types' => ['car', 'bus'],
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function validate($params) 
	{

		if (empty($params['vehicle_name']))
		{
			throw new \Exception(__('NAME_EMPTY'), 0);
		}

	}



	public function store() 
	{

		$params = $this->app->params();

        try {	

			try {
				
				$this->validate($params);

			} catch (\Exception $e) {
	        	return array('result'=>$e->getMessage(), 'error'=>1);
			}

			$params['created_by'] = $this->app->auth()->id;
        	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (\Exception $es) {
        	return array('result'=>$es->getMessage(), 'error'=>1);
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->params();

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function updateLocation($params)
	{

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'p'=>$params, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['vehicle_id']);


            if ($this->repo->delete($params['vehicle_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            
        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	

	public function getVehicle($vehicle_id)
	{

		$auth = $this->app->auth();

        try {

			if (!empty($auth))
			{
				$check = $this->repo->find($vehicle_id);
				echo json_encode($check);
			}

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}
	
	
}