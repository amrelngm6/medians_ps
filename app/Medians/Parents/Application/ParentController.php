<?php
namespace Medians\Parents\Application;

use Shared\dbaser\CustomController;

use Medians\Parents\Infrastructure\ParentRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class ParentController extends CustomController 
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

		$this->repo = new ParentRepository();
		$this->categoryRepo = new CategoryRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "parent_id", 'text'=> "#"],
            [ 'value'=> "parent_name", 'text'=> __('Name'), 'sortable'=> true ],
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
            [ 'key'=> "parent_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true, 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('Email'), 'sortable'=> true, 'required'=>true, 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "contact_number", 'title'=> __('Mobile'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "status", 'title'=> __('Status'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'checkbox' ],
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
			
		    return render('parents', [
		        'load_vue' => true,
		        'title' => __('Parent'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * Parent Login through Mobile API
	 */
	public function login()
	{
		$Auth = new \Medians\Auth\Application\AuthService;
		$repo = new \Medians\Parents\Infrastructure\ParentRepository;

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->parent_id)) {
			return ['error'=> __("User credentials not valid")]; 
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->parent_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		return 
		[
			'success'=>true, 
			'parent_id'=> isset($checkLogin->parent_id) ? $checkLogin->parent_id : null, 
			'token'=>$generateToken->value
		];
	}  



	public function signup() 
	{
		$params = (array) $this->app->params();
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
		$params = (array) $this->app->params();

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
		$params = (array) $this->app->params();

        try {
			
			$check = $this->repo->resetChangePassword($params);
            return isset($check->parent_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function updateMobile()
	{
		$params = (array) $this->app->params();

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
		$params = (array)  $this->app->params();

        try {
			
			$params['parent_id'] = $this->app->auth()->parent_id;

			$check = $this->repo->changePassword($params);
            return isset($check->parent_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	public function store() 
	{

		$params = $this->app->params();

        try {	

			$validate = $this->validate($params);

			if ($validate) {
				return $validate;
			} 

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
		$params = $this->app->params();

        try {

			$validate = $this->validate($params);

			if ($validate) {
				return $validate;
			} 

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

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['parent_id']);


            if ($this->repo->delete($params['parent_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	
	/**
	*  Validate item store
	*/
	public function validate($params) 
	{
		$check = $this->repo->validateEmail($params['email'], isset($params['parent_id']) ? $params['parent_id'] : 0);

		if (empty($params['first_name']))
			return ['result'=> __('Name required')];

		if (empty($params['email']))
			return ['result'=> __('Email required')];

		if ($check) {
			return ['result'=>$check];
		}
	}


	/**
	 * get Parent
	 */
	public function getParent()
	{
		$this->app = new \config\APP;

		$data =  $this->repo->getParent($this->app->auth()->parent_id);

		echo  json_encode($data);
	}


	/**
	 * get Parent
	 */
	public function checkParent($id)
	{
		$data =  $this->repo->getParent($id);

		echo  json_encode($data);
	}


}