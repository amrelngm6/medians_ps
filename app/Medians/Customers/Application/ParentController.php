<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure\ParentRepository;

class ParentController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	function __construct()
	{

		$this->app = new \config\APP;

		$user = $this->app->auth();

		$this->repo = new ParentRepository(isset($user->business) ? $user->business : null);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "customer_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> __('Name'), 'sortable'=> true ],
            [ 'value'=> "students", 'text'=> __('Students'), 'sortable'=> true ],
            [ 'value'=> "email", 'text'=> __('Email'), 'sortable'=> true ],
            [ 'value'=> "gender", 'text'=> __('Gender'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> __('Mobile'), 'sortable'=> false ],
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
            [ 'key'=> "customer_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "name", 'title'=> __('name'), 'sortable'=> true, "required"=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('Email'), 'sortable'=> true, 'fillable'=> true, "required"=> true, 'column_type'=>'email' ],
            [ 'key'=> "mobile", 'title'=> __('Mobile'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone' ],
			[ 'key'=> "gender", 'title'=> __('Gender'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
				'data' => [['gender'=>'male','title'=>__('Male')], ['gender'=>'female','title'=>__('Female')]]  
			],
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


	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

			
			if ($this->validate($params)) 
				return $this->validate($params);

        	$params['created_by'] = $this->app->auth()->id;
        	$params['business_id'] = $this->app->auth()->business->business_id;
        	
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
			return array('error'=> $e->getMessage());
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['customer_id']);


            if ($this->repo->delete($params['customer_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	/**
	 * get Parent
	 */
	public function getParent()
	{
		$this->app = new \config\APP;

		$data =  $this->repo->getParent($this->app->auth()->customer_id);

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



	
	/**
	*  Validate item store
	*/
	public function validate($params) 
	{

		if (empty($params['name']))
			return ['error'=> __('Name required')];

		if (empty($params['email']))
			return ['error'=> __('Email required')];

		
		$check = $this->repo->findByEmail($params['email']);

		if ($check)
			return ['error'=> __('Email found')];
	}

	

	/**
	 * Parent Login through Mobile API
	 */
	public function login()
	{
		$Auth = new \Medians\Auth\Application\AuthService;
		$repo = new \Medians\Customers\Infrastructure\ParentRepository(null);

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->customer_id)) {
			return ['error'=> __("User credentials not valid")]; 
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->customer_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		return 
		[
			'success'=>true, 
			'customer_id'=> isset($checkLogin->customer_id) ? $checkLogin->customer_id : null, 
			'token'=>$generateToken->value
		];
	}  



	public function signup() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));
        try {	
			
			$checkEmail = $this->repo->findByEmail($params['email']);
			
			if (isset($checkEmail->email))
				return array('error'=> __('EMAIL_FOUND'));

            return  (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Password sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
			return array('error'=> $e->getMessage());
        }
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
            return isset($check->customer_id)
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
			
			$params['customer_id'] = $this->app->auth()->customer_id;

			$check = $this->repo->changePassword($params);
            return isset($check->customer_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

}