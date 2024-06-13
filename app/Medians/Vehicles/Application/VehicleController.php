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

		$this->repo = new VehicleRepository();
		$this->vehicleTypeRepo = new VehicleTypeRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "vehicle_id", 'text'=> "#"],
            [ 'value'=> "vehicle_name", 'text'=> translate('vehicle_name'), 'sortable'=> true ],
            [ 'value'=> "plate_number", 'text'=> translate('plate_number'), 'sortable'=> true ],
            [ 'value'=> "type.name", 'text'=> translate('Type')],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
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
            [ 'key'=> "vehicle_name", 'title'=> translate('vehicle_name'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "type_id", 'title'=> translate('Vehicle type'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'type_id', 'text_key'=>'name', 'withLabel'=>true,
				'data' => $this->vehicleTypeRepo->get()
			],
            [ 'key'=> "plate_number", 'title'=> translate('plate_number'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "capacity", 'title'=> translate('capacity'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'number' ],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=> true, 'column_type'=>'file' ],

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
		        'title' => translate('Vehicles'),
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
			throw new \Exception(translate('NAME_EMPTY'), 0);
		}

	}



	public function store() 
	{

		$params = $this->app->params();

        try {	

			try {

				$this->validate($params);

			} catch (\Throwable $e) {
	        	return array('result'=>$e->getMessage(), 'error'=>1);
			}

			$params['created_by'] = $this->app->auth()->id;
        	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception($e->getMessage(), 1);
        	
        }

	}


	public function updateLocation($params)
	{

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'p'=>$params, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception($e->getMessage(), 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['vehicle_id']);


            if ($this->repo->delete($params['vehicle_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            
        } catch (Exception $e) {
        	throw new \Exception($e->getMessage(), 1);
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
        	throw new \Exception($e->getMessage(), 1);
        }
	}
	
	
}