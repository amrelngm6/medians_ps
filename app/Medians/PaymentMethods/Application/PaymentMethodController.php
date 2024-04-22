<?php

namespace Medians\PaymentMethods\Application;
use \Shared\dbaser\CustomController;

use Medians\PaymentMethods\Infrastructure\PaymentMethodRepository;

class PaymentMethodController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $featuresRepo;


	function __construct()
	{
		$this->app = new \config\APP;
		$this->repo = new PaymentMethodRepository($this->app->auth()->business);
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "payment_method_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> __('Name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> __('Logo'), 'sortable'=> true ],
            [ 'value'=> "description", 'text'=> __('Description'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('edit')  ],
            [ 'value'=> "delete", 'text'=> __('delete')  ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "payment_method_id", 'title'=> "#", 'column_type'=>'hidden'],
			[ 'key'=> "name", 'title'=> __('name'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "code", 'title'=> __('Code'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "description", 'title'=> __('description'), 'required'=>true, 'fillable'=> true, 'column_type'=>'textarea' ],
            [ 'key'=> "status", 'title'=> __('Status'), 'fillable'=>true, 'column_type'=>'checkbox' ],
			[ 'key'=> "picture", 'title'=> __('Logo'), 'required'=>true, 'fillable'=> true, 'column_type'=>'picture' ],

        ];
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */
	public function index() 
	{
		return render('payment_methods', [
	        'load_vue' => true,
	        'title' => __('Business Payment Methods'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
	        'items' => $this->repo->get(),
	    ]);
	}

	/**
	 * Store item to database
	 * 
	 * @return [] 
	*/
	public function store() 
	{	
        
		$params = $this->app->request()->get('params');

        try {
        	$user = $this->app->auth();

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;
			$params['business_id'] = $user->business->business_id;
			$params['created_by'] = $user->id;
            
			return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>__('Error'), 'error'=>1);


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
	
	}



	/**
	 * Update item to database
	 * 
	 * @return [] 
	*/
	public function update() 
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;

           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>true)
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}

	/**
	 * Delete item from database
	 * 
	 * @return [] 
	*/
	public function delete() 
	{
		
		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

           	return  ($this->repo->delete($params['payment_method_id']))
            ? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
