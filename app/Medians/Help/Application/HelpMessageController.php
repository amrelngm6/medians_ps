<?php
namespace Medians\Help\Application;

use Shared\dbaser\CustomController;

use Medians\Help\Infrastructure\HelpMessageRepository;

class HelpMessageController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new HelpMessageRepository	($this->app->auth()->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "message_id", 'title'=> "#"],
            [ 'key'=> "subject", 'title'=> __('subject'), 'sortable'=> true ],
            [ 'key'=> "message", 'title'=> __('message'), 'sortable'=> true ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "message_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "subject", 'title'=> __('subject'),  'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "message", 'title'=> __('message'),  'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "user_name", 'title'=> __('user_name'),  ],
        ];
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
		
		try {
			
		    return render('help_messages', [
		        'load_vue' => true,
		        'title' => __('Help Messages'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
		}
	}

	

	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

			$user = $this->app->auth();
			$params['business_id'] = $user->business->business_id;

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	public function storeComment() 
	{
		$params = $this->app->request()->get('params');

        try {	

        	$params['user_id'] = $this->app->auth()->id;        	

            $returnData = (!empty($this->repo->storeUserComment($params))) 
            ? array('success'=>1, 'result'=>__('Added'))
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	
	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadHelpMessages()
	{
		$this->app = new \config\APP;

		return $this->repo->loadDriverMessages($this->app->auth(), 100);
	}  

	
	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadParentHelpMessages()
	{
		$this->app = new \config\APP;

		return $this->repo->loadParentMessages($this->app->auth(), 100);
	}  


	/**
	 * Close / End ticket
	 */
	public function close() 
	{
		$params = $this->app->request()->get('params');

        try {	

            $returnData = (!empty($this->repo->update($params))) 
            ? array('success'=>1, 'result'=>__('Done'))
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		echo json_encode($returnData);
	}

	public function storeMobile() 
	{

		$params = (array) json_decode($this->app->request()->get('params'));

        try 
		{	
			$user = $this->app->auth();

			$params['user_id'] = $user->driver_id;
			$params['business_id'] = isset($user->business->business_id) ? $user->business->business_id : 0;

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('THNKS_MSG'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	
	public function parentStore() 
	{

		$params = (array) json_decode($this->app->request()->get('params'));
		$user = $this->app->auth();
        try {	
			$params['user_id'] = $user->customer_id;

            $returnData = (!empty($this->repo->parentStore($params))) 
            ? array('success'=>1, 'result'=>__('THNKS_MSG'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}


	public function storeDriverComment() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));

        try {	

        	$params['user_id'] = $this->app->auth()->driver_id;        	

            $returnData = (!empty($this->repo->storeDriverComment($params))) 
            ? array('success'=>1, 'result'=>__('Added'))
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		echo json_encode($returnData);

		return true;
	}


	public function storeParentComment() 
	{
		$params = (array) json_decode($this->app->request()->get('params'));

        try {	

        	$params['user_id'] = $this->app->auth()->customer_id;        	

            $returnData = (!empty($this->repo->storeParentComment($params))) 
            ? array('success'=>1, 'result'=>__('Added'))
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		echo json_encode($returnData);

		return true;
	}


	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['message_id']);


            if ($this->repo->delete($params['message_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}