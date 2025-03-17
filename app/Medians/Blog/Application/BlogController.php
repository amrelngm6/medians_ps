<?php

namespace Medians\Blog\Application;
use Shared\dbaser\CustomController;

use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Offers\Infrastructure\OfferRepository;
use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;


class BlogController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $specsRepo;
	protected $doctorRepo;
	protected $categoryRepo;
	protected $offersRepo;
	protected $storiesRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new BlogRepository();
		$this->specsRepo = new SpecializationRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->offersRepo = new OfferRepository();
		$this->storiesRepo = new StoryRepository();
		$this->doctorRepo = new DoctorRepository();


	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "id", 'text'=> "#", 'sortable'=> true ],
            [ 'value'=> "content.title", 'text'=> translate('Title'), 'sortable'=> true ],
            [ 'value'=> "category.name", 'text'=> translate('Category'), 'sortable'=> true ],
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
			
			[ 'key'=> "title", 'title'=> translate('Title'), 'fillable'=> true,'column_type'=>'text' ],
			[ 'key'=> "created_by", 'title'=> translate('Author'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 'column_key' => 'id', 'required'=>false, 'withLabel'=>true, 
				'data' => $this->doctorRepo->get()
			],
			[ 'key'=> "category_id", 'title'=> translate('Category'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 'column_key' => 'category_id', 'required'=>false, 'withLabel'=>true, 
				'data' => $this->categoryRepo->get()
			],
			[ 'key'=> "picture", 'title'=> translate('picture'), 'required'=>true, 'fillable'=> true, 'column_type'=>'picture' ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=>true, 'column_type'=>'checkbox' ],
            [ 'key'=> "noindex", 'title'=> translate('Disable index'), 'fillable'=>true, 'column_type'=>'checkbox' ],

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
			'title' => translate('Blog'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->get(),
			'object_name' => 'Blog',
			'object_key' => 'id',
		]);
	}


	/**
	 * Create new item
	 * 
	 */ 
	public function create() 
	{

		return render('views/admin/blog/create.html.twig', [
	        'title' => translate('add_new'),
	        'langs_list' => ['ar','en'],
	        'categories' => $this->categoryRepo->get('Medians\Blog\Domain\Blog'),
	    ]);

	}



	public function edit($id ) 
	{
		try {
				
			return render('views/admin/blog/blog.html.twig', [
		        'title' => translate('edit_blog'),
		        'langs_list' => ['ar','en'],
		        'item' => $this->repo->find($id),
		        'categories' => $this->categoryRepo->get('Medians\Blog\Domain\Blog'),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['content'] = ['arabic'=>['title'=>$params['title'], 'content'=>' '], 'english'=>['title'=>$params['title'], 'content'=>' ']];
        	
			$params['status'] = !empty($params['status']) ? 'on' : 0;
        	
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
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? 'on' : 0;
        	$params['noindex'] = !empty($params['noindex']) ? 1 : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>0);
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

		// if (empty($params['content']['ar']['title']))
		// {
        // 	throw new \Exception(json_encode(array('result'=>translate('NAME_EMPTY'), 'error'=>1)), 1);
		// }

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
			$settings = $this->app->SystemSetting();

			return render('views/front/'.($settings['template'] ?? 'default').'/article.html.twig', [
		        'item' => $this->repo->filterShortCode($item),
		        'similar_items' => $this->specsRepo->similar($item, 3),
		        'similar_articles' => $this->repo->similar($item, 3),
		        'offers' => $this->offersRepo->random(1),
		        'stories' => $this->storiesRepo->random(1),
				'specializations' => $this->specsRepo->get_root(),
				'noindex' => (count(array_filter(explode('/', $_SERVER['REQUEST_URI']))) > 1) ? true : false
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

		$cather = $this->categoryRepo->find(6);
		$her = $this->repo->getByCategory($cather->category_id, 4);
		$cathim = $this->categoryRepo->find(7);
		$him = $this->repo->getByCategory($cathim->category_id, 4);

		try {
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/blog.html.twig', [
		        'first_item' => $this->repo->getFeatured(1),
		        'search_items' => $request->get('search') ?  $this->repo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
		        'items' => $this->repo->getFront(4),
		        'cat_her' => $her,
		        'cather' => $cather,
		        'cat_him' => $him,
		        'cathim' => $cathim,
				'specializations' => $this->specsRepo->get_root(),
		        'offers' => $this->offersRepo->random(1),

		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 


	/**
	 * Category items-list page 
	 * @var Int
	 */
	public function category($category)
	{
		$request =  $this->app->request();
		$currentPage = $request->get('page') ? $request->get('page') : 1;
		$offset = $currentPage > 1 ? $currentPage * 10 : 0;
		$category_items = $this->repo->paginateByCategory($category->item_id, 10, $offset);
		$pages = (Int) ($this->repo->countByCategory($category->item_id) / 10);
		try {
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/category.html.twig', [
		        'first_item' => $this->repo->getFeatured(1),
		        'search_items' => $request->get('search') ?  $this->repo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
		        'item' => $category,
		        'items' => $category_items,
		        'offers' => $this->offersRepo->random(1),
				'specializations' => $this->specsRepo->get_root(),
		        'stories' => $this->storiesRepo->random(1),
				'offset' => $offset,
				'pages' => array_fill(0,$pages,[]),
				'current_page' => $currentPage,

		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 


	
	/**
	 * Cache page 
	 * @var Int
	 */
	public function cache_page($contentObject)
	{

		try {
			
			$item = $this->repo->find($contentObject->item_id);

			$content = render('views/front/default/article.html.twig', [
		        'item' => $this->repo->filterShortCode($item),
		        'similar_items' => $this->specsRepo->similar($item, 3),
		        'similar_articles' => $this->repo->similar($item, 3),
		        'offers' => $this->offersRepo->random(1),
		        'stories' => $this->storiesRepo->random(1),
				'specializations' => $this->specsRepo->get_root(),
				'noindex' => (count(array_filter(explode('/', $_SERVER['REQUEST_URI']))) > 1) ? true : false
		    ], '');

			$cacheFile = $_SERVER['DOCUMENT_ROOT'].'/app/cache/_'. $object->prefix. '.html';
			file_put_contents($cacheFile,$content);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

}