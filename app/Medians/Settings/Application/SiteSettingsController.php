<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure\SystemSettingsRepository;
use Medians\Currencies\Infrastructure\CurrencyRepository;


class SiteSettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;


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
				[ 'key'=> "sitename", 'title'=> translate('sitename'), 'fillable'=> true, 'required'=> true, 'column_type'=>'text' ],
				[ 'key'=> "lang", 'title'=> translate('Languange'), 'help_text'=> translate('The default language for new sessions'),
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['lang'=>'arabic','title'=>translate('Arabic')], ['lang'=>'english','title'=>translate('English')]]  
				],	
			],			
			'pictures'=> [	
				[ 'key'=> "logo", 'title'=> translate('logo'), 'fillable'=>true, 'column_type'=>'file' ],
	            [ 'key'=> "dark_logo", 'title'=> translate('Dark logo'), 'fillable'=>true, 'column_type'=>'file' ],
	            [ 'key'=> "about_picture", 'title'=> translate('About us section picture'), 'help_text', 'fillable'=>true, 'column_type'=>'file' ],
			],			
			'styles'=> [	
				[ 'key'=> "header", 'title'=> translate('Header'), 
					'help_text' => translate('Choose the Header style for Frontend pages'),
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['header'=>'header1','title'=>'Header 1'], ['header'=>'header2','title'=>'Header 2']]  
				],
				[ 'key'=> "footer", 'title'=> translate('Footer'), 
					'help_text' => translate('Choose the footer style for Frontend pages'),
					'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
					'data' => [['footer'=>'footer1','title'=>'Footer 1'], ['footer'=>'footer2','title'=>'Footer 2']]  
				],
			],
			'site_info'=> [	
				[ 'key'=> "footer_email", 'title'=> translate('Email'), 'help_text'=>translate('This email used for view at your frontend footer'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "footer_address", 'title'=> translate('Footer address'), 'fillable'=> true, 'column_type'=>'text' ],
				[ 'key'=> "footer_phone", 'title'=> translate('Footer phone'), 'fillable'=> true, 'column_type'=>'phone' ],
			],
			
			'options'=> [	
				[ 'key'=> "show_newsletter_form", 'title'=> translate('Show newsletter at footer'), 'help_text'=>translate('Show newsletter form at footer to allow users to subscribe'), 'fillable'=> true, 'column_type'=>'checkbox' ],
			],
					
        ];
	}

	/**
	 * Index settings page
	 * 
	 */
	public function index()
	{
		return render('menu_builder', [
		        'load_vue' => true,
		        'setting' => $this->getAll(),
		        'fillable' => $this->fillable(),
	        	'title' => translate('Site_Settings'),
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
