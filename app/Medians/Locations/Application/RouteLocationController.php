<?php
namespace Medians\Locations\Application;

use Shared\dbaser\CustomController;

use Medians\Locations\Infrastructure\RouteLocationRepository;
use Medians\Students\Infrastructure\StudentRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Customers\Infrastructure\EmployeeRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;

class RouteLocationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;
	
	public $studentRepo;

	public $routeRepo;

	public $employeeRepo;

	public $supervisorRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new RouteLocationRepository($this->app->auth()->business);
		$this->routeRepo = new RouteRepository($this->app->auth()->business);
		$this->studentRepo = new StudentRepository($this->app->auth()->business);
		$this->employeeRepo = new EmployeeRepository($this->app->auth()->business);
		$this->supervisorRepo = new SuperVisorRepository($this->app->auth()->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{	
		$type = $this->app->auth()->business->type;

		return [
            [ 'value'=> "location_id", 'text'=> "#"],
            [ 'value'=> "model", 'text'=> __('User'), 'sortable'=> true ],
            [ 'value'=> "route.route_name", 'text'=> __('Route'), 'sortable'=> true ],
            [ 'value'=> "start_address", 'text'=> __('Pickup address'), 'sortable'=> true ],
            [ 'value'=> "status_text", 'text'=> __('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('Edit') ],
            [ 'value'=> "delete", 'text'=> __('delete') ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "location_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "model_type", 'title'=> "#", 'default'=> $this->studentRepo->getClassName(), 'column_type'=>'hidden'],
			[ 'key'=> "model_id", 'title'=> __('Student'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'student_id', 'text_key'=>'name', 
				'data' => $this->studentRepo->get()
			],
			[ 'key'=> "route_id", 'title'=> __('Route'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'route_name', 
				'data' => $this->routeRepo->get()
			],
            [ 'key'=> "location_name", 'title'=> __('location_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "address", 'title'=> __('address'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "latitude", 'title'=> __('latitude'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "longitude", 'title'=> __('longitude'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "status", 'title'=> __('status'),  'fillable'=>true, 'column_type'=>'checkbox' ],
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
			
		    return render('locations', [
		        'load_vue' => true,
		        'title' => __('RouteLocations'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'employees' => $this->employeeRepo->get(),
		        'supervisors' => $this->supervisorRepo->get(),
		        'students' => $this->studentRepo->get(),
		        'routes' => $this->routeRepo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * getRouteLocation
	 */
	public function getRouteLocation($id)
	{
		$data =  $this->repo->find($id);

		echo  json_encode($data);
	}


	/**
	 * loadLocation
	 */
	public function loadPickup()
	{
		
		$student_id = $this->app->request()->get('student_id');

		$data =  $this->repo->findByStudent($student_id);

		return $data;
	}


	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['created_by'] = $this->app->auth()->id;
        	$params['business_id'] = $this->app->auth()->business->business_id;

        	$params['status'] = $this->checkboxValue($params, 'status');
        	$params['saturday'] = $this->checkboxValue($params, 'saturday');
        	$params['sunday'] = $this->checkboxValue($params, 'sunday');
        	$params['monday'] = $this->checkboxValue($params, 'monday');
        	$params['tuesday'] = $this->checkboxValue($params, 'tuesday');
        	$params['wednesday'] = $this->checkboxValue($params, 'wednesday');
        	$params['thursday'] = $this->checkboxValue($params, 'thursday');
        	$params['friday'] = $this->checkboxValue($params, 'friday');
			
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
			
        	$params['status'] = $this->checkboxValue($params, 'status');
        	$params['saturday'] = $this->checkboxValue($params, 'saturday');
        	$params['sunday'] = $this->checkboxValue($params, 'sunday');
        	$params['monday'] = $this->checkboxValue($params, 'monday');
        	$params['tuesday'] = $this->checkboxValue($params, 'tuesday');
        	$params['wednesday'] = $this->checkboxValue($params, 'wednesday');
        	$params['thursday'] = $this->checkboxValue($params, 'thursday');
        	$params['friday'] = $this->checkboxValue($params, 'friday');
			
            if ($this->repo->update($params))
            {

                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
        }
	}

	public function checkboxValue($params, $key)
	{
		return (isset($params[$key]) && $params[$key] != 'false' && $params[$key] != 'null' ) ? 'on' : null;
	}


	/// Update working days
	public function updateDays()
	{
		$params = (array)  json_decode($this->app->request()->get('params'));

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>0);
            }
        
        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}


	public function delete() 
	{
		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['location_id']);

            if ($this->repo->delete($params['location_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }

	}


}