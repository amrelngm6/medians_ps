<?php
namespace Medians\Drivers\Application;

use Shared\dbaser\CustomController;

use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Users\Infrastructure\UserRepository;
use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Wallets\Infrastructure\WithdrawalRepository;
use Medians\Wallets\Infrastructure\WalletRepository;
use Medians\Wallets\Infrastructure\CollectedCashRepository;
use Medians\Invoices\Infrastructure\InvoiceRepository;
use Medians\Trips\Infrastructure\TaxiTripRepository;
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
			[ 'key'=> "first_name", 'title'=> translate('first_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' , 'required'=>true ],
            [ 'key'=> "last_name", 'title'=> translate('last_name'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'email', 'required'=>true ],
            [ 'key'=> "mobile", 'title'=> translate('mobile'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone', 'required'=>true ],
            [ 'key'=> "driver_license_number", 'title'=> translate('driver_license_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "vehicle_id", 'title'=> translate('Vehicle'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'vehicle_id', 'text_key'=>'vehicle_name', 
				'data' => $this->vehicleRepo->get()
			],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=> true, 'column_type'=>'file' ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
		        'title' => translate('Drivers'),
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
		$collectCashRepo = new CollectedCashRepository($user->business);
		$tripsRepo = new TripRepository($user->business);
		$taxiTripsRepo = new TaxiTripRepository($user->business);
		$wallet = $WalletRepo->driverWallet($driver->driver_id);

		return render('driver_page', [
			'load_vue'=> true,
			'title' => translate('Driver profile'),
			'driver' =>   $driver,
			'stats' => $this->getStats($driver, $user->business),
			'overview' => $this->overview($driver),
			'fillable' => $this->fillable(),
			'collected_cash' => isset($wallet->wallet_id) ? $collectCashRepo->getCollectedCash($wallet->wallet_id) : [],
			'invoices' => $invoicesRepo->getUserInvoices($user->id),
			'wallet' => $wallet,
			'withdrawals' => $WithdrawalRepo->getDriverWithdrawals($driver->driver_id),
			'trips' => $tripsRepo->getDriverTrips($driver->driver_id, 10),
			'taxi_trips' => $taxiTripsRepo->getDriverTaxiTrips($driver->driver_id, 10),
		]);

	} 


	public function getStats($driver, $business) 
	{	

		$data = [];

		$tripsRepo = new TripRepository($business);
        $data['trips_count'] = count($tripsRepo->getDriverTrips($driver->driver_id, 999999));
		$taxiTripsRepo = new TaxiTripRepository($business);
        $data['taxi_trips_count'] = count($taxiTripsRepo->getDriverTaxiTrips($driver->driver_id, 999999));

		return $data;
	}

	

	/**
	 * Columns list to view in Overview page 
	 * for Driver Profile page
	 */ 
	public function overview( $driver) 
	{
		return [
            [ 'key'=> $driver->driver_id, 'title'=> translate('id') ],
            [ 'key'=> $driver->first_name, 'title'=> translate('first_name'),  ],
            [ 'key'=> $driver->last_name, 'title'=> translate('last_name'),  ],
            [ 'key'=> $driver->email, 'title'=> translate('email')   ],
            [ 'key'=> $driver->mobile, 'title'=> translate('mobile')  ],
            [ 'key'=> $driver->status ? 'Yes' : 'No', 'title'=> translate('status') ],
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
		
		$params = $this->app->request()->get('params');
		$params = (array)   is_array($params) ?  $params : json_decode($params);

        try {

        	$params['status'] = !empty($params['status']) ? 'on' : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
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
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
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
            ? array('success'=>1, 'result'=>translate('Confirmation code sent through email'), 'reload'=>1)
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
			return ['error'=> translate("User credentials not valid")]; return null;
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->driver_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		$update = $checkLogin->update(['last_login'=>getenv("REMOTE_ADDR")]);

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
				'result'=> isset($checkLogin->driver_id) ? translate('Password sent through email') : translate('Error'), 
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
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
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
			return ['error'=> translate('Name required')];

		if (empty($params['email']))
			return ['error'=> translate('Email required')];

		
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
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

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
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

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

	
	/**
	 * Login with Google from APP 
	 */
	public function loginWithGoogle() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		// Verify the ID token with Google
		$googleApiUrl = 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=' . $params['idToken'];

		$tokenInfo = (object) json_decode(file_get_contents($googleApiUrl), true);

		if (empty($tokenInfo->email))
		{
			return ['error'=> translate('Code is invalid')];
		}

		$driver = $this->repo->findByEmail($tokenInfo->email);
		if (empty($driver))
		{
			try {
				$pictureName = rand(999999, 999999).date('Ymdhis').'.jpg';
				$data = ['status'=>'on'];
				$data['first_name'] = $tokenInfo->given_name;
				$data['last_name'] = $tokenInfo->family_name;
				$data['email'] = $tokenInfo->email;
				$data['picture'] = $this->saveImageFromUrl($tokenInfo->picture, '/uploads/customers/'.$pictureName) ;
				$driver = $this->repo->signup($data);

			} catch (\Throwable $th) {
				return ['error'=> translate('This email can not be used choose another one')];
			}
		}
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$driver->driver_id);
		$generateToken = $driver->insertCustomField('API_token', $token);
		
		$update = $driver->update(['last_login'=>getenv("REMOTE_ADDR")]);
		
		return 
		[
			'success'=>true, 
			'driver_id'=> isset($driver->driver_id) ? $driver->driver_id : null, 
			'token'=>$generateToken->value
		];
	}

	
	/**
	 * Login with Google from APP 
	 */
	public function loginWithTwitter() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));
		
		$driver = $this->repo->findByEmail($params['email']);
		if (empty($driver))
		{
			try {
				
				$pictureName = rand(999999, 999999).date('Ymdhis').'.jpg';
				$data = ['status'=>'on'];
				$data['first_name'] = $params['name'];
				$data['email'] = $params['email'];
				$data['picture'] = $this->saveImageFromUrl($params['picture'], '/uploads/drivers/'.$pictureName) ;
				$driver = $this->repo->signup($data);


			} catch (\Throwable $th) {
				return ['error'=> translate('This email can not be used choose another one')];
			}
		}
		
		$Auth = new \Medians\Auth\Application\AuthService;
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$driver->driver_id);
		$generateToken = $driver->insertCustomField('API_token', $token);
		
		$update = $driver->update(['last_login'=>getenv("REMOTE_ADDR")]);
		
		return 
		[
			'success'=>true, 
			'driver_id'=> isset($driver->driver_id) ? $driver->driver_id : null, 
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