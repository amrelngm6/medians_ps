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
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
		return render('notifications', [
	        'load_vue' => true,
	        'title' => __('Notifications'),
	        'items' => $this->repo->get(),
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

	/**
	 * Delete item from database
	 * 
	 * @return [] 
	*/
	public function read_notification() 
	{
		
		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

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

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->get(10, $params['last_id']);

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
		$items = $this->repo->get(50, $last_id);

		return render('notifications', $this->loadLatestNotifications($items));
	}

	/**
	 * Load latest notifications based on role and limit
	 * 
	 */
	public function loadLatestNotifications($items=0)
	{
		return [
	        'load_vue' => true,
	        'title' => __('Notifications'),
	        'last_id' => !empty($items) ? $items->first()->id : 0,
	        'items' => $items,
	        'total_count' => $items->count(),
	        'new_count' => $items->where('status', 'new')->count(),
	    ];
	}  




	/**
	 * Handle the bookings notifications
	 * in background
	 */ 
	public function handleBookingsNotifications()
	{
		foreach ($this->branchRepo->getIds() as $key => $value) 
		{
			$this->store($value->id);
		}
	}



	/**
	*  Store item
	*/
	public function store(Int $branchId) 
	{

		try {	
	

			$DashboardController = new \Medians\DashboardController;
			$branch = $this->branchRepo->find($branchId);
			$a = new \Medians\Auth\Application\AuthService;

			


        } catch (Exception $e) {

        }
	}

	
}
