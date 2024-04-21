<?php
namespace Medians\Drivers\Application;

use Shared\dbaser\CustomController;

use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Users\Infrastructure\UserRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Wallets\Infrastructure\WithdrawalRepository;
use Medians\Wallets\Infrastructure\WalletRepository;
use Medians\Invoices\Infrastructure\InvoiceRepository;
use Medians\Trips\Infrastructure\PrivateTripRepository;
use Medians\Trips\Infrastructure\TripRepository;
use Medians\Routes\Infrastructure\RouteRepository;

class DriverController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $userRepo;

	protected $vehicleRepo;
	

	function __construct()
	{
		$this->app = new \config\APP;

		$user = $this->app->auth();

		$this->userRepo = new UserRepository();
		$this->repo = new DriverRepository(isset($user->business) ? $user->business : null);
		$this->vehicleRepo = new VehicleRepository(isset($user->business) ? $user->business : null);
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
            [ 'key'=> "mobile", 'title'=> __('mobile'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone', 'required'=>true ],
            [ 'key'=> "driver_license_number", 'title'=> __('driver_license_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "vehicle_id", 'title'=> __('Vehicle'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'vehicle_id', 'text_key'=>'vehicle_name', 
				'data' => $this->vehicleRepo->get()
			],
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

	
	/**
	 * Index page
	 * 
	 */
	public function profile()
	{
				
		$user = $this->app->auth();

		$driver = $this->repo->find($this->app->request()->get('driver_id'));
		
		if (empty($driver))
		{
			return null;
		}

		$invoicesRepo = new InvoiceRepository($user->business);
		$WalletRepo = new WalletRepository();
		$WithdrawalRepo = new WithdrawalRepository($user->business);

		return render('profile', [
			'load_vue'=> true,
			'title' => __('Driver profile'),
			'driver' =>   $driver,
			'stats' => $this->getStats($user->business, $driver),
			'overview' => $this->overview($driver),
			'fillable' => $this->fillable(),
			'invoices' => $invoicesRepo->getUserInvoices($user->id),
			'wallet' => isset($user->business) ? $businessWalletRepo->getBusinessWallet($user->business->business_id) : null,
			'business_withdrawals' => isset($user->business) ? $businessWithdrawalRepo->getBusinessWithdrawals($user->business->business_id) : null,
		]);

	} 


	public function getStats($driver, $business) 
	{	

		$data = [];

		$tripsRepo = new TripRepository($business);
        $data['trips_count'] = count($tripsRepo->getDriverTrips($driver));
		$tripsRepo = new PrivateTripRepository($business);
        $data['trips_count'] = count($tripsRepo->get(null));

		return $data;
	}

	

	/**
	 * Columns list to view in Overview page 
	 * for Driver Profile page
	 */ 
	public function overview( $driver) 
	{
		return [
            [ 'key'=> $driver->driver_id, 'title'=> __('id') ],
            [ 'key'=> $driver->first_name, 'title'=> __('first_name'),  ],
            [ 'key'=> $driver->last_name, 'title'=> __('last_name'),  ],
            [ 'key'=> $driver->email, 'title'=> __('email')   ],
            [ 'key'=> $driver->mobile, 'title'=> __('mobile')  ],
            [ 'key'=> $driver->status ? 'Yes' : 'No', 'title'=> __('status') ],
        ];
	}

	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

			if ($this->validate($params)) 
				return $this->validate($params);

			$user = $this->app->auth();
			$params['business_id'] = $user->business->business_id;
        	$params['created_by'] = $user->id;
        	
			try {
				
				return (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
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
		
		$params = $this->app->request()->get('params');
		$params = (array)   is_array($params) ?  $params : json_decode($params);

        try {

        	$params['status'] = !empty($params['status']) ? 'on' : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
        }
	}


	public function updateMobile()
	{
		$params = json_decode($this->app->request()->get('params'));

        try {

            if ($this->repo->update((array) $params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
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
			
        } catch (\Exception $e) {
        	throw new \Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
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
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

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

	/**
	 * Driver signup through Mobile API
	 */
	public function signup()
	{
		try {

			$Auth = new \Medians\Auth\Application\AuthService;
			$this->app = new \config\APP;
			$request = $this->app->request();
			
			$params = (array) json_decode($request->get('params'));		
			
			if ($this->validate($params)) 
				return $this->validate($params);

			$checkLogin = $this->repo->signup($params);
			
			return 
			[
				'success'=>true, 
				'result'=> isset($checkLogin->driver_id) ? __('Password sent through email') : __('Error'), 
			];

		} catch (\Exception $e) {
			return ['error' => $e->getMessage()];
		}
	}  



	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {


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

		if (empty($params['first_name']))
			return ['error'=> __('Name required')];

		if (empty($params['email']))
			return ['error'=> __('Email required')];

		
		$check = $this->repo->validateEmail($params['email'], isset($params['driver_id']) ? $params['driver_id'] : 0);

		if ($check)
			return ['error'=>$check];
	}


	/**
	 * get Driver
	 */
	public function getDriver($id)
	{
		return    $this->repo->find($id);
	}


	public function changePassword()
	{
		$_params = $this->app->request()->get('params');
		$params = (array) (is_array($_params) ?  $_params : json_decode($_params));

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
		$_params = $this->app->request()->get('params');
		$params = (array) (is_array($_params) ?  $_params : json_decode($_params));

        try {
			
			$check = $this->repo->resetChangePassword($params);
            return isset($check->driver_id)
			 ? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
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