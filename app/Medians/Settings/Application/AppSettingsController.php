<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\AppSettingsRepository;


class AppSettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;
	
	public $updated = true;



	function __construct()
	{
		
		$this->app = new \config\APP;

		$this->repo = new AppSettingsRepository();

	}

	
	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            
			'basic'=> [	
	            [ 'key'=> "logo", 'title'=> __('logo'), 'fillable'=>true, 'column_type'=>'file' ],
				[ 'key'=> "app_name", 'title'=> __('App Name'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "default_lang", 'title'=> __('Languange'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['default_lang'=>'arabic','title'=>__('Arabic')], ['default_lang'=>'english','title'=>__('English')]]  
				]
			],
			'Header'=> [
	            [ 'key'=> "header_bg", 'title'=> __('Header background'), 'fillable'=>true, 'column_type'=>'file' ],
			],
			'Style colors'=> [	
				[ 'key'=> "section_bg", 'title'=> __('Section BG Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "border_color", 'title'=> __('Border Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "icon_color", 'title'=> __('Icon Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "text_color", 'title'=> __('Text Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h1_color", 'title'=> __('H! Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h2_color", 'title'=> __('H2 Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h3_color", 'title'=> __('H3 Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h4_color", 'title'=> __('H4 Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h5_color", 'title'=> __('H5 Color'), 'fillable'=> true, 'column_type'=>'color' ],
				[ 'key'=> "h6_color", 'title'=> __('H6 Color'), 'fillable'=> true, 'column_type'=>'color' ],
            ],
        ];
	}


	/**
	 * Index settings page
	 * 
	 */
	public function index()
	{
		return render('app_settings', [
            'load_vue' => true,
            'app_type' => 'Driver',
            'app_setting' => $this->getAll('Driver'),
            'fillable' => $this->fillable(),
            'title' => __('Driver app Settings'),
	    ]);
	} 

    /**
     * Get APP Settings 
     */    
	public function getAll($app) 
	{	
		$data = $this->repo->getAll($app);

		return $data ? array_column(json_decode($data), 'value', 'code') :  [];
	}

    /**
     * Load APP Settings 
     */    
	public function loadSetting() 
	{	
		$app = $this->app->request()->headers->get('userType');
		 
		return $this->getAll($app ? $app : 'driver');
	}


	/**
	* Return the Settings
	*/
	public function update() 
	{

		$params = $this->app->request()->get('params');
		$targetApp = $this->app->request()->get('app');

		try {

            $update = $this->updateSettings($targetApp, $params);

            if (isset($update->updated)) 
            	return array('success'=>1, 'result'=>__('Updated'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	* Return the Settings
	*/
	public function updateSettings($targetApp, $params) 
	{
		try {
			
			foreach ($params as $code => $value)
			{
				$this->deleteItem($targetApp, $code)->saveItem($targetApp, $code, $value);
			}

			$this->updated = true;
			
			return $this;

		} catch (Exception $e) {
            return  array('error'=>$e->getMessage());
		}
	}



	public function saveItem($targetApp, $code, $value) 
	{
		$data = [
			'created_by' => $this->app->auth()->id,
			'app' => $targetApp,
			'code' => $code,
			'value' => $value
		];

		return $this->repo->store($data);

	}


	public function deleteItem($targetApp, $code) 
	{
		$this->repo->delete($targetApp, $code);

		return $this;
	}


}
