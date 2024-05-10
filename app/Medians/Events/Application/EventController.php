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
            [ 'value'=> "event_id", 'text'=> "#"],
            [ 'value'=> "title", 'text'=> __('Title'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> __('date'), 'sortable'=> true ],
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

		return [
            [ 'key'=> "event_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "title", 'title'=> __('title'),  'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "description", 'title'=> __('Content'),  'fillable'=> true, 'column_type'=>'textarea','required'=>true ],
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


	


	public function store() 
	{

		$params = $this->app->params();

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

	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadEvents()
	{
		$this->app = new \config\APP;

		return $this->repo->loadDriverMessages($this->app->auth(), 100);
	}  

	

	public function update()
	{
		$params = $this->app->params();

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

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['event_id']);


            if ($this->repo->delete($params['event_id']))
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


}