<?php

namespace Medians\Stories\Application;
use Shared\dbaser\CustomController;

use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Specializations\Infrastructure\SpecializationRepository;


class StoryController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new StoryRepository();
		$this->specsRepo = new SpecializationRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "id", 'text'=> "#"],
            [ 'value'=> "title", 'text'=> translate('Title'), 'sortable'=> true ],
            [ 'value'=> "field.sort", 'text'=> translate('Sorting'), 'sortable'=> true ],
            [ 'value'=> "builder", 'text'=> translate('Page Builder'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
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
            [ 'key'=> "id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "video_link", 'title'=> translate('Youtube Video'), 'fillable'=>true,  'custom_field'=>true,  'column_type'=>'text' ],
            [ 'key'=> "short_name", 'title'=> translate('Short name'), 'fillable'=>true,  'custom_field'=>true,  'column_type'=>'text' ],
            [ 'key'=> "short_name_ar", 'title'=> translate('Short name ar'), 'fillable'=>true,  'custom_field'=>true,  'column_type'=>'text' ],
            [ 'key'=> "sort", 'title'=> translate('Short name ar'), 'fillable'=>true,  'custom_field'=>true,  'column_type'=>'number' ],
			[ 'key'=> "picture", 'title'=> translate('picture'), 'required'=>true, 'fillable'=> true, 'column_type'=>'picture' ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=>true, 'column_type'=>'checkbox' ],

        ];
	}
	

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */
	public function index() 
	{
		
		return render('data_table', 
		[
			'load_vue' => true,
			'title' => translate('Success Stories'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->get(),
			'object_name' => 'Story',
			'object_key' => 'id',
		]);
	}





	public function store() 
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {	

        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function update()
	{

		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;
            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request". $e->getMessage(), 1);
        	
        }

	}


	public function delete() 
	{


		$this->app = new \config\APP;

		$params = $this->app->request()->get('params');
		
        try {

            if ($this->repo->delete($params['id']))
            {
                return array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1);
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function validate($params) 
	{

		if (empty($params['field']['video_link']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('Video is required'), 'error'=>1)), 1);
		}

		if (empty($params['field']['short_name_ar']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('Arabic title is required'), 'error'=>1)), 1);
		}

	}


}
