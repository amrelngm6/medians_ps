<?php
namespace Medians\Trips\Application;

use Shared\dbaser\CustomController;

use Medians\Trips\Infrastructure\TripRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Users\Infrastructure\UserRepository;

class TripController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;

	public $userRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new TripRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->userRepo = new UserRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "trip_id", 'title'=> "#"],
            [ 'key'=> "car_plate", 'title'=> __('vehicle'), 'sortable'=> true ],
            [ 'key'=> "driver_name", 'title'=> __('driver'), 'sortable'=> true ],
			[ 'key'=> "pickup_locations_count", 'title'=> __('pickup Locations'), 'sortable'=> true],
            [ 'key'=> "duration", 'title'=> __('Duration'), 'sortable'=> true ],
            [ 'key'=> "distance", 'title'=> __('Distance').'-KM', 'sortable'=> true ],
            [ 'key'=> "trip_date", 'title'=> __('trip_date'), 'sortable'=> true ],
            [ 'key'=> "trip_status", 'title'=> __('trip_status'), 'sortable'=> true ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
		return [
            [ 'key'=> "trip_id", 'title'=> "#", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "trip_date", 'title'=> __('trip_date'), 'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "trip_status", 'title'=> __('trip_status'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "trip_id", 'title'=> __('trip_status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
			
		    return render('trips', [
		        'load_vue' => true,
		        'title' => __('Trips'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
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
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }

	}

	public function validate($params) 
	{

		if (empty($params['content']['ar']['title']))
		{
        	throw new \Exception(json_encode(array('result'=>__('NAME_EMPTY'), 'error'=>1)), 1);
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
	 * get Trip
	 */
	public function getActiveDriverTrip()
	{
		$user = $this->app->auth();		

		$trip =  $this->repo->getActiveDriverTrip($user->driver_id);

		echo  json_encode( $trip );
	}

	

	/**
	 * Load Trips of driver
	 */
	public function loadTrips($params)
	{
		$user = $this->app->auth();
		if  (isset($user->driver_id))
		{
			return  $this->repo->getDriverTrips($user->driver_id, $this->app->request()->get('lastId'));
		}
		
		if  (isset($user->parent_id))
		{
			return  $this->repo->getParentStudentsTrips($user->parent_id, $this->app->request()->get('lastId'));
		}

		return [];
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
	

}