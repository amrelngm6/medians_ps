<?php

namespace Medians\Packages\Application;
use \Shared\dbaser\CustomController;

use Medians\Packages\Infrastructure\PackageRepository;
use Medians\Packages\Infrastructure\PackageSubscriptionRepository;
use Medians\Students\Infrastructure\StudentRepository;
use Medians\Customers\Infrastructure\EmployeeRepository;
use Medians\Customers\Infrastructure\SuperVisorRepository;

class PackageSubscriptionController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $packageRepo;
    
	protected $studentRepo;

	protected $supervisorRepo;
    
	protected $employeeRepo;


	function __construct()
	{
        $this->app = new \config\APP;   
		$this->repo = new PackageSubscriptionRepository($this->app->auth()->business);
		$this->packageRepo = new PackageRepository($this->app->auth()->business);
		$this->studentRepo = new StudentRepository($this->app->auth()->business);
		$this->supervisorRepo = new SuperVisorRepository($this->app->auth()->business);
		$this->employeeRepo = new EmployeeRepository($this->app->auth()->business);
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "subscription_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> __('Name'), 'sortable'=> true ],
            [ 'value'=> "package.name", 'text'=> __('Package'), 'sortable'=> true ],
            [ 'value'=> "total_cost", 'text'=> __('Total cost'), 'sortable'=> true ],
            [ 'value'=> "payment_status", 'text'=> __('Payment'), 'sortable'=> true ],
            [ 'value'=> "payment_type", 'text'=> __('Duration'), 'sortable'=> true ],
            [ 'value'=> "start_date", 'text'=> __('start_date'), 'sortable'=> true ],
            [ 'value'=> "end_date", 'text'=> __('end_date'), 'sortable'=> true ],
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
		return render('package_subscriptions', [
	        'load_vue' => true,
	        'title' => __('Package Subscriptions'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'students' => $this->studentRepo->get(),
			'employees' => $this->employeeRepo->get(),
			'supervisors' => $this->supervisorRepo->get(),
			'packages' => $this->packageRepo->get(),
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
		$this->app = new \config\APP;
        
        $user = $this->app->auth();

		$params = $this->app->request()->get('params');

        try {
        	
			$params['payment_status'] = (isset($params['is_paid']) && $params['is_paid'] != 'false') ? 'paid' : 'unpaid';
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

        // return null;
		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

			$params['payment_status'] = (isset($params['is_paid']) && $params['is_paid'] != 'false' && $params['is_paid'] != 'null' ) ? 'paid' : 'unpaid';

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

           	return  ($this->repo->delete($params['subscription_id']))
            ? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}


	/**
	 * Find unpaid subscription for payment
	 * 
	 * @param String
	 * 
	 * @return JSON
	 */
	public function loadPendingStudentsSubscription()
	{
		$user = $this->app->auth();
		
		$data = $this->repo->loadPendingStudentsSubscription( $user->customer_id);

		return $data;

	}  

	/**
	 * Get subscription
	 * 
	 * @param String
	 * 
	 * @return JSON
	 */
	public function getSubscription()
	{
		$subscriptionId = $this->app->request()->get('subscription_id');
		
		$data = $this->repo->find( $subscriptionId);

		return $data;

	}  

	/**
	 * Cancel subscription
	 * 
	 * @param String
	 * 
	 * @return JSON
	 */
	public function cancelSubscription()
	{
		$subscriptionId = $this->app->request()->get('subscription_id');
		
		$data = $this->repo->cancelSubscription( $subscriptionId);

		return $data == true ? array('success'=>true, 'result'=>__('Subscription canceled')) : $data;

	}  

}
