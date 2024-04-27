<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\SettingsRepository;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Trips\Infrastructure\TripRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Locations\Infrastructure\CountryRepository;
use Medians\Locations\Infrastructure\CityRepository;

class SettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $updated;

	protected $countriesRepo;

	protected $citiesRepo;



	function __construct()
	{
		
		$this->app = new \config\APP;	

		$user = $this->app->auth();

		$this->repo = new SettingsRepository(isset($user->business) ? $user->business : null);
		$this->countriesRepo = new CountryRepository(isset($user->business) ? $user->business : null);
		$this->citiesRepo = new CityRepository(isset($user->business) ? $user->business : null);

	}

	
	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            
			'basic'=> [	
	            [ 'key'=> "logo", 'title'=> translate('logo'), 'fillable'=>true, 'column_type'=>'file' ],
				[ 'key'=> "allow_notifications", 'title'=> translate('Allow Notifications'), 'fillable'=> true, 'column_type'=>'checkbox' ],
				[ 'key'=> "lang", 'title'=> translate('Languange'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['lang'=>'arabic','title'=>translate('Arabic')], ['lang'=>'english','title'=>translate('English')]]  
				],
			],
			
			'information'=> [	
				[ 'key'=> "email", 'title'=> translate('Email'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "address", 'title'=> translate('Address'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "mobile", 'title'=> translate('mobile'), 'fillable'=> true, 'column_type'=>'number' ],
				[ 'key'=> "phone", 'title'=> translate('phone'), 'fillable'=> true, 'column_type'=>'number' ],
			],

			'trips'=> [	
				[ 'key'=> "allow_private_trip", 'title'=> translate('Allow Private Trips'), 'fillable'=> true, 'column_type'=>'checkbox' ],
			],

			'drivers'=> [	
				[ 'key'=> "speed_limit", 'title'=> translate('Driver speed limit'), 'help_text'=> translate('Once the driver cross this speed limit, he will get alarm to slow down'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "allow_applicants", 'title'=> translate('Allow Driver Applicants'), 'help_text'=> translate('Allow the drivers to apply at your profile to join your team'),  'fillable'=> true, 'column_type'=>'checkbox' ],
			],
			
        ];
	}


	/**
	 * Index settings page
	 * 
	 */
	public function index()
	{
		$user = $this->app->auth();
		$settings = $this->getAll();

		return render('settings', [
			'load_vue' => true,
			'business_setting' => $settings,
            'stats' => $this->getStats($user->business),
			'fillable' => $this->fillable(),
			'business_fillable' => $this->business_fillable(),
			'title' => translate('Settings'),
	    ]);
	} 


	
	public function business_fillable()
	{
		$business = new \Medians\Businesses\Application\BusinessController();

		return $business->fillable();

	} 

	public function getStats($business) 
	{	

		$data = [];

        $driverRepo = new DriverRepository($business);
        $data['drivers_count'] = count($driverRepo->get(null));
        $vehicleRepo = new VehicleRepository($business);
        $data['vehicles_count'] = count($vehicleRepo->get(null));
        $routesRepo = new RouteRepository($business);
        $data['routes_count'] = count($routesRepo->get(null));
		$tripsRepo = new TripRepository($business);
        $data['trips_count'] = count($tripsRepo->get(null));

		return $data;
	}


	public function getItem($code = null) 
	{	
		return $this->repo->getByCode($code);
	}


	public function getAll() 
	{	
		$data = $this->repo->getAll();
		return $data ? array_column(json_decode($data), 'value', 'code') :  [];
	}


	/**
	* Return the Settings
	*/
	public function update() 
	{

		$params = $this->app->request()->get('params');
		
		try {

            if (isset($this->updateSettings($params)->updated)) 
            	return array('success'=>1, 'result'=>translate('Updated'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	* Return the Settings
	*/
	public function updateSettings($params) 
	{

		foreach ($params as $code => $value)
		{

			$this->deleteItem($code);
			$this->saveItem($code, $value);
		}

		$this->updated = true;
		
		return $this;
	}



	public function saveItemArray($code, $value) 
	{
		$this->deleteItem($code);

		foreach ($value as $k => $v) 
		{
			$this->repo->store($this->setObject($code, $v));
		}
	}

	public function saveItem($code, $value) 
	{
		
		if (is_array($value))
			return $this->saveItemArray($code, $value);
		
		return $this->repo->store($this->setObject($code, $value));

	}

	public function setObject($code, $value)
	{
		
		$user = $this->app->auth();

		return [
			'created_by' => $user->id,
			'model' => '',
			'code' => $code,
			'business_id' => $user->business->business_id,
			'value' => $value
		];
		
	}

	public function deleteItem($code) 
	{

		return $this->repo->delete($code);
	}


}
