<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;
use Medians\Settings\Application\SystemSettingsController;
use Medians\Customers\Infrastructure\ParentRepository;
use Medians\Auth\Application\GoogleService;
use Google_Service_Oauth2;

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
            [ 'value'=> "name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> translate('picture'), 'sortable'=>true ],
            [ 'value'=> "students", 'text'=> translate('Students'), 'sortable'=> true ],
            [ 'value'=> "email", 'text'=> translate('Email'), 'sortable'=> true ],
            [ 'value'=> "gender", 'text'=> translate('Gender'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> translate('Mobile'), 'sortable'=> false ],
			['value'=>'edit', 'text'=>translate('Edit')],
			['value'=>'delete', 'text'=>translate('Delete')],
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
            [ 'key'=> "name", 'title'=> translate('name'), 'sortable'=> true, "required"=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('Email'), 'sortable'=> true, 'fillable'=> true, "required"=> true, 'column_type'=>'email' ],
            [ 'key'=> "mobile", 'title'=> translate('Mobile'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone' ],
			[ 'key'=> "gender", 'title'=> translate('Gender'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
				'data' => [['gender'=>'male','title'=>translate('Male')], ['gender'=>'female','title'=>translate('Female')]]  
			],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'file' ],
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
		        'title' => translate('Parents list'),
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

			
			if ($this->validate($params)) 
				return $this->validate($params);

        	$params['created_by'] = $this->app->auth()->id;
        	$params['business_id'] = $this->app->auth()->business->business_id;
        	
            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
			return array('error'=> $e->getMessage());
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['customer_id']);


            if ($this->repo->delete($params['customer_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
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
			return ['error'=> translate('Name required')];

		if (empty($params['email']))
			return ['error'=> translate('Email required')];

		
		$check = $this->repo->findByEmail($params['email']);

		if ($check)
			return ['error'=> translate('Email found')];
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
			return ['error'=> translate("User credentials not valid")]; 
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
		$params = (array) $this->app->params();
        try {	
			
			$checkEmail = $this->repo->findByEmail($params['email']);
			
			if (isset($checkEmail->email))
				return array('error'=> translate('EMAIL_FOUND'));

            return  (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Password sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
			return array('error'=> $e->getMessage());
        }
	}



	public function resetPassword() 
	{
		$params = (array) $this->app->params();

        try {	

			$check = $this->repo->resetPassword($params);

            return  ($check == 1) 
            ? array('success'=>1, 'result'=>translate('Confirmation code sent through email'), 'reload'=>1)
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
            return isset($check->customer_id)
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function updateMobile()
	{
		$params = $this->app->params();
		$params = is_array($params) ?  $params : (array) json_decode($params);

		$user = $this->app->auth();

        try {

			$params['customer_id'] = $user->customer_id;
            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	public function changePassword()
	{
		$_params = $this->app->params();
		$params = (array) (is_array($_params) ?  $_params : json_decode($_params));

        try {
			
			$params['customer_id'] = $this->app->auth()->customer_id;

			$check = $this->repo->changePassword($params);
            return isset($check->customer_id)
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	
	public function uploadPicture()
	{
		$customer_id = $this->app->request()->get('customer_id');
		$media = new \Medians\Media\Application\MediaController;
		$pictureName =  $media->uploadFile('students');
		$student =  $this->repo->find($customer_id);
		$student->picture = '/uploads/students/'.$pictureName;
		$student->save();
		return  $student->picture;
	} 

	/**
	 * Login with Google from APP 
	 */
	public function loginWithGoogle() 
	{
		$params = (array) $this->app->params();
		
		// Verify the ID token with Google
		$googleApiUrl = 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=' . $params['idToken'];

		$tokenInfo = (object) json_decode(file_get_contents($googleApiUrl), true);

		if (empty($tokenInfo->email))
		{
			return ['error'=> translate('Code is invalid')];
		}

		$customer = $this->repo->findParentByEmail($tokenInfo->email);
		if (empty($customer))
		{
			try {
				$pictureName = rand(999999, 999999).date('Ymdhis').'.jpg';
				$data = ['status'=>'on'];
				$data['name'] = $tokenInfo->name;
				$data['email'] = $tokenInfo->email;
				$data['picture'] = $this->saveImageFromUrl($tokenInfo->picture, '/uploads/customers/'.$pictureName) ;
				$customer = $this->repo->store($data);

			} catch (\Throwable $th) {
				return ['error'=> translate('This email can not be used choose another one')];
			}
		}
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$customer->customer_id);
		$generateToken = $customer->insertCustomField('API_token', $token);
		
		return 
		[
			'success'=>true, 
			'customer_id'=> isset($customer->customer_id) ? $customer->customer_id : null, 
			'token'=>$generateToken->value
		];

	}

	/**
	 * Login with Google from APP 
	 */
	public function loginWithTwitter() 
	{
		$params = (array) $this->app->params();

		$customer = $this->repo->findParentByEmail($params['email']);
		if (empty($customer))
		{
			try {
				$pictureName = rand(999999, 999999).date('Ymdhis').'.jpg';
				$data = ['status'=>'on'];
				$data['name'] = $params['name'];
				$data['email'] = $params['email'];
				$data['picture'] = $this->saveImageFromUrl($params['picture'], '/uploads/customers/'.$pictureName) ;
				$customer = $this->repo->store($data);

			} catch (\Throwable $th) {
				return ['error'=> translate('This email can not be used choose another one')];
			}
		}
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$customer->customer_id);
		$generateToken = $customer->insertCustomField('API_token', $token);
		
		return 
		[
			'success'=>true, 
			'customer_id'=> isset($customer->customer_id) ? $customer->customer_id : null, 
			'token'=>$generateToken->value
		];

	}

	function saveImageFromUrl($url, $localPath) 
	{
		$image = file_get_contents($url);
		if ($image !== false) {
			file_put_contents($_SERVER['DOCUMENT_ROOT']. $localPath, $image);
			return $localPath; 
		}
	}
}