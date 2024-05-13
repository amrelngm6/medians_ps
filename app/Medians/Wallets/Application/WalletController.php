<?php
namespace Medians\Wallets\Application;

use Shared\dbaser\CustomController;

use Medians\Wallets\Infrastructure\WalletRepository;

class WalletController extends CustomController 
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

		$this->repo = new WalletRepository($user->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "wallet_id", 'text'=> "#"],
            [ 'value'=> "business", 'text'=> translate('Business')],
            [ 'value'=> "credit_balance", 'text'=> translate('Credit balance'), 'sortable'=> true ],
            [ 'value'=> "debit_balance", 'text'=> translate('Debit balance'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status') ],
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

			return render('business_wallets', [
		        'load_vue' => true,
		        'title' => translate('Wallets'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'total_debit_balance' => $this->repo->totalDebitBalance(),
		        'total_credit_balance' => $this->repo->totalCreditBalance(),

		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	

	public function store() 
	{	

		$params = $this->app->params();

        try {	
			
			try {
				
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



	public function update()
	{

		$params = $this->app->params();

        try {

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


            if ($this->repo->delete($params['vacation_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

	
	public function create() 
	{	

		$params = (array) $this->app->params();

        try {	
			
			try {
				
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
	public function getWallet()
	{
		$user = $this->app->auth();

		if (empty($user->customer_id)) { return null; }
		
		return $this->repo->getWallet($user->customer_id);
	}


}