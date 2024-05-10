<?php

namespace Medians\Settings\Application;
use \Shared\dbaser\CustomController;

use Medians\Settings\Infrastructure as Repo;


class SettingsController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $updated;



	function __construct()
	{
		
		$this->app = new \config\APP;

		$this->repo = new Repo\SettingsRepository();

	}

	/**
	 * Index settings page
	 * 
	 */
	public function index()
	{

		return render('settings', [
		        'load_vue' => true,
		        'setting' => $this->getAll(),
	        	'title' => __('Settings'),
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

		$params = $this->app->params()['settings'];

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




	public function saveItem($code, $value) 
	{

		$data = [
			'created_by' => $this->app->auth()->id,
			'model' => '',
			'code' => $code,
			'value' => $value
		];

		return $this->repo->store($data);

	}


	public function deleteItem($code) 
	{

		return $this->repo->delete($code);
	}


}
