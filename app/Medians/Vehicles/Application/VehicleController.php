<?php
namespace Medians\Vehicles\Application;

use Shared\dbaser\CustomController;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Vehicles\Infrastructure\VehicleTypeRepository;
use Medians\Routes\Infrastructure\RouteRepository;

class VehicleController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $vehicleTypeRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new VehicleRepository($this->app->auth()->business);
		$this->vehicleTypeRepo = new VehicleTypeRepository($this->app->auth()->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "vehicle_id", 'text'=> "#"],
            [ 'value'=> "vehicle_name", 'text'=> __('vehicle_name'), 'sortable'=> true ],
            [ 'value'=> "plate_number", 'text'=> __('plate_number'), 'sortable'=> true ],
            [ 'value'=> "type.name", 'text'=> __('Type')],
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
			[ 'key'=> "type_id", 'title'=> __('Vehicle type'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'type_id', 'text_key'=>'name', 'withLabel'=>true,
				'data' => $this->vehicleTypeRepo->get()
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

		$params = $this->app->request()->get('params');

        try {	

			try {

				$params['business_id'] = $this->app->auth()->business->business_id;

				$this->validate($params);

			} catch (\Throwable $e) {
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
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

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

		$params = $this->app->request()->get('params');

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