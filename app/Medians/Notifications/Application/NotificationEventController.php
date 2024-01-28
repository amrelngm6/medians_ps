<?php

namespace Medians\Notifications\Application;
use \Shared\dbaser\CustomController;

use Medians\Notifications\Infrastructure\NotificationEventRepository;

class NotificationEventController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;


	function __construct()
	{
		$this->repo = new NotificationEventRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [
                'value'=> "id",
                'text'=> '#',
                'sortable'=> false,
				'width' => 30,
				'fixed'=>true,
            ],
            [
				'value'=> "title",
                'text'=> __('name'),
                'sortable'=> false,
				'fixed'=>true,
				'width' => 200,
            ],
            [
                'value'=> "model",
                'text'=> __('model'),
                'sortable'=> true,
				'width' => 300,
				'fixed'=>true,
            ],
            [
                'value'=> "receiver_model",
                'text'=> __('receiver_model'),
				'width' => 250,
                'sortable'=> true,
            ],
            [
                'value'=> "subject",
                'text'=> __('subject'),
				'width' => 200,
                'sortable'=> true,
            ],
            [
                'value'=> "status",
                'text'=> __('status'),
				'width' => 50,
                'sortable'=> true,
			],
			
            [ 'value'=> "edit", 'text'=> __('edit'), 'width'=>50  ],
            [ 'value'=> "delete", 'text'=> __('delete'), 'width'=>50  ],
        ];
	}


	
	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "event_id", 'title'=> "#",'column_type'=>'hidden'],
			[ 'key'=> "receiver_model", 'title'=> __('Receiver model'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select', 'required'=> true, 'text_key'=>'title', 'data'=>$this->loadReceiverModels('receiver_model') ],
			[ 'key'=> "model", 'title'=> __('Model'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select', 'required'=> true, 'text_key'=>'title',  'data'=>$this->loadModels('model') ],
			
			[ 'key'=> "action", 'title'=> __('Action'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title',  'required'=> true, 'data'=>[
				['action'=>'create','title'=>__('On Create')],
				['action'=>'update','title'=>__('On Update')],
				['action'=>'delete','title'=>__('On delete')],
			] ],
			[ 'key'=> "action_field", 'title'=> __('action_field'), 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "action_value", 'title'=> __('action_value'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "title", 'title'=> __('title'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "subject", 'title'=> __('subject'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "body", 'title'=> __('Notification email'), 'fillable'=> true, 'column_type'=>'textarea', 'required'=> true ],
            [ 'key'=> "body_text", 'title'=> __('Notification text'), 'fillable'=> true, 'column_type'=>'textarea', 'required'=> true ],
            [ 'key'=> "status", 'title'=> __('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
		return render('notifications_events', [
	        'load_vue' => true,
	        'title' => __('Notifications events'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
			'fillable' => $this->fillable(),
	    ]);
	}


	/**
	 * Supported models for events
	 *
	 */
	public function loadModels($key)
	{
		$models = $this->repo->loadModels();
		$data = [];
		foreach ($models as $i => $value) {
			$data[$i] = [$key=>$value, 'title'=>$i] ;
		}
		return $data;
	}  


	/**
	 * Supported receivers models for events
	 */
	public function loadReceiverModels($key)
	{
		$models = $this->repo->loadReceiverModels();
		$data = [];
		foreach ($models as $i => $value) {
			$data[$i] = [$key=>$value, 'title'=>$i] ;
		}
		return $data;
	}  


	/**
	 * Store item to database
	 * 
	 * @return [] 
	*/
	public function store() 
	{	
		$this->app = new \config\APP;
        
		$params = $this->app->request()->get('params');

        try {
        	$params['created_by'] = $this->app->auth()->id;
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


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
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

           	return  ($this->repo->delete($params['id']))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
