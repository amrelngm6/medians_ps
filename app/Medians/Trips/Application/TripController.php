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
            [ 'key'=> "trip_date", 'title'=> __('trip_date'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "trip_status", 'title'=> __('trip_status'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'date' ],
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
	 * get Trip
	 */
	public function getTrip($id)
	{
		$data =  $this->repo->getTrip($id);

		echo  json_encode($data);
	}

}