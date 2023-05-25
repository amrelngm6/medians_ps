<?php

namespace Medians\Branches\Application;

use Medians\Branches\Infrastructure\BranchRepository;


class BranchController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	public $app;


	function __construct()
	{
		
		$this->repo = new BranchRepository();
	}



	/**
	 * Index page
	 * 
	 */
	public function index()
	{

		return render('branches', [

			'load_vue' => true,
			// 'columns' => $this->columns(),
			'items' => $this->getData(),
	        'title' => __('branches'),
	    ]);
	} 

	/**
	 * Index page
	 * 
	 */
	public function getData()
	{
		$this->app = new \config\APP;

		return ($this->app->auth()->role_id == 1) ? $this->repo->get() : $this->repo->find($this->app->branch->id);
	} 
	


}
