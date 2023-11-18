<?php
namespace Medians\Events\Application;

use Shared\dbaser\CustomController;

use Medians\Events\Infrastructure\EventRepository;

class EventController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new EventRepository	();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "event_id", 'title'=> "#"],
            [ 'key'=> "title", 'title'=> __('Title'), 'sortable'=> true ],
            [ 'key'=> "status", 'title'=> __('status'), 'sortable'=> true ],
            [ 'key'=> "date", 'title'=> __('date'), 'sortable'=> true ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "event_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "title", 'title'=> __('title'),  'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "description", 'title'=> __('Content'),  'fillable'=> true, 'column_type'=>'textarea' ],
            [ 'key'=> "status", 'title'=> __('status'),  'fillable'=>true, 'column_type'=>'checkbox' ],
            [ 'key'=> "picture", 'title'=> __('picture'),  'fillable'=> true, 'column_type'=>'file' ],
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
			
		    return render('events', [
		        'load_vue' => true,
		        'title' => __('Events'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * getPickupLocation
	 */
	public function getPickupLocation($id)
	{
		$data =  $this->repo->find($id);

		echo  json_encode($data);
	}



	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['created_by'] = $this->app->auth()->id;        	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
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
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	
	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadEvents()
	{
		$this->app = new \config\APP;

		return $this->repo->loadDriverMessages($this->app->auth(), 100);
	}  


	/**
	 * Close / End ticket
	 */
	public function close() 
	{
		$params = $this->app->request()->get('params');

        try {	

        	$params['user_id'] = $this->app->auth()->id;        	

            $returnData = (!empty($this->repo->update($params))) 
            ? array('success'=>1, 'result'=>__('Done'))
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	public function storeMobile() 
	{

		$params = (array) json_decode($this->app->request()->get('params'));

        try {	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('THNKS_MSG'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
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


	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

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

        	$check = $this->repo->find($params['pickup_id']);


            if ($this->repo->delete($params['pickup_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{

		if (empty($params['content']['ar']['title']))
		{
        	throw new \Exception(json_encode(array('result'=>__('NAME_EMPTY'), 'error'=>1)), 1);
		}

	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function page($contentObject)
	{

		try {
			
			$item = $this->repo->find($contentObject->item_id);
			$item->addView();

			return render('views/front/page.html.twig', [
		        'item' => $item,
		        'similar_articles' => $this->repo->similar($item, 3),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

	/**
	 * Front page 
	 * @var Int
	 */
	public function list()
	{
		$request =  $this->app->request();

		try {
				
			return render('views/front/PickupLocation.html.twig', [
		        'first_item' => $this->repo->getFeatured(1),
		        'search_items' => $request->get('search') ?  $this->repo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
		        'items' => $this->repo->get(4),
		        'cat_her' => $this->repo->getByCategory(6, 4),
		        'cat_him' => $this->repo->getByCategory(7, 4),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}