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
                'text'=> translate('name'),
                'sortable'=> false,
				'fixed'=>true,
				'width' => 200,
            ],
            [
                'value'=> "model_title",
                'text'=> translate('model'),
                'sortable'=> true,
				'width' => 300,
				'fixed'=>true,
            ],
            [
                'value'=> "receiver_title",
                'text'=> translate('receiver_model'),
				'width' => 250,
                'sortable'=> true,
            ],
            [
                'value'=> "subject",
                'text'=> translate('subject'),
				'width' => 200,
                'sortable'=> true,
            ],
            [
                'value'=> "status",
                'text'=> translate('status'),
				'width' => 50,
                'sortable'=> true,
			],
			
            [ 'value'=> "edit", 'text'=> translate('edit'), 'width'=>50  ],
            [ 'value'=> "delete", 'text'=> translate('delete'), 'width'=>50  ],
        ];
	}


	
	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "id", 'title'=> "#",'column_type'=>'hidden'],
			[ 'key'=> "receiver_model", 'title'=> translate('Receiver model'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select', 'required'=> true, 'text_key'=>'title', 'data'=>$this->loadReceiverModels('receiver_model') ],
			[ 'key'=> "model", 'title'=> translate('Model'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select', 'required'=> true, 'text_key'=>'title',  'data'=>$this->loadModels('model') ],
			
			[ 'key'=> "action", 'title'=> translate('Action'), 'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title',  'required'=> true, 'data'=>[
				['action'=>'create','title'=>translate('On Create')],
				['action'=>'update','title'=>translate('On Update')],
				['action'=>'delete','title'=>translate('On delete')],
			] ],
			[ 'key'=> "action_field", 'title'=> translate('action_field'), 'fillable'=> true, 'column_type'=>'text' ],
			[ 'key'=> "action_value", 'title'=> translate('action_value'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "title", 'title'=> translate('title'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "subject", 'title'=> translate('subject'), 'fillable'=> true, 'column_type'=>'text', 'required'=> true ],
            [ 'key'=> "body", 'title'=> translate('Notification email'), 'fillable'=> true, 'column_type'=>'textarea', 'required'=> true ],
            [ 'key'=> "body_text", 'title'=> translate('Notification text'), 'fillable'=> true, 'column_type'=>'textarea', 'required'=> true ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
	        'title' => translate('Notifications events'),
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
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>translate('Error'), 'error'=>1);


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
           	? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
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
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
           	: array('error'=>translate('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



}
