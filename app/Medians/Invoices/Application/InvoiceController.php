<?php

namespace Medians\Invoices\Application;
use \Shared\dbaser\CustomController;

use Medians\Users\Application\GetStartedController;

use Medians\Invoices\Infrastructure\InvoiceRepository;
use Medians\Plans\Infrastructure\PlanRepository;
use Medians\Plans\Infrastructure\PlanSubscriptionRepository;

class InvoiceController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;
	protected $app;
	protected $planRepo;



	function __construct()
	{
        $this->app = new \config\APP;
		
		$user = $this->app->auth();
		$this->repo = new InvoiceRepository(isset($user->business) ? $user->business : null);

		$this->planRepo = new PlanRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "invoice_id", 'text'=> "#"],
            [ 'value'=> "user", 'text'=> __('User'), 'sortable'=> false ],
            [ 'value'=> "subtotal", 'text'=> __('Subtotal'), 'sortable'=> true ],
            [ 'value'=> "total_amount", 'text'=> __('Total Amount'), 'sortable'=> true ],
            [ 'value'=> "payment_method", 'text'=> __('Gateway'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> __('Date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> false ],
			['value'=>'delete', 'text'=>__('Delete')],
        ];
	}


	/**
	 * Admin index items
	 * Loads in vue 
	 */ 
	public function index() 
	{

		return render('transactions', [
			'load_vue'=> true,
	        'title' => __('Invoices list'),
	        'items' => $this->repo->get(),
	        'columns' => $this->columns(),
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

		$params = $this->app->request()->get('params');

        try {
        	$params['business_id'] = $this->app->business->business_id;
        	
            return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('error'=>__('Err'));


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
	public function delete() 
	{

        $this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

           	$returnData =  $this->repo->delete($params['invoice_id'])
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return response($returnData);

	}


	public function addInvoice()
	{
		
		$params = (array) json_decode($this->app->request()->get('params'));

		try {
			
			$saveInvoice = $this->repo->store($params); 

			return (isset($saveInvoice['success']))
			? array('success'=>1, 'result'=>$saveInvoice['result'], 'reload'=>1)
			: array('error'=>$saveInvoice['error']);

		} catch (Exception $e) {
			return array('error'=>$e->getMessage());
		}
		
		
	}


}
