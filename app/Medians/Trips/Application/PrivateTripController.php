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

		$user = $this->app->auth();

		$this->repo = new PrivateTripRepository(isset($user->business) ? $user->business : null);
		$this->employeeRepo = new EmployeeRepository(isset($user->business) ? $user->business : null);
		$this->supervisorRepo = new SuperVisorRepository(isset($user->business) ? $user->business : null);
		$this->parentRepo = new ParentRepository(isset($user->business) ? $user->business : null);
		$this->vehicleRepo = new VehicleRepository(isset($user->business) ? $user->business : null);
		$this->driverRepo = new DriverRepository(isset($user->business) ? $user->business : null);
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
            [ 'value'=> "payment_status", 'text'=> __('Payment'), 'sortable'=> true ],
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
		$params = $this->app->request()->query->all();
		
		try {
			
		    return render('private_trips', [
		        'load_vue' => true,
		        'title' => __('Private Trips'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->getByDate($params),
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

		$user = $this->app->auth();

        try {	

        	$params['created_by'] = $user->id;
        	$params['business_id'] = $user->business->business_id;

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

	
	public function updateStatus($params)
	{
        try 
		{
            if ($this->repo->updateStatus($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	
	/**
	 * Customers create private trip
	 */
	public function createTrip() 
	{

		$params = (array) json_decode($this->app->request()->get('params'));

		$user = $this->app->auth();

        try {	


			$returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}


	public function cancelTrip()
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		return $this->repo->cancelTrip($params);
	}

	public function endTrip()
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		$params['status'] = 'completed';

		return $this->updateStatus($params);
	}

	public function startTrip()
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		$params['status'] = 'started';

		return $this->updateStatus($params);
	}



	/**
	 * Load private trip for Driver
	 */
	public function driverPrivateTrips()
	{
		$user = $this->app->auth();

		if (empty($user->driver_id)) { return null; }
		
		return $this->repo->getDriverTrips($user->driver_id);
	}

	
	/**
	 * Load private trip for Driver
	 */
	public function parentPrivateTrips()
	{
		$user = $this->app->auth();

		if (empty($user->customer_id)) { return null; }
		
		return $this->repo->getParentTrips($user->customer_id);

	}

	

	/**
	 * Load upcoming trip for Driver
	 */
	public function upcomingTrip()
	{
		$user = $this->app->auth();

		if (empty($user->driver_id)) { return null; }
		
		$trip = $this->repo->getUpcomingDriverTrip($user->driver_id);

		echo $trip ? json_encode( $trip) : '';
	}


	/**
	 * Load upcoming trip for Driver
	 */
	public function upcomingParentTrip()
	{
		$user = $this->app->auth();

		if (empty($user->customer_id)) { return null; }
		
		$trip = $this->repo->getUpcomingParentTrip($user->customer_id);

		echo $trip ? json_encode( $trip) : '';
	}

	/**
	 * Load upcoming trip for Driver
	 */
	public function getPrivateTrip($tripId)
	{
		$user = $this->app->auth();

		// if (empty($user->driver_id)) { return null; }
		
		$trip = $this->repo->getPrivateTrip($tripId);

		echo $trip ? json_encode( $trip) : '';
	}

}