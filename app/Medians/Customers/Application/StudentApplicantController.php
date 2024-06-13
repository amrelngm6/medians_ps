<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure\StudentApplicantRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Users\Infrastructure\UserRepository;

class StudentApplicantController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $userRepo;

	protected $routeRepo;
	

	function __construct()
	{
		$this->app = new \config\APP;

		$user = $this->app->auth();

		$this->userRepo = new UserRepository();
		$this->repo = new StudentApplicantRepository();
		$this->routeRepo = new RouteRepository();
	}





        

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "applicant_id", 'text'=> "#"],
            [ 'value'=> "model.name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
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
		    return render('student_applicants', [
		        'load_vue' => true,
		        'title' => translate('Students Applicants'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get(),
		        'routes' => $this->routeRepo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function store() 
	{

		$params = (array) $this->app->params();

        try 
        {	
			
			$user = $this->app->auth();

			$params['status'] = 'new';

			if ($this->validateDuplication($params)) {
				return $this->validateDuplication($params);
            }

			try 
            {
				return (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }
	}


	public function update()
	{
		
		$params = $this->app->params();
		$params = (array)   is_array($params) ?  $params : json_decode($params);

        try {

			// if ($this->validate($params)) {
			// 	return $this->validate($params);
            // }

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
        }
	}


	public function delete()
	{
		
		$params = $this->app->params();

        try {

            if ($this->repo->delete($params['applicant_id']))
            {
                return array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1);
            }

        } catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
        }
	}



	/**
	*  Validate item update
	*/
	public function validate($params) 
	{
		try {
			
			/**
			 * Allow update if application 
			 * has been rejected
			 */
			if ($params['status'] == 'rejected')
			{
				return null;	
			}

			$check = $this->repo->getStudent($params['model_id']);
			
		} catch (\Exception $e) {
			return ['error'=>$e->getMessage()];
		}

	}

	
	/**
	*  Validate item update
	*/
	public function validateDuplication($params) 
	{
		try {
			

		} catch (\Exception $e) {
			return ['error'=>$e->getMessage()];
		}

	}

	/**
	 * Find old applicants
	 * 
	 * @param String
	 * 
	 * @return JSON
	 */
	public function loadStudentApplicants()
	{
		$user = $this->app->auth();
		$studentId = $this->app->request()->get('student_id');
		$data = $this->repo->getStudentApplicants( $studentId);

		return $data;

	}  



}