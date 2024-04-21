<?php
namespace Medians\Wallets\Application;

use Shared\dbaser\CustomController;

use Medians\Wallets\Infrastructure\WithdrawalRepository;

class WithdrawalController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->repo = new WithdrawalRepository($user->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "withdrawal_id", 'text'=> "#"],
            [ 'value'=> "business.business_name", 'text'=> __('Business'), 'sortable'=> true ],
            [ 'value'=> "amount", 'text'=> __('Amount'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> __('Date'), 'sortable'=> true ],
            [ 'value'=> "due_date", 'text'=> __('Due Date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('Edit') ],
            [ 'value'=> "delete", 'text'=> __('Delete') ],
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
	public function index( ) 
	{
		
		$params = $this->app->request()->query->all();

		try {

			return render('business_withdrawals', [
		        'load_vue' => true,
		        'title' => __('Business Withdrawals'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get($params),
				'total_pending_amount' => round($this->repo->totalPendingAmount($params), 2),
				'total_completed_amount' => round($this->repo->totalCompletedAmount($params), 2),
				'pending_by_payment_methods' => $this->repo->pendingGroupedByPaymentMethod($params),
				'completed_by_payment_methods' => $this->repo->completedGroupedByPaymentMethod($params),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	

	public function store() 
	{	

		$params = $this->app->request()->get('params');

		$user = $this->app->auth();
		
        try {	

			$validate = $this->validate($params, $user);

			if ($validate)
			{
				return array('error'=>$validate);
			}

			$params['field'] = isset($params['field']) ? (array) json_decode($params['field']) : null;

			$returnData = (!empty($this->repo->store($params))) 
			? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
			: array('success'=>0, 'result'=>'Error', 'error'=>1);


        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update()
	{

		$params = $this->app->request()->get('params');

        try {
			

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

			$delete = $this->repo->delete($params['withdrawal_id']);

            if ($delete === true)
            {
                return array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1);
            } else {
                return array('error' => $delete);
			}

        } catch (Exception $e) {
			return array('error'=>$e->getMessage());
        	
        }
	}

	
	public function create() 
	{	

		$params = (array) json_decode($this->app->request()->get('params'));

        try {	
			
			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	
	/**
	 * Load user wallets
	 */
	public function getWithdrawal()
	{
		$user = $this->app->auth();

		if (empty($user->customer_id)) { return null; }
		
		return $this->repo->getWithdrawal($user->customer_id);
	}


	
	
	/**
	 * validate
	 */
	public function validate($params, $user)
	{
		
		$check =  $this->repo->checkPending($user->business->business_id);

		return $check ? __('Another pending request found') : null;
		
	}


}