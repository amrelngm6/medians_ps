<?php

namespace Medians\Specializations\Application;
use Shared\dbaser\CustomController;

use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Stories\Infrastructure\StoryRepository;


class SpecializationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $blogRepo;
	protected $storiesRepo;
	protected $categoryRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new SpecializationRepository();
		$this->blogRepo = new BlogRepository();
		$this->storiesRepo = new StoryRepository();
		$this->categoryRepo = new CategoryRepository();
	}


	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "id", 'text'=> "#"],
            [ 'value'=> "content.title", 'text'=> translate('Title'), 'sortable'=> true ],
            [ 'value'=> "sorting", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "builder", 'text'=> translate('Page Builder'), 'sortable'=> true ],
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
			[ 'key'=> "parent_id", 'title'=> translate('Main category'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 'column_key' => 'id', 'required'=>false, 'withLabel'=>true, 
				'data' => $this->repo->get()
			],
            [ 'key'=> "sorting", 'title'=> translate('sorting'), 'fillable'=>true,  'column_type'=>'number' ],
            [ 'key'=> "sorting_ar", 'title'=> translate('Sorting AR'), 'fillable'=>true,  'column_type'=>'number' ],
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
			'title' => translate('Specializations'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->get(),
			'object_name' => 'Specialization',
			'object_key' => 'id',
		]);
	}





	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['created_by'] = $this->app->auth()->id;
        	$params['branch_id'] = $this->app->branch->id;
        	

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
		$params = $this->app->request()->get('params');

        try {

        	// $params['status'] = !empty($params['status']) ? $params['status'] : 0;

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

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['id']);


            if ($this->repo->delete($params['id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{


	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function page($contentObject)
	{

		try {
				
			$item = $this->repo->find($contentObject->item_id);

			// $item->addView();
			$settings = $this->app->SystemSetting();

			return render('views/front/'.($settings['template'] ?? 'default').'/specialization.html.twig', [
				'noindex' => (count(array_filter(explode('/', $_SERVER['REQUEST_URI']))) > 1) ? true : false,
		        'item' => $this->repo->filterShortCode($item),
				'specializations' => $this->repo->get_root(),
		        'stories' => $this->storiesRepo->random(1),
		        'similar_articles' => $this->blogRepo->similar($item, 3),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 


}
