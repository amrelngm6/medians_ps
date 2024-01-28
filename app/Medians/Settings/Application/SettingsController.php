<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\SettingsRepository;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Drivers\Infrastructure\DriverRepository;
use Medians\Trips\Infrastructure\TripRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Locations\Infrastructure\CountryRepository;

class SettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $updated;

	protected $countriesRepo;



	function __construct()
	{
		
		$this->app = new \config\APP;	

		$user = $this->app->auth();

		$this->repo = new SettingsRepository(isset($user->business) ? $user->business : null);
		$this->countriesRepo = new CountryRepository(isset($user->business) ? $user->business : null);

	}

	
	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            
			'Service Area'=> [	
				[ 'key'=> "country", 'title'=> __('Country'), 
					'sortable'=> true, 'column_key'=>'country_id', 'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 
					'data' => $this->countriesRepo->get(),   
					// 'multiple'=>true
				],
			],
			'basic'=> [	
	            [ 'key'=> "logo", 'title'=> __('logo'), 'fillable'=>true, 'column_type'=>'file' ],
				[ 'key'=> "allow_notifications", 'title'=> __('Allow Notifications'), 'fillable'=> true, 'column_type'=>'checkbox' ],
				[ 'key'=> "lang", 'title'=> __('Languange'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['lang'=>'arabic','title'=>__('Arabic')], ['lang'=>'english','title'=>__('English')]]  
				],
			],
			

			'trips'=> [	
				[ 'key'=> "allow_private_trip", 'title'=> __('Allow Private Trips'), 'fillable'=> true, 'column_type'=>'checkbox' ],
				[ 'key'=> "morning_trip", 'title'=> __('Morning trip'), 'fillable'=> true, 'column_type'=>'time' ],
				[ 'key'=> "afternoon_trip", 'title'=> __('Afternoon trip'), 'fillable'=> true, 'column_type'=>'time' ],
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
			'title' => __('Settings'),
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
            	return array('success'=>1, 'result'=>__('Updated'));

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
