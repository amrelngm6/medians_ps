<?php
namespace Medians\Routes\Application;

use Shared\dbaser\CustomController;

use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Locations\Infrastructure\StateRepository;

class RouteController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $vehicleRepo;

	public $driverRepo;

	public $stateRepo;

	public $supervisorRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->repo = new RouteRepository($user->business);
		$this->supervisorRepo = new SuperVisorRepository($user->business);
		$this->vehicleRepo = new VehicleRepository($user->business);
		$this->driverRepo = new DriverRepository($user->business);
		$this->stateRepo = new StateRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "route_id", 'text'=> "#"],
            [ 'value'=> "route_name", 'text'=> __('route_name'), 'sortable'=> true ],
            [ 'value'=> "driver.name", 'text'=> __('driver_name'), 'sortable'=> true ],
            [ 'value'=> "vehicle.plate_number", 'text'=> __('vehicle'), 'sortable'=> true ],
            [ 'value'=> "supervisor.name", 'text'=> __('supervisor'), 'sortable'=> true ],
            [ 'value'=> "route_locations", 'text'=> __('route_locations'), 'sortable'=> true ],
            [ 'value'=> "morning_trip_time", 'text'=> __('Morning Trip'), 'sortable'=> true ],
            [ 'value'=> "afternoon_trip_time", 'text'=> __('Afternoon Trip'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('Edit') ],
            [ 'value'=> "delete", 'text'=> __('Delete') ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
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

			return render('routes', [
		        'load_vue' => true,
		        'title' => __('Routes'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'supervisors' => $this->supervisorRepo->get(),
		        'drivers' => $this->driverRepo->get(),
		        'vehicles' => $this->vehicleRepo->get(),
		        'cities' => $this->stateRepo->getWithCities(),

		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	 * getRoute
	 */
	public function getRoute($id)
	{
		try {
			
			$data =  $this->repo->find($id);

			echo  json_encode($data);

		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}


	/**
	 * getRoute
	 */
	public function getDriverRoutes()
	{
		$user = $this->app->auth();		

		if(empty($user->driver_id)) {return null;}

		$data =  $this->repo->getDriverRoutes($user->driver_id);
		echo  json_encode($data);
	}

	/**
	 * get Business Routes
	 */
	public function getBusinessRoutes()
	{
		$user = $this->app->auth();		

		if(empty($user->driver_id)) {return null;}

		$data =  $this->repo->getBusinessRoutes();
		echo  json_encode($data);
	}



	public function store() 
	{	

		$params = $this->app->request()->get('params');

        try {	
			
			$user = $this->app->auth();

			// Administrator user id
			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;
        	$params['business_id'] = $user->business->business_id;
        	$params['created_by'] = $user->id;

			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update()
	{

		$params = $this->app->request()->get('params');

        try {

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['route_id']);


            if ($this->repo->delete($params['route_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}