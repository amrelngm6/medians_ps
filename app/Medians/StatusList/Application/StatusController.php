<?php
namespace Medians\StatusList\Application;

use Shared\dbaser\CustomController;

use Medians\StatusList\Infrastructure\StatusRepository;
use Medians\Customers\Infrastructure\AgentRepository;

class StatusController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $agentRepo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new StatusRepository();
		$this->agentRepo = new AgentRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "status_id", 'text'=> "#"],
            [ 'value'=> "title", 'text'=> translate('title'), 'sortable'=> true ],
            [ 'value'=> "value", 'text'=> translate('value'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
		return [
            [ 'key'=> "status_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "title", 'title'=> translate('title'),  'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "value", 'title'=> translate('value'),  'fillable'=> true, 'column_type'=>'text','required'=>true ],
            [ 'key'=> "sort", 'title'=> translate('sort'),  'fillable'=> true, 'column_type'=>'number','required'=>true ],
            [ 'key'=> "model", 'title'=> translate('model'),  'fillable'=> false, 'column_type'=>'text','disabled'=>true ],
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
			
		    return render('data_table', 
			[
		        'load_vue' => true,
		        'title' => translate('Status'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'agents' => $this->agentRepo->get(),
				'object_name' => 'Status',
				'object_key' => 'status_id'
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
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	/**
	 * Load latest statuss
	 * 
	 */
	public function loadStatusList()
	{

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
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}
	

	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['status_id']);


            if ($this->repo->delete($params['status_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}