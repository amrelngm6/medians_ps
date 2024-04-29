<?php
namespace Medians\Wallets\Application;

use Shared\dbaser\CustomController;

use Medians\Wallets\Infrastructure\CollectedCashRepository;

class CollectedCashController extends CustomController 
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

		$this->repo = new CollectedCashRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "collection_id", 'text'=> "#"],
            [ 'value'=> "wallet.user.name", 'text'=> translate('User'), 'sortable'=> true ],
            [ 'value'=> "amount", 'text'=> translate('Amount'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> translate('Date'), 'sortable'=> true ],
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

			return render('collected_cash', [
		        'load_vue' => true,
		        'title' => translate('Collected cash'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get($params),
				'total_completed_amount' => round($this->repo->totalCompletedAmount($params) ?? 0, 2),
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

			$params['business_id'] = $user->business->business_id;
			$params['created_by'] = $user->id;
			$params['date'] = date('Y-m-d');

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

		$params = $this->app->request()->get('params');

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

		$params = $this->app->request()->get('params');

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

		$params = (array) json_decode($this->app->request()->get('params'));

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

	
	
	public function update_student_vacation() 
	{	

		$params = (array) json_decode($this->app->request()->get('params'));

        try {	
			
			$check = $this->repo->update($params);
			$returnData = isset($check->vacation_id)
			? array('success'=>1, 'result'=>translate('updated successfully'), 'reload'=>1)
			: array('success'=>0, 'result'=> $check, 'error'=>1);


        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	


}