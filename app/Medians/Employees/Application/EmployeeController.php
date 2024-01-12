<?php
namespace Medians\Employees\Application;

use Shared\dbaser\CustomController;

use Medians\Employees\Infrastructure\EmployeeRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class EmployeeController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new EmployeeRepository();
		$this->categoryRepo = new CategoryRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "employee_id", 'text'=> "#"],
            [ 'value'=> "employee_name", 'text'=> __('Name'), 'sortable'=> true ],
            [ 'value'=> "students", 'text'=> __('Students'), 'sortable'=> true ],
            [ 'value'=> "email", 'text'=> __('Email'), 'sortable'=> true ],
            [ 'value'=> "contact_number", 'text'=> __('Mobile'), 'sortable'=> false ],
			['value'=>'edit', 'text'=>__('Edit')],
			['value'=>'delete', 'text'=>__('Delete')],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "employee_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('Email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "contact_number", 'title'=> __('Mobile'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'file' ],
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
			
		    return render('employees', [
		        'load_vue' => true,
		        'title' => __('Employee'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * Employee Login through Mobile API
	 */
	public function login()
	{
		$Auth = new \Medians\Auth\Application\AuthService;
		$repo = new \Medians\Employees\Infrastructure\EmployeeRepository;

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->employee_id)) {
			return ['error'=> __("User credentials not valid")]; 
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->employee_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		return 
		[
			'success'=>true, 
			'employee_id'=> isset($checkLogin->employee_id) ? $checkLogin->employee_id : null, 
			'token'=>$generateToken->value
		];
	}  



	public function signup() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));
        try {	

            return  (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Password sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function resetPassword() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));

        try {	

			$check = $this->repo->resetPassword($params);

            return  ($check == 1) 
            ? array('success'=>1, 'result'=>__('Confirmation code sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=> $check, 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	/**
	 * Reset and change password  
	 */
	public function resetChangePassword()
	{
		$params = (array) json_decode($this->app->request()->get('params'));

        try {
			
			$check = $this->repo->resetChangePassword($params);
            return isset($check->employee_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function updateMobile()
	{
		$params = $this->app->request()->get('params');
		$params = is_array($params) ?  (array) $params : json_decode($params);

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	public function changePassword()
	{
		$_params = $this->app->request()->get('params');
		$params = (array) (is_array($_params) ?  $_params : json_decode($_params));

        try {
			
			$params['employee_id'] = $this->app->auth()->employee_id;

			$check = $this->repo->changePassword($params);
            return isset($check->employee_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
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

        	$check = $this->repo->find($params['employee_id']);


            if ($this->repo->delete($params['employee_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	/**
	 * get Employee
	 */
	public function getEmployee()
	{
		$this->app = new \config\APP;

		$data =  $this->repo->getEmployee($this->app->auth()->employee_id);

		echo  json_encode($data);
	}


	/**
	 * get Employee
	 */
	public function checkEmployee($id)
	{
		$data =  $this->repo->getEmployee($id);

		echo  json_encode($data);
	}


}