<?php
namespace Medians\Trips\Application;

use Shared\dbaser\CustomController;

use Medians\Trips\Infrastructure\TripRepository;
use Medians\Users\Infrastructure\UserRepository;

class TripController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app; 

	public $userRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new TripRepository($this->app->auth()->business);
		$this->userRepo = new UserRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "trip_id", 'text'=> "#"],
            [ 'value'=> "vehicle.plate_number", 'text'=> translate('vehicle'), 'sortable'=> true ],
            [ 'value'=> "driver_name", 'text'=> translate('driver'), 'sortable'=> true ],
			[ 'value'=> "locations_count", 'text'=> translate('pickup Locations'), 'sortable'=> true],
            [ 'value'=> "duration", 'text'=> translate('Duration'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> translate('trip_date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('trip_status'), 'sortable'=> true ],
            [ 'value'=> "details", 'text'=> translate('Details') ],
            [ 'value'=> "delete", 'text'=> translate('Delete') ],
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
			
		    return render('trips', [
		        'load_vue' => true,
		        'title' => translate('Trips'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->getByDate($params),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['id']);

            if ($this->repo->delete($params['id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }

	}

	/**
	 * End Route trip
	 */
	public function endTrip()
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		$user = $this->app->auth();
        try 
		{
            if ($this->repo->endTrip($params, $user->driver_id))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	
	/**
	 * get Trip
	 */
	public function getTrip($id)
	{
		
		$trip =  $this->repo->getTrip($id);

		echo  json_encode( $trip );
	}

	
	/**
	 * Get Trip
	 */
	public function getParentTrip($id)
	{
		
		$user = $this->app->auth();		

		$trip =  $this->repo->getParentTrip($id, $user->customer_id);

		echo  json_encode( $trip );
	}
	
	/**
	 * Get Active Parent childs Trip
	 */
	public function getActiveParentTrip()
	{
		
		$user = $this->app->auth();		

		return   $this->repo->getActiveParentTrip($user->customer_id);
	}

	/**
	 * Get Driver active Trip
	 */
	public function getActiveDriverTrip()
	{
		$user = $this->app->auth();		

		return  $this->repo->getActiveDriverTrip($user->driver_id);
	}

	

	/**
	 * Load Trips of driver
	 */
	public function loadTrips()
	{
		$user = $this->app->auth();

		if  (isset($user->driver_id))
		{
			return   $this->repo->getDriverTrips($user->driver_id, 100);
		}
		
		if  (isset($user->customer_id))
		{
			return  $this->repo->getParentStudentsTrips($user->customer_id, 100);
		}

		return [];
	}


	/**
	 * Load Trips of Student
	 */
	public function loadStudentTrips($params)
	{
		$studentId = $this->app->request()->get('student_id'); 
		$lastId = $this->app->request()->get('lastId'); 

		return  $this->repo->getStudentTrips($studentId, $lastId);
	}


	/**
	 * Load Trips of driver
	 */
	public function loadParentTrips($params)
	{
		$lastId = $this->app->request()->get('lastId'); 
		
		$user = $this->app->auth();
		return  $this->repo->getParentStudentsTrips($user->customer_id, $lastId);
	}

	function haversineDistance($lat1, $lon1, $lat2 = 30.950765, $lon2 = 31.921556)  {
		$earthRadius = 6371; // Radius of the Earth in kilometers
	
		$dlat = deg2rad($lat2 - $lat1);
		$dlon = deg2rad($lon2 - $lon1);
	
		$a = sin($dlat/2) * sin($dlat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlon/2) * sin($dlon/2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	
		$distance = $earthRadius * $c; // The distance in kilometers
	
		return $distance*1000;
	}

	
	public function getActiveTrip()
	{
		$user = $this->app->auth();

		try 
		{
			return $this->repo->getActiveDriverTrip($user->driver_id);
			
		} catch (Exception $e) {
			throw new \Exception("Error Processing Request", 1);
		}
	}


	public function createTrip()
	{
		$params = json_decode($this->app->request()->get('params'));

        try 
		{
			$trip = $this->repo->createTrip($params);

            if (isset($trip->trip_id))
            {
                return array('success'=>1, 'result'=>$trip);
            } else {
                return array('error'=>1, 'result'=>translate('Not available'));
			}

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function updateLocation()
	{
		$params = (array) json_decode($this->app->request()->get('params'));

        try 
		{
			$location = $this->repo->updateTripLocationStatus($params);

            if ($location)
            {
                return array('success'=>1, 'result'=>$location);
            } else {
                return array('error'=>1, 'result'=>translate('Not available'));
			}

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}



	/**
	 * Send alarm to Pickup user
	 */
	
	 public function createAlarm()
	 {
		 $params = (array) json_decode($this->app->request()->get('params'));
 
		 try 
		 {
			 $trip = $this->repo->createAlarm($params);
 
			 if (isset($trip->trip_id))
			 {
				 return array('success'=>1, 'result'=>$trip);
			 } else {
				 return array('error'=>1, 'result'=>translate('Not available'));
			 }
 
		 } catch (Exception $e) {
			 throw new \Exception("Error Processing Request", 1);
		 }
	 }
 
}