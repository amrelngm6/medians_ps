<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure\BusinessApplicantRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Users\Infrastructure\UserRepository;

class BusinessApplicantController extends CustomController 
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
		$this->repo = new BusinessApplicantRepository(isset($user->business) ? $user->business : null);
		$this->routeRepo = new RouteRepository(isset($user->business) ? $user->business : null);
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
		    return render('business_applicants', [
		        'load_vue' => true,
		        'title' => translate('Businesss Applicants'),
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
				$this->repo->updateStudentBusiness($params);
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
			
			if (!empty($check->business_id)) {
				
				/** Get current session */
				$user = $this->app->auth();

				/**
				 * Check if driver already exists
				 * Or if the application has been updated before
				 */
				if ($check->business_id == $user->business->business_id)
				{
					return ['error' => translate('Student already exists')];
				}
				
				/**
				 * Check if driver already 
				 * working with another business
				 */
				if ($check->business_id != $user->business->business_id)
				{
					return ['error' => translate('Student approved by another business')];
				}
			}

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
			
			/**
			 * Allow update if duplicated
			 */
			$check = $this->repo->checkDuplicate($params['business_id'], $params['model_id']);
			
			/**
			 * Check if applied already exists
			 */
			return (!empty($check->business_id)) 
				? ['error' => translate('Already applied to this business')]
				: null;

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