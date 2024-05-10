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
				'width' => 150,
				'fixed'=>true,
            ],
            [
                'value'=> "receiver_model",
                'text'=> __('receiver_model'),
				'width' => 150,
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
	        'models' => $this->repo->loadModels(),
	    ]);
	}


	/**
	 * Supported models for events
	 *
	 */
	public function loadModels()
	{
	}  


	/**
	 * Store item to database
	 * 
	 * @return [] 
	*/
	public function store() 
	{	
		$this->app = new \config\APP;
        
		$params = $this->app->params();

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

		$params = $this->app->params();

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

		$params = $this->app->params();

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
