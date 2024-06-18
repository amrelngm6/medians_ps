<?php
namespace Medians\Vehicles\Application;

use Shared\dbaser\CustomController;

use Medians\Vehicles\Infrastructure\VehicleRepository;
use Medians\Vehicles\Infrastructure\VehicleTypeRepository;
use Medians\Routes\Infrastructure\RouteRepository;

class VehicleTypeController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	protected $vehicleRepo;

	function __construct()
	{
		$this->app = new \config\APP;

		$this->repo = new VehicleTypeRepository();
		$this->vehicleRepo = new VehicleRepository();

    }




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "type_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> translate('name'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status')],
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
            [ 'key'=> "type_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "name", 'title'=> translate('name'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'checkbox' ],
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
			
		    return render('data_table', [
		        'load_vue' => true,
		        'title' => translate('Vehicle types'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'types' => $this->vehicleRepo->get(),
				'object_name' => 'VehicleType',
				'object_key'  => 'type_id'
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

                $params['status'] = !empty($params['status']) ? 'on' : null;

				$this->validate($params);

			} catch (\Throwable $e) {
	        	return array('result'=>$e->getMessage(), 'error'=>1);
			}

			$params['created_by'] = $this->app->auth()->id;

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (\Exception $es) {
        	return array('result'=>$es->getMessage(), 'error'=>1);
        }

		return $returnData;
	}


	public function update()
	{
		$params = $this->app->params();

        try {

        	$params['status'] = !empty($params['status']) ? 'on' : null;

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

        	$check = $this->repo->find($params['type_id']);

            if ($this->repo->delete($params['type_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            
        } catch (Exception $e) {
        	throw new \Exception($e->getMessage(), 1);
        }
	}

	


	public function validate($params) 
	{

		if (empty($params['name']))
		{
			throw new \Exception(translate('NAME_EMPTY'), 0);
		}

	}

}