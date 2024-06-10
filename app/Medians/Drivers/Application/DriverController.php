<?php
namespace Medians\Drivers\Application;

use Shared\dbaser\CustomController;

use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Users\Infrastructure\UserRepository;

class DriverController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $userRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new DriverRepository();
		$this->userRepo = new UserRepository();
	}





	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "driver_id", 'title'=> "#", 'fillable'=>true, 'column_type'=>'hidden'],
			[ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' , 'required'=>true ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'email', 'required'=>true ],
            [ 'key'=> "contact_number", 'title'=> __('contact_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone', 'required'=>true ],
            [ 'key'=> "driver_license_number", 'title'=> __('driver_license_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "vehicle_plate_number", 'title'=> __('vehicle_plate_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=> true, 'column_type'=>'file' ],
            [ 'key'=> "status", 'title'=> __('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
			
		    return render('drivers', [
		        'load_vue' => true,
		        'title' => __('Drivers'),
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
		

		$params = (array) $this->app->params();

        try {

			$validate = $this->validate($params);

			if ($validate) {
				return $validate;
			} 

			$params['status'] = !empty($params['status']) ? 1 : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

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
	 * Driver Login through Mobile API
	 */
	public function login()
	{
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$this->app = new \config\APP;
		$params = $this->app->params();
		
		$checkLogin = $this->repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->driver_id)) {
			return ['error'=> __("User credentials not valid")]; return null;
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->driver_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		return 
		[
			'success'=>true, 
			'driver_id'=> isset($checkLogin->driver_id) ? $checkLogin->driver_id : null, 
			'token'=>$generateToken->value
		];
	}  



	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['driver_id']);


            if ($this->repo->delete($params['driver_id']))
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
		if (isset($params['picture']))
		{

			$check = $this->repo->validateEmail($params['email'], isset($params['driver_id']) ? $params['driver_id'] : 0);

			if (empty($params['first_name']))
				return ['result'=> __('Name required')];

			if (empty($params['email']))
				return ['result'=> __('Email required')];

			if ($check) {
				return ['result'=>$check];
			}
		}

	}


	/**
	 * get Driver
	 */
	public function getDriver($id)
	{
		$data =  $this->repo->getDriver($id);

		echo  json_encode($data);
	}


	public function changePassword()
	{
		$params = (array) $this->app->params();

        try {
			
			$params['driver_id'] = $this->app->auth()->driver_id;

			$check = $this->repo->changePassword($params);
            return isset($check->driver_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function resetChangePassword()
	{
		$params = (array) $this->app->params();

        try {
			
			$check = $this->repo->resetChangePassword($params);
            return isset($check->driver_id)
			 ? array('success'=>1, 'result'=>__('Password Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>__('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	/**
	 * Upload driver picture
	 */
	public function uploadPicture()
	{

		$media = new \Medians\Media\Application\MediaController;
		$pictureName =  $media->uploadFile('drivers');
		if ($pictureName)
		{
			$driver =  $this->repo->findByToken($_POST['token']);
			$driver->picture = '/uploads/drivers/'.$pictureName;
			$driver->save();
			return  $driver->picture;
		}
	} 
}