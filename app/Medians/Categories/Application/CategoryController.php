<?php

namespace Medians\Categories\Application;
use \Shared\dbaser\CustomController;

use Medians\Categories\Infrastructure\CategoryRepository;


class CategoryController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;
	

	

	function __construct()
	{

		$this->repo = new CategoryRepository();
		
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( $model ) 
	{

	    return render('categories', [
	        'load_vue' => true,
	        'title' => __('categories'),
	        'model' => $model,
	        'categories' => $this->repo->get($model),
	    ]);

	}



	public function store() 
	{

		$this->app = new \config\APP;

		$params = $this->app->params();

        try {	

        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function update()
	{

		$this->app = new \config\APP;

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


		$this->app = new \config\APP;

		$params = $this->app->params();
		
        try {

            if ($this->repo->delete($params['id']))
            {
                return array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1);
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{

		if (empty($params['model']))
		{
        	throw new \Exception(json_encode(array('result'=>__('model_required'), 'error'=>1)), 1);
		}

		if (empty($params['name']))
		{
        	throw new \Exception(json_encode(array('result'=>__('NAME_EMPTY'), 'error'=>1)), 1);
		}

	}

}
