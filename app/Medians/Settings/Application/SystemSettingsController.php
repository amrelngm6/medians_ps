<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\SystemSettingsRepository;
use Medians\Currencies\Infrastructure\CurrencyRepository;


class SystemSettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $currencyRepo;
	
	public $updated = true;



	function __construct()
	{
		
		$this->app = new \config\APP;

		$this->repo = new SystemSettingsRepository();
		$this->currencyRepo = new CurrencyRepository();

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
				[ 'key'=> "sitename", 'title'=> translate('sitename'), 'fillable'=> true, 'required'=> true, 'column_type'=>'text' ],
				[ 'key'=> "lang", 'title'=> translate('Languange'), 'help_text'=> translate('The default language for new sessions'),
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['lang'=>'arabic','title'=>translate('Arabic')], ['lang'=>'english','title'=>translate('English')]]  
				],	
			],			
			'currency'=> [	
				[ 'key'=> "currency", 'title'=> translate('Currency'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 'column_key'=> 'code',
					'data' => $this->currencyRepo->get()  
				],
				[ 'key'=> "currency_converter_api", 'title'=> translate('Currency converter API'), 'fillable'=> true, 'required'=> true, 'column_type'=>'text' ],
			],
			
			'wallets'=> [	
				[ 'key'=> "comission_free_plan", 'help_text'=> translate('SETTING_COMMISSION_NOTE'), 'title'=> translate('Commission for free plan subscribers'), 'fillable'=> true, 'column_type'=>'number' ],
				[ 'key'=> "comission_paid_plan", 'help_text'=>translate('SETTING_COMMISSION_NOTE'), 'title'=> translate('Commission for paid subscribers'), 'fillable'=> true, 'column_type'=>'number' ],
			],
			
			'site_info'=> [	
				[ 'key'=> "footer_email", 'title'=> translate('Footer email'), 'fillable'=> true, 'column_type'=>'email' ],
				[ 'key'=> "footer_address", 'title'=> translate('Footer address'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "footer_phone", 'title'=> translate('Footer phone'), 'fillable'=> true, 'column_type'=>'phone' ],
			],
			'smtp'=> [	
				[ 'key'=> "smtp_sender", 'title'=> translate('smtp_sender'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_user", 'title'=> translate('SMTP_USER'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_password", 'title'=> translate('smtp_password'), 'fillable'=> true, 'column_type'=>'password' ],
				[ 'key'=> "smtp_host", 'title'=> translate('smtp_host'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "smtp_port", 'title'=> translate('smtp_port'), 'fillable'=> true, 'column_type'=>'number' ],
				[ 'key'=> "smtp_auth", 'title'=> translate('smtp_auth'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['smtp_auth'=>'1','title'=>"True"], ['smtp_auth'=>'0','title'=>"False"]]  
				],
			],
			
			'one_signal'=> [	
				[ 'key'=> "onesignal_app_id", 'title'=> translate('OneSingal APP ID'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "onesignal_app_key_token", 'title'=> translate('OneSingal API Key Token'), 'fillable'=> true, 'column_type'=>'text' ],
			],
			
			'google'=> [	
				[ 'key'=> "allow_google_login", 'title'=> translate('Login with Google'), 'help_text'=>translate('Allow users to signup with Gmail'), 'fillable'=> true, 'column_type'=>'checkbox' ],
				[ 'key'=> "google_client_id", 'title'=> translate('Google Client ID'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "google_client_secret", 'title'=> translate('Google Client secret'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "google_map_api", 'title'=> translate('Google Map API'), 'help_text'=>translate('Used for maps'),'fillable'=> true, 'column_type'=>'text' ],
			],
			
			'twitter'=> [	
				[ 'key'=> "allow_twitter_login", 'title'=> translate('Login with Twitter'), 'help_text'=>translate('Allow users to signup with Twitter ( X ) account'), 'fillable'=> true, 'column_type'=>'checkbox' ],
				[ 'key'=> "twitter_api_key", 'title'=> translate('Twitter API Key'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "twitter_client_secret", 'title'=> translate('Twitter Client secret'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "twitter_redirect_link", 'title'=> translate('Twitter Redirect callback'), 'help_text'=> translate('Redirect should be scheme like (mediansparents://)'), 'fillable'=> true, 'column_type'=>'text' ],
			],
			
			'paypal'=> [	
				[ 'key'=> "paypal_api_key", 'title'=> translate('PayPal API Key'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "paypal_api_secret", 'title'=> translate('PayPal API Secret'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "paypal_mode", 'title'=> translate('PayPal mode'), 
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['paypal_mode'=>'live','title'=>'Live'], ['paypal_mode'=>'sandbox','title'=>'Sandbox']]  
				],
			],
			'paystack'=> [
				[ 'key'=> "paystack_secret_key", 'title'=> translate('PayStack secret key'), 'help_text'=>translate('Get your Live / Test code from PayStack https://dashboard.paystack.com/#/settings/developers'), 'fillable'=> true, 'column_type'=>'text' ],
			],
			// 'stripe'=> [	
			// 	[ 'key'=> "stripe_publish_key", 'title'=> translate('Stripe publishable key'), 'fillable'=> true, 'column_type'=>'text' ],
			// 	[ 'key'=> "stripe_live_key", 'title'=> translate('Stripe live key'), 'fillable'=> true, 'column_type'=>'text' ],
			// 	[ 'key'=> "stripe_mode", 'title'=> translate('Stripe mode'), 
			// 		'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
			// 		'data' => [['stripe_mode'=>'live','title'=>'Live'], ['stripe_mode'=>'sandbox','title'=>'Sandbox']]  
			// 	],
			// ],
			
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
		        'currency' => $this->currency(),
		        'fillable' => $this->fillable(),
	        	'title' => translate('System_Settings'),
	    ]);
	} 



	public function getItem($code = null) 
	{	
		return $this->repo->getByCode($code);
	}


	public function getAll() 
	{	
		$data = $this->repo->getAll();
		$output = $data ? array_column(json_decode($data), 'value', 'code') :  [];
		$_SESSION['currency'] = $output['currency'];
		return $output;
	}

	public function currency() 
	{	
		return $this->currencyRepo->load($_SESSION['currency']);
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
				'value' => $v
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
