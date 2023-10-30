<?php
namespace Medians\Drivers\Application;

use Shared\dbaser\CustomController;

use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Users\Infrastructure\UserRepository;

class DriverController extends CustomController 
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

		$this->repo = new DriverRepository();
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
            [ 'key'=> "driver_id", 'title'=> "#"],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'sortable'=> true ],
            [ 'key'=> "email", 'title'=> __('email'), 'sortable'=> true ],
            [ 'key'=> "contact_number", 'title'=> __('contact_number'), 'sortable'=> true ],
            [ 'key'=> "driver_license_number", 'title'=> __('license_number'), 'sortable'=> true ],
            [ 'key'=> "vehicle_plate_number", 'title'=> __('plate_number'), 'sortable'=> true ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "driver_id", 'title'=> "#", 'fillable'=>true, 'column_type'=>'hidden'],
			[ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "password", 'title'=> __('Password'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'password' ],
            [ 'key'=> "contact_number", 'title'=> __('contact_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'mobile' ],
            [ 'key'=> "driver_license_number", 'title'=> __('driver_license_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "vehicle_plate_number", 'title'=> __('vehicle_plate_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
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
			
		    return render('drivers', [
		        'load_vue' => true,
		        'title' => __('Drivers'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'categories' => $this->categoryRepo->get('Medians\Drivers\Domain\Driver'),
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

		return render('views/admin/Driver/create.html.twig', [
	        'title' => __('add_new'),
	        'langs_list' => ['ar','en'],
	        'categories' => $this->categoryRepo->get('Medians\Drivers\Domain\Driver'),
	    ]);

	}



	public function edit($id ) 
	{
		try {
				
			return render('views/admin/Driver/Driver.html.twig', [
		        'title' => __('edit_Driver'),
		        'langs_list' => ['ar','en'],
		        'item' => $this->repo->find($id),
		        'categories' => $this->categoryRepo->get('Medians\Drivers\Domain\Driver'),
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
	 * get Driver
	 */
	public function getDriver($id)
	{
		$data =  $this->repo->getDriver($id);

		echo  json_encode($data);
	}

}