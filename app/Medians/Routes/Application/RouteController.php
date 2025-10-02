<?php
namespace Medians\Routes\Application;

use Shared\dbaser\CustomController;

use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;

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
		$user->business = isset($user->business) ? $user->business : null;

		$this->repo = new RouteRepository($user->business);
		$this->supervisorRepo = new SuperVisorRepository($user->business);
		$this->vehicleRepo = new VehicleRepository($user->business);
		$this->driverRepo = new DriverRepository($user->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "route_id", 'text'=> "#"],
            [ 'value'=> "route_name", 'text'=> translate('route_name'), 'sortable'=> true ],
            [ 'value'=> "driver", 'text'=> translate('driver_name'), 'sortable'=> true ],
            [ 'value'=> "vehicle.plate_number", 'text'=> translate('vehicle'), 'sortable'=> true ],
            [ 'value'=> "supervisor.name", 'text'=> translate('supervisor'), 'sortable'=> true ],
            [ 'value'=> "route_locations", 'text'=> translate('route_locations'), 'sortable'=> true ],
            [ 'value'=> "morning_trip_time", 'text'=> translate('Morning Trip'), 'sortable'=> true ],
            [ 'value'=> "afternoon_trip_time", 'text'=> translate('Afternoon Trip'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('Edit') ],
            [ 'value'=> "delete", 'text'=> translate('Delete') ],
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
		        'title' => translate('Routes'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'supervisors' => $this->supervisorRepo->get(),
		        'drivers' => $this->driverRepo->getActive(),
		        'vehicles' => $this->vehicleRepo->get(),

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

		$businessId = $this->app->request()->get('business_id');

		if(empty($user)) {return null;}

		$data =  $this->repo->getBusinessRoutes($businessId);
		echo  json_encode($data);
	}



	public function store() 
	{	

		$params = $this->app->params();

        try {	
			
			$user = $this->app->auth();

			if (empty($user->business)) {
				return array('error'=>translate('You are not authorized to add new routes, Please contact the administrator'));
			}

			if (empty($params['route_name'])) {
				return array('error'=>translate('Please enter route name'));
			}

			try {
				
				if (empty($params['position'])) {
					return array('error'=>translate('Please set route start and end location'));
				}
				
				$position = json_decode($params['position']);

				if (empty($position) && !empty($params['route_locations'])) {
					$params['position'] = json_decode($params['route_locations'])[0] ?? null;
				}

			} catch (\Throwable $th) {
				return array('error'=>translate('Please set route start and end location'));
			}

			// Administrator user id
			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;
        	$params['business_id'] = $user->business->business_id;
        	$params['created_by'] = $user->id;

			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

		return $params;

        try {
			$user = $this->app->auth();

			if (empty($user->business->business_id) || $user->business->business_id != $params['business_id']) {
				return array('error'=>translate('You are not authorized to add new routes, Please contact the administrator'));
			}

			if (empty($params['position'])) {
				return array('error'=>translate('Please set route start and end location'));
			}
			
			$position = json_decode($params['position']);

			$locations = json_decode($params['route_locations'], true);
			print_r($params['route_locations']);

			if (empty($position) && !empty($params['route_locations'])) {
				$position = json_decode($params['route_locations'])[0] ?? null;
				$params['position'] = json_encode($position);
			}

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;

			if (empty($params['route_name'])) {
				return array('error'=>translate('Please enter route name'));
			}
			
            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>'Please try again later');
        	return array('error'=>$e->getMessage());
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['route_id']);


            if ($this->repo->delete($params['route_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}