<?php
namespace Medians\Businesses\Application;

use Shared\dbaser\CustomController;

use Medians\Businesses\Infrastructure\BusinessRepository;
use Medians\Routes\Infrastructure\RouteRepository;
use Medians\Drivers\Infrastructure\DriverRepository;

class BusinessController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $routeRepo;
	public $driverRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;
		$user = $this->app->auth();
		
		$this->repo = new BusinessRepository($user->business);
		$this->routeRepo = new RouteRepository($user->business);
		$this->driverRepo = new DriverRepository($user->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "business_id", 'text'=> "#"],
            [ 'value'=> "business_name", 'text'=> translate('business_name'), 'sortable'=> true ],
            [ 'value'=> "logo", 'text'=> translate('Logo'), 'sortable'=> true ],
            [ 'value'=> "owner.name", 'text'=> translate('owner'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('edit')  ],
            [ 'value'=> "delete", 'text'=> translate('delete')  ],
        ];
	}


	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( $type = 'school') 
	{

		return [
            [ 'key'=> "business_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "type", 'title'=> "", 'column_type'=>'hidden', 'default'=>$type],
			[ 'key'=> "business_name", 'title'=> translate('name'), 'required'=>true, 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
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
	public function schools( ) 
	{
		
		try {
			
		    return render('schools', [
		        'load_vue' => true,
		        'title' => translate('Schools'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable('school'),
		        'items' => $this->repo->getQuery('school', 1000),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	
	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function companies( ) 
	{
		
		try {
			
		    return render('companies', [
		        'load_vue' => true,
		        'title' => translate('Companies'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable('company'),
		        'items' => $this->repo->getQuery('company', 1000),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function validate($params) 
	{

		if (empty($params['business_name']))
		{
			throw new \Exception(translate('NAME_EMPTY'), 0);
		}

	}



	public function store() 
	{

		$params = $this->app->params();

        try {	

			try {
				
				$this->validate($params);

			} catch (\Exception $e) {
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : Null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function updateLocation($params)
	{

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'p'=>$params, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

			$id = isset($params['school_id']) ? $params['school_id'] : $params['company_id'];

        	$check = $this->repo->find($id);

            if ($this->repo->delete($id))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            
        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	

	public function loadBusiness()
	{
		$business_id = $this->app->request()->get('business_id');
		return $this->getBusiness($business_id);
	}

	public function getBusiness($business_id)
	{

		$auth = $this->app->auth();

        try {

			if (!empty($auth))
			{
				return  $this->repo->find($business_id);
			}

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}
	

	public function loadSchools()
	{
		$params = sanitizeInput($this->app->request()->query->all());
		$auth = $this->app->auth();
		$setting = (new \Medians\Settings\Application\AppSettingsController)->loadSetting();
        try {

			if (!empty($auth))
			{
				return $this->repo->getSchools($params, isset( $setting['business_load_limit']) ? $setting['business_load_limit'] : 5);
			}

			return 0;

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}
	
	public function loadCompanies()
	{
		$params = sanitizeInput($this->app->request()->query->all());
		$auth = $this->app->auth();
		$setting = (new \Medians\Settings\Application\AppSettingsController)->loadSetting();

        try {

			if (!empty($auth))
			{
				return $this->repo->getCompanies($params, isset( $setting['business_load_limit']) ? $setting['business_load_limit'] : 5);
			}

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}
	
	
}