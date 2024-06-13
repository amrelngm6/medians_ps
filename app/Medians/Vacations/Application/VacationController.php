<?php
namespace Medians\Vacations\Application;

use Shared\dbaser\CustomController;

use Medians\Vacations\Infrastructure\VacationRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;

class VacationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $vehicleRepo;

	public $driverRepo;

	public $supervisorRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->repo = new VacationRepository();
		$this->supervisorRepo = new SuperVisorRepository();
		$this->vehicleRepo = new VehicleRepository();
		$this->driverRepo = new DriverRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "vacation_id", 'text'=> "#"],
            [ 'value'=> "date", 'text'=> translate('date'), 'sortable'=> true ],
            [ 'value'=> "user.name", 'text'=> translate('User'), 'sortable'=> true ],
            // [ 'value'=> "edit", 'text'=> translate('Edit') ],
            [ 'value'=> "delete", 'text'=> translate('Delete') ],
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
		        'title' => translate('Vacations'),
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

		$params = $this->app->params();

        try {	
			
			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

		$params = $this->app->params();

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {


            if ($this->repo->delete($params['vacation_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	
	public function create() 
	{	

		$params = (array) $this->app->params();

        try {	
			
			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

		$params = (array) $this->app->params();

        try {	
			
			$check = $this->repo->update($params);
			$returnData = isset($check->vacation_id)
			? array('success'=>1, 'result'=>translate('updated successfully'), 'reload'=>1)
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