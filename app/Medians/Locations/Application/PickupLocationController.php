<?php
namespace Medians\Locations\Application;

use Shared\dbaser\CustomController;

use Medians\Locations\Infrastructure\PickupLocationRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Students\Infrastructure\StudentRepository;
use Medians\Routes\Infrastructure\RouteRepository;

class PickupLocationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	
	public $studentRepo;

	public $routeRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new PickupLocationRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->studentRepo = new StudentRepository();
		$this->routeRepo = new RouteRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "pickup_id", 'text'=> "#"],
            [ 'value'=> "location_name", 'text'=> __('location_name'), 'sortable'=> true ],
            [ 'value'=> "student_name", 'text'=> __('student_name'), 'sortable'=> true ],
            [ 'value'=> "latitude", 'text'=> __('latitude'), 'sortable'=> true ],
            [ 'value'=> "longitude", 'text'=> __('longitude'), 'sortable'=> true ],
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
            [ 'key'=> "pickup_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "model_type", 'title'=> "#", 'default'=> ($this->studentRepo->getModel())::class, 'column_type'=>'hidden'],
			[ 'key'=> "model_id", 'title'=> __('Student'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'student_id', 'text_key'=>'student_name', 
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
		        'title' => __('PickupLocations'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * getPickupLocation
	 */
	public function getPickupLocation($id)
	{
		$data =  $this->repo->find($id);

		echo  json_encode($data);
	}


	/**
	 * getPickupLocation
	 */
	public function loadPickup()
	{
		
		$student_id = $this->app->request()->get('student_id');

		$data =  $this->repo->findByStudent($student_id);

		return $data;
	}


	public function store() 
	{

		$params = $this->app->params();

        try {	

        	$params['created_by'] = $this->app->auth()->id;
        	

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
		$params = $this->app->params();

        try {

        	$params['status'] = isset($params['status']) ? 1 : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>0);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}


	/// Update working days
	public function updateDays()
	{
		$params = (array)  json_decode($this->app->params());

		error_log($this->app->params());
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
		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['pickup_id']);

            if ($this->repo->delete($params['pickup_id']))
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


}