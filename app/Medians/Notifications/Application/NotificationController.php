<?php

namespace Medians\Notifications\Application;
use \Shared\dbaser\CustomController;

use Medians\Notifications\Infrastructure\NotificationRepository;

class NotificationController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;
	protected $app;
	


	function __construct()
	{
		$this->repo = new NotificationRepository();
	}


	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [
                'key'=> "id",
                'title'=> '#',
                'sortable'=> false,
            ],
            [
                'key'=> "subject",
                'title'=> __('subject'),
                'sortable'=> false,
            ],
            [
                'key'=> "model_short_name",
                'title'=> __('Model'),
                'sortable'=> false,
            ],
            [
                'key'=> "receiver_name",
                'title'=> __('receiver_name'),
                'sortable'=> true,
            ],
            [
                'key'=> "date",
                'title'=> __('date'),
                'sortable'=> true,
            ],
            [
                'key'=> "status",
                'title'=> __('status'),
                'sortable'=> true,
            ]
        ];
	}

	/**
	 * Admin index items
	 * 
	 */ 
	public function index() 
	{
		$app = new \Config\APP;
		return render('notifications', [
	        'load_vue' => true,
	        'title' => __('Notifications'),
	        'items' => $this->repo->get($app->auth()),
	        'columns' => $this->columns(),

	    ]);
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

	/**
	 * Delete item from database
	 * 
	 * @return [] 
	*/
	public function read_notification() 
	{
		
		$this->app = new \config\APP;

		$params = $this->app->params();

        try {
           	
           	response($this->repo->update(['id'=>$params['id'],'status' => 'read'])
            ? array('success'=>1, 'result'=>__('updated'))
           	: array('error'=>__('Not allowed')));

        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }

	}


	/**
	 * Delete item from database
	 * 
	 * @return [] 
	*/
	public function check_notification() 
	{
		
		$this->app = new \config\APP;

		$params = $this->app->params();

        try {

        	$check = $this->repo->get($this->app->auth(), $params['last_id']);

           	echo  (count($check))
            ? json_encode($this->loadLatestNotifications($check))
           	: 0;


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }

	}



	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function latest_notifications($last_id=0) 
	{
		$this->app = new \config\APP;

		$items = $this->repo->get($this->app->auth(), 50, $last_id);

		return render('notifications', $this->loadLatestNotifications($items));
	}

	/**
	 * Load latest notifications based on role and limit
	 * 
	 */
	public function loadLatestNotifications($items=0)
	{
		$firstitem = $items->first();
		
		return [
	        'load_vue' => true,
	        'title' => __('Notifications'),
	        'last_id' => !empty($firstitem) ? $firstitem->id : 0,
	        'items' => $items,
	        'total_count' => $items->count(),
	        'new_count' => $items->where('status', 'new')->count(),
	    ];
	}  



	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadLatestMobileNotifications()
	{
		$this->app = new \config\APP;
		$user = $this->app->auth();
		if (isset($user->parent_id))
		{
			$items = $this->repo->loadParentNotifications($user->parent_id, 10, 0);
		}
		if (isset($user->driver_id))
		{
			$items = $this->repo->loadDriverNotifications($user->driver_id, 10, 0);
		}
		
		$firstitem = $items->first();
		return [
	        'last_id' => !empty($firstitem) ? $firstitem->id : 0,
	        'items' => $items,
	        'total_count' => $items->count(),
	        'new_count' => $items->where('status', 'new')->count(),
	    ];
	}  









	/**
	 * Update item to database
	 * 
	 * @return [] 
	*/
	public function update() 
	{

		$this->app = new \config\APP;

		$params = (array) $this->app->params();

        try {

           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'reload'=>1)
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}

	
}
