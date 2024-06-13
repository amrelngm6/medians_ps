<?php
namespace Medians\Drivers\Application;

use Shared\dbaser\CustomController;

use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Drivers\Infrastructure\DriverApplicantRepository;
use Medians\Users\Infrastructure\UserRepository;

class DriverApplicantController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $userRepo;

	protected $driverRepo;
	

	function __construct()
	{
		$this->app = new \config\APP;

		$user = $this->app->auth();

		$this->userRepo = new UserRepository();
		$this->repo = new DriverApplicantRepository();
		$this->driverRepo = new DriverRepository();
	}





        

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "applicant_id", 'text'=> "#"],
            [ 'value'=> "driver.first_name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> translate('date'), 'sortable'=> true ],
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
			
		    return render('driver_applicants', [
		        'load_vue' => true,
		        'title' => translate('Drivers Applicants'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get(),
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

			$params['driver_id'] = $user->driver_id;
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

			if ($this->validate($params)) {
				return $this->validate($params);
            }

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
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

			$check = $this->repo->getDriver($params['driver_id']);
			

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


}