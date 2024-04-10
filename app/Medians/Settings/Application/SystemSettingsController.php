<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\SystemSettingsRepository;


class SystemSettingsController extends CustomController
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

		$this->repo = new SystemSettingsRepository();

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
				[ 'key'=> "sitename", 'title'=> __('sitename'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "lang", 'title'=> __('Languange'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['lang'=>'arabic','title'=>__('Arabic')], ['lang'=>'english','title'=>__('English')]]  
				],
			],
			'site_setting'=> [	
				[ 'key'=> "footer_email", 'title'=> __('Footer email'), 'fillable'=> true, 'column_type'=>'email' ],
				[ 'key'=> "footer_address", 'title'=> __('Footer address'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "footer_phone", 'title'=> __('Footer phone'), 'fillable'=> true, 'column_type'=>'phone' ],
			],
			'smtp'=> [	
				[ 'key'=> "smtp_sender", 'title'=> __('smtp_sender'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_user", 'title'=> __('SMTP_USER'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_password", 'title'=> __('smtp_password'), 'fillable'=> true, 'column_type'=>'password' ],
				[ 'key'=> "smtp_host", 'title'=> __('smtp_host'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_port", 'title'=> __('smtp_port'), 'fillable'=> true, 'column_type'=>'number' ],
				[ 'key'=> "smtp_auth", 'title'=> __('smtp_auth'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['smtp_auth'=>'1','title'=>"True"], ['smtp_auth'=>'0','title'=>"False"]]  
				],
			],
			
			'one_signal'=> [	
				[ 'key'=> "onesignal_app_id", 'title'=> __('OneSingal APP ID'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "onesignal_app_key_token", 'title'=> __('OneSingal API Key Token'), 'fillable'=> true, 'column_type'=>'text' ],
			],
			
			'google'=> [	
				[ 'key'=> "google_client_id", 'title'=> __('Google Client ID'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "google_client_secret", 'title'=> __('Google Client secret'), 'fillable'=> true, 'column_type'=>'text' ],
			],
			
			'paypal'=> [	
				[ 'key'=> "paypal_api_key", 'title'=> __('PayPal API Key'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "paypal_api_secret", 'title'=> __('PayPal API Secret'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "mode", 'title'=> __('PayPal mode'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['mode'=>'live','title'=>'Live'], ['mode'=>'sandbox','title'=>'Sandbox']]  
				],
			],
			
			'map'=> [	
				[ 'key'=> "google_map_api", 'title'=> __('Google Map API'), 'fillable'=> true, 'column_type'=>'text' ],
			],
        ];
	}

	/**
	 * Index settings page
	 * 
	 */
	public function index()
	{
		return render('system_settings', [
		        'load_vue' => true,
		        'setting' => $this->getAll(),
		        'fillable' => $this->fillable(),
	        	'title' => __('System_Settings'),
	    ]);
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
		try {
			
			foreach ($params as $code => $value)
			{
				$this->deleteItem($code)->saveItem($code, $value);
			}

			$this->updated = true;
			
			return $this;

		} catch (Exception $e) {
            return  array('error'=>$e->getMessage());
		}
	}




	public function saveItem($code, $value) 
	{
		if (is_array($value))
			return $this->saveItemArray($code, $value);
		
		$data = [
			'created_by' => $this->app->auth()->id,
			'code' => $code,
			'value' => $value
		];

		return $this->repo->store($data);

	}


	public function saveItemArray($code, $value) 
	{
		foreach ($value as $k => $v) 
		{
			$data = [
				'created_by' => $this->app->auth()->id,
				'code' => $code,
				'value' => $value
			];
			
			$this->repo->store($data);
		}
	}


	public function deleteItem($code) 
	{
		$this->repo->delete($code);

		return $this;
	}


}
