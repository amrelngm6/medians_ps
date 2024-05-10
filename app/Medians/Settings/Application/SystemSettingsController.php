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
	 * Index settings page
	 * 
	 */
	public function index()
	{

		return render('system_settings', [
		        'load_vue' => true,
		        'setting' => $this->getAll(),
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

		$params = $this->app->params();

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

		$data = [
			'created_by' => $this->app->auth()->id,
			'code' => $code,
			'value' => $value
		];

		return $this->repo->store($data);

	}


	public function deleteItem($code) 
	{
		$this->repo->delete($code);

		return $this;
	}


}
