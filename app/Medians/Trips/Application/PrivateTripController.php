<?php
namespace Medians\Trips\Application;

use Shared\dbaser\CustomController;

use Medians\Trips\Infrastructure\PrivateTripRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Customers\Infrastructure\ParentRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;
use Medians\Customers\Infrastructure\EmployeeRepository;

class PrivateTripController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $employeeRepo;

	public $supervisorRepo;

	public $parentRepo;
	
	public $vehicleRepo;

	public $driverRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new PrivateTripRepository($this->app->auth()->business);
		$this->employeeRepo = new EmployeeRepository($this->app->auth()->business);
		$this->supervisorRepo = new SuperVisorRepository($this->app->auth()->business);
		$this->parentRepo = new ParentRepository($this->app->auth()->business);
		$this->vehicleRepo = new VehicleRepository($this->app->auth()->business);
		$this->driverRepo = new DriverRepository($this->app->auth()->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "trip_id", 'text'=> "#"],
            [ 'value'=> "vehicle.plate_number", 'text'=> __('vehicle'), 'sortable'=> true ],
            [ 'value'=> "driver.name", 'text'=> __('driver'), 'sortable'=> true ],
            [ 'value'=> "duration", 'text'=> __('Duration'), 'sortable'=> true ],
            [ 'value'=> "distance", 'text'=> __('Distance').'-KM', 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> __('trip_date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> true ],
            [ 'value'=> "details", 'text'=> __('Details') ],
            [ 'value'=> "delete", 'text'=> __('Delete') ],
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
			
		    return render('private_trips', [
		        'load_vue' => true,
		        'title' => __('Private Trips'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get(),
		        'employees' => $this->employeeRepo->get(),
		        'drivers' => $this->driverRepo->get(),
		        'vehicles' => $this->vehicleRepo->get(),
		        'supervisors' => $this->supervisorRepo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	
	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['created_by'] = $this->app->auth()->id;
        	$params['business_id'] = $this->app->auth()->business->business_id;

			$returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function update()
	{
		
		$params = $this->app->request()->get('params');

        try {
			
            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	public function checkboxValue($params, $key)
	{
		return (isset($params[$key]) && $params[$key] != 'false' && $params[$key] != 'null' ) ? 'on' : null;
	}

	public function delete() 
	{
		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['trip_id']);

            if ($this->repo->delete($params['trip_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	/**
	 * Load upcoming trip for Driver
	 */
	public function upcomingTrip()
	{
		$user = $this->app->auth();

		// if (empty($user->driver_id))
		// {
		// 	return null;
		// }
		
		$trip = $this->repo->getUpcomingDriverTrip($this->app->request()->get('driver_id'));
		// $trip = $this->repo->getUpcomingDriverTrip($driver_id);
		print_r($trip);
		return $trip;
	}

}