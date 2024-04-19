<?php
namespace Medians\Vacations\Application;

use Shared\dbaser\CustomController;

use Medians\Vacations\Infrastructure\VacationRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Locations\Infrastructure\StateRepository;

class VacationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $vehicleRepo;

	public $driverRepo;

	public $stateRepo;

	public $supervisorRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->repo = new VacationRepository($user->business);
		$this->supervisorRepo = new SuperVisorRepository($user->business);
		$this->vehicleRepo = new VehicleRepository($user->business);
		$this->driverRepo = new DriverRepository($user->business);
		$this->stateRepo = new StateRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "vacation_id", 'text'=> "#"],
            [ 'value'=> "date", 'text'=> __('date'), 'sortable'=> true ],
            [ 'value'=> "user.name", 'text'=> __('User'), 'sortable'=> true ],
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

			return render('vacations', [
		        'load_vue' => true,
		        'title' => __('Vacations'),
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
			
			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
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
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {


            if ($this->repo->delete($params['vacation_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	
	public function create() 
	{	

		$params = (array) json_decode($this->app->request()->get('params'));

        try {	
			
			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	
	
	public function update_student_vacation() 
	{	

		$params = (array) json_decode($this->app->request()->get('params'));

        try {	
			
			$check = (!empty($this->repo->update($params)));
			$returnData = isset($check->vacation_id)
			? array('success'=>1, 'result'=>__('updated successfully'), 'reload'=>1)
			: array('success'=>0, 'result'=> $check, 'error'=>1);


        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	
	
	/**
	 * Load student vacations
	 */
	public function load_student_vacations()
	{
		$studentId = $this->app->request()->get('student_id');
		$user = $this->app->auth();

		if (empty($user->customer_id)) { return null; }
		
		return $this->repo->getStudentVacations($studentId);
	}


}