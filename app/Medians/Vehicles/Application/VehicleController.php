<?php
namespace Medians\Vehicles\Application;

use Shared\dbaser\CustomController;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class VehicleController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	public $routeRepo;
	public $driverRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new VehicleRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->routeRepo = new RouteRepository();
		$this->driverRepo = new DriverRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "vehicle_id", 'title'=> "#"],
            [ 'key'=> "vehicle_name", 'title'=> __('vehicle_name'), 'sortable'=> true ],
            [ 'key'=> "plate_number", 'title'=> __('plate_number'), 'sortable'=> true ],
            [ 'key'=> "maintenance_status", 'title'=> __('maintenance_status'), 'sortable'=> true ],
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
            [ 'key'=> "vehicle_name", 'title'=> __('vehicle_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "maintenance_status", 'title'=> __('maintenance_status'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "route_id", 'title'=> __('Route'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'route_name', 
				'data' => $this->routeRepo->get()
			],
            [ 'key'=> "driver_id", 'title'=> __('Driver'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'first_name', 
				'data' => $this->driverRepo->get()
			],
            [ 'key'=> "plate_number", 'title'=> __('plate_number'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "capacity", 'title'=> __('capacity'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'number' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=> true, 'column_type'=>'file' ],

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
		        'title' => __('Vehicles'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'types' => ['car', 'bus'],
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	/**
	 * Create new item
	 * 
	 */ 
	public function create() 
	{

		return render('views/admin/Vehicle/create.html.twig', [
	        'title' => __('add_new'),
	        'langs_list' => ['ar','en'],
	    ]);

	}



	public function edit($id ) 
	{
		try {
				
			return render('views/admin/Vehicle/Vehicle.html.twig', [
		        'title' => __('edit_Vehicle'),
		        'langs_list' => ['ar','en'],
		        'item' => $this->repo->find($id),
		        'categories' => $this->categoryRepo->get('Medians\Vehicles\Domain\Vehicle'),
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


	public function updateLocation($params)
	{

        try {

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

        	$check = $this->repo->find($params['vehicle_id']);


            if ($this->repo->delete($params['vehicle_id']))
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
	 * Front page 
	 * @var Int
	 */
	public function page($contentObject)
	{

		try {
			
			$item = $this->repo->find($contentObject->item_id);
			$item->addView();

			return render('views/front/page.html.twig', [
		        'item' => $item,
		        'similar_articles' => $this->repo->similar($item, 3),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

	/**
	 * Front page 
	 * @var Int
	 */
	public function list()
	{
		$request =  $this->app->request();

		try {
				
			return render('views/front/Vehicle.html.twig', [
		        'first_item' => $this->repo->getFeatured(1),
		        'search_items' => $request->get('search') ?  $this->repo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
		        'items' => $this->repo->get(4),
		        'cat_her' => $this->repo->getByCategory(6, 4),
		        'cat_him' => $this->repo->getByCategory(7, 4),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}