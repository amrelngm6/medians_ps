<?php
namespace Medians\Routes\Application;

use Shared\dbaser\CustomController;

use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class RouteController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	public $vehicleRepository;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new RouteRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->vehicleRepository = new VehicleRepository();
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
            [ 'value'=> "driver_name", 'text'=> __('driver_name'), 'sortable'=> true ],
            [ 'value'=> "pickup_locations", 'text'=> __('pickup_locations'), 'sortable'=> true ],
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

		return [
            [ 'key'=> "route_id", 'title'=> "#",'column_type'=>'hidden'],
            [ 'key'=> "route_name", 'title'=> __('route_name'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "latitude", 'title'=> __('Latitude'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "longitude", 'title'=> __('Longitude'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "description", 'title'=> __('description'), 'fillable'=>true, 'column_type'=>'text' ],
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
			
		    return render('routes', [
		        'load_vue' => true,
		        'title' => __('Routes'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
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
		$data =  $this->repo->find($id);

		echo  json_encode($data);
	}


	/**
	 * getRoute
	 */
	public function getDriverRoutes()
	{
		$user = $this->app->auth();		

		$data =  $this->repo->getDriverRoutes($user->driver_id);
		echo  json_encode($data);
	}



	public function store() 
	{

		$params = $this->app->params();

        try {	

			// Administrator user id
        	$params['created_by'] = $this->app->auth()->id;
        	$params['latitude'] = intval($params['latitude']) ?? 0;
        	$params['longitude'] = intval($params['longitude']) ?? 0;

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

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

        	$params['latitude'] = intval($params['latitude']) ?? 0;
        	$params['longitude'] = intval($params['longitude']) ?? 0;
			
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

		$params = $this->app->params();

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