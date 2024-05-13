<?php
namespace Medians\Wallets\Application;

use Shared\dbaser\CustomController;

use Medians\Wallets\Infrastructure\WithdrawalRepository;
use Medians\Wallets\Infrastructure\WalletRepository;

class WithdrawalController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;

	protected $repo;

	protected $walletRepo;


	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();

		$this->repo = new WithdrawalRepository($user->business);
		$this->walletRepo = new WalletRepository($user->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "withdrawal_id", 'text'=> "#"],
            [ 'value'=> "business.business_name", 'text'=> translate('Business'), 'sortable'=> true ],
            [ 'value'=> "amount", 'text'=> translate('Amount'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> translate('Date'), 'sortable'=> true ],
            [ 'value'=> "due_date", 'text'=> translate('Due Date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('Edit') ],
            [ 'value'=> "delete", 'text'=> translate('Delete') ],
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
		
		$params = sanitizeInput($this->app->request()->query->all());

		try {

			return render('withdrawals', [
		        'load_vue' => true,
		        'title' => translate('Business Withdrawals'),
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

		$params = $this->app->params();

		$user = $this->app->auth();
		
        try {	

			$validate = $this->validate($params, $user);

			if ($validate)
			{
				return array('error'=>$validate);
			}

			$params['field'] = isset($params['field']) ? (array) json_decode($params['field']) : null;

			$returnData = (!empty($this->repo->store($params))) 
			? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
			: array('success'=>0, 'result'=>'Error', 'error'=>1);


        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->params();

		$user = $this->app->auth();

        try {

			$validate = $this->validateBalance($params, $params['user_id']);
			if ($validate && $params['status'] == 'done') { return array('error'=>$validate, 'reload'=>1); }

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

			$delete = $this->repo->delete($params['withdrawal_id']);

            if ($delete === true)
            {
                return array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1);
            } else {
                return array('error' => $delete);
			}

        } catch (Exception $e) {
			return array('error'=>$e->getMessage());
        	
        }
	}

	
	public function create() 
	{	

		$params = (array) $this->app->params();

		$user = $this->app->auth();

        try {	
			
			try {
					
				$validate = $this->validatePending($params, $user);
				if ($validate) { return array('error'=>$validate); }

				$validate = $this->validateBalance($params, $user->driver_id);
				if ($validate) { return array('error'=>$validate); }

				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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
	public function getWithdrawals()
	{
		$user = $this->app->auth();

		if (empty($user->driver_id)) { return null; }
		
		return $this->repo->getWithdrawals($user->driver_id);
	}


	
	
	/**
	 * validate duplicates 
	 */
	public function validatePending($params, $user)
	{
		if ($this->repo->checkPending($user->driver_id))
		{
			return translate('Another pending request found');
		}
	}
	
	/**
	 * validate balance
	 */
	public function validateBalance($params, $driver_id)
	{
		
		$wallet = $this->walletRepo->driverWallet($driver_id);

		if ($wallet->credit_balance < $params['amount'])
		{
			return translate('Credit Balance not enough');
		}
	}


}