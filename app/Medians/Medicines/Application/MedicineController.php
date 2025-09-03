<?php

namespace Medians\Medicines\Application;
use Shared\dbaser\CustomController;

use Medians\Medicines\Infrastructure\MedicineRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;

class MedicineController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $blogRepo;
	protected $storiesRepo;
	protected $categoryRepo;
	protected $doctorRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new MedicineRepository();
		$this->blogRepo = new BlogRepository();
		$this->storiesRepo = new StoryRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->doctorRepo = new DoctorRepository();
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
            [ 'value'=> "author.title", 'text'=> translate('Author'), 'sortable'=> true ],
            [ 'value'=> "sorting", 'text'=> translate('Sort'), 'sortable'=> true ],
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
			[ 'key'=> "title", 'title'=> translate('Title'), 'fillable'=> true,'column_type'=>'text' ],
			[ 'key'=> "category_id", 'title'=> translate('Category'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 'column_key' => 'category_id', 'required'=>false, 'withLabel'=>true, 
				'data' => $this->categoryRepo->get()
			],
            // [ 'key'=> "sorting", 'title'=> translate('sorting'), 'fillable'=>true,  'column_type'=>'number' ],
            // [ 'key'=> "sorting_ar", 'title'=> translate('Sorting AR'), 'fillable'=>true,  'column_type'=>'number' ],
			[ 'key'=> "inserted_by", 'title'=> translate('Author'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 'column_key' => 'id', 'required'=>false, 'withLabel'=>true, 
				'data' => $this->doctorRepo->get()
			],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=>true, 'column_type'=>'checkbox' ],

			[ 'key'=> "picture", 'title'=> translate('picture'), 'required'=>true, 'fillable'=> true, 'column_type'=>'picture' ],


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
			'title' => translate('Medicines'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->getAll(),
			'object_name' => 'Medicine',
			'object_key' => 'id',
		]);
	}





	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	
			
			$params['content'] = ['arabic'=>['title'=>$params['title'], 'content'=>' '], 'english'=>['title'=>$params['title'], 'content'=>' ']];
        	$params['status'] = !empty($params['status']) ? 'on' : 0;
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

			$requestUri = explode('/', $_SERVER['REQUEST_URI']);

			return render('views/front/'.($settings['template'] ?? 'default').'/medicine.html.twig', [
				'noindex' => $this->filterHeadIndexMeta($item),
		        'item' => $this->repo->filterShortCode($item),
				'medicines' => $this->repo->get_root(),
		        'stories' => $this->storiesRepo->random(1),
		        'similar_articles' => $this->blogRepo->similar($item, 3),
				'ogType' => 'article',
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 


}
