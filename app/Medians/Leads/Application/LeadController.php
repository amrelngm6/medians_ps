<?php

namespace Medians\Leads\Application;
use \Shared\dbaser\CustomController;

use Medians\Leads\Infrastructure\LeadRepository;


class LeadController extends CustomController
{


	/*
	/ @var new CustomerRepository
	*/
	protected $repo;

	protected $app;


	function __construct()
	{
		$this->app = new \config\APP;
		$this->repo = new LeadRepository();
	}





	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "lead_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> translate('mobile'), 'sortable'=> true ],
            [ 'value'=> "country", 'text'=> translate('country'), 'sortable'=> true ],
            [ 'value'=> "email", 'text'=> translate('email'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
        ];
	}

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "lead_id", 'title'=> translate('id'), 'fillable'=> true, 'column_type'=>'hidden' ],
            // [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=> true, 'column_type'=>'file' ],
            [ 'key'=> "name", 'title'=> translate('name'), 'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "mobile", 'title'=> translate('mobile'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "whatsapp", 'title'=> translate('WhatsApp number'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "job_title", 'title'=> translate('Job'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "country", 'title'=> translate('country'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('email'), 'fillable'=> true, 'column_type'=>'email', 'required'=>true  ],
            [ 'key'=> "status", 'title'=> translate('status'), 'fillable'=> true, 'column_type'=>'checkbox' ],

        ];
	}

	

	

	/**
	 * Index page
	 * 
	 */
	public function index()
	{
		$lead = $this->app->auth();

		return render('data_table', [
	        'title' => translate('Leads'),
			'load_vue'=> true,
			'items' =>  $this->repo->get(100),
		        'columns' => $this->columns(),
				'fillable' => $this->fillable(),
			'object_name' => 'Lead',
			'object_key'  => 'lead_id'
	    ]);
	} 


	/**
	 * Index page
	 * 
	 */
	public function profile()
	{
		
		$user = $this->app->auth();

		return render('profile', [
			'load_vue'=> true,
	        'title' => translate('Leads'),
			'user' =>   $user,
            'stats' => $this->getStats(),
	        'overview' => $this->overview(),
	        'fillable' => $this->fillable(),
	    ]);
	} 

	
	
	public function get() 
	{	
		return $this->repo->get();
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$params = $this->app->params();

		try {

			if ($this->validate($params)) 
				return $this->validate($params);

			$save = $this->repo->store($params);

        	return isset($save->lead_id) 
           	? array('success'=>1, 'result'=>translate('Created'), 'reload'=>1)
        	: array('error'=> $save );

        } catch (Exception $e) {
            return  array('error'=> $e->getMessage());
        }
	}



	/**
	*  Validate item store
	*/
	public function validate($params) 
	{
		if (empty($params['name']))
			return ['result'=> translate('Name required')];

		if (empty($params['mobile']))
			return ['result'=> translate('Mobile required')];

	}

	/**
	*  Validate item update
	*/
	public function validateUpdate($params) 
	{

		if (empty($params['name']))
			return ['result'=> translate('Name required')];

		if (empty($params['mobile']))
			return ['result'=> translate('mobile required')];

	}



	/**
	*  Update item
	*/
	public function update() 
	{

		$params = (array)  $this->app->params();

		try {

			
			if ($this->validateUpdate($params))
			{
	        	return  $this->validateUpdate($params);
			}			

			if (empty($params['password']))
			{
				unset($params['password']);
			}

			$update = $this->repo->update($params);

        	return isset($update->id) 
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
        	: array('error'=> $update );

        } catch (Exception $e) {
            return  ['error' => $e->getMessage()];
        }
	}

	/**
	*  Update item
	*/
	public function updateStatus() 
	{

		$params = $this->app->params();

		try {

			$update = $this->repo->updateStatus($params);

        	echo json_encode( isset($update->id) 
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
        	: array('error'=> $update ));

        } catch (Exception $e) {
            return  ['error' => $e->getMessage()];
        }
	}




}
