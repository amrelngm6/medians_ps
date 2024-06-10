<?php

namespace Medians\Pages\Application;
use Medians\Pages\Infrastructure\PageRepository;
use Medians\Menus\Infrastructure\MenuRepository;
use Medians\Content\Infrastructure\ContentRepository;
use Medians\Pages\Domain\Page;
use Medians\Products\Domain\Product;
use Medians\Categories\Domain\Category;
use Shared\dbaser\CustomController;



use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\StoryDates\Infrastructure\StoryDateRepository;
use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Technologies\Infrastructure\TechnologyRepository;

class PageController extends CustomController 
{

    public $app;

    public $repo;

    public $contentRepo;

    public $menuRepo;
    public $technologyRepo;
    public $categoryRepo;
    public $doctorRepo;
    public $blogRepo;
    public $storyDateRepo;
    public $storyRepo;
    public $specsRepo;

    function __construct()
    {
        $this->app = new \Config\APP;
        $this->repo = new PageRepository;
        $this->contentRepo = new ContentRepository;
        $this->menuRepo = new MenuRepository;
		
		$this->specsRepo = new SpecializationRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->blogRepo = new BlogRepository();
		$this->doctorRepo = new DoctorRepository();
		$this->storyDateRepo = new StoryDateRepository();
		$this->storyRepo = new StoryRepository();
		$this->technologyRepo = new TechnologyRepository();
    }
    

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "page_id", 'text'=> "#"],
            [ 'value'=> "title", 'text'=> translate('Title'), 'sortable'=> true ],
            [ 'value'=> "lang_content.prefix", 'text'=> translate('link'), 'sortable'=> true ],
            [ 'value'=> "homepage", 'text'=> translate('Is Homepage'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status'), 'sortable'=> true ],
            [ 'value'=> "builder", 'text'=> translate('Page Builder'), 'sortable'=> true ],
			['value'=>'edit', 'text'=>translate('Edit')],
			['value'=>'delete', 'text'=>translate('Delete')],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable () 
	{

		return [
            [ 'key'=> "page_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "title", 'title'=> translate('Title'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "prefix", 'title'=> translate('prefix'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "homepage", 'title'=> translate('Is Homepage'), 'fillable'=> true, 'column_type'=>'checkbox' ],
            [ 'value'=> "builder", 'text'=> translate('Page Builder'), 'sortable'=> true ],
            [ 'key'=> "status", 'title'=> translate('Status'), 'fillable'=> true, 'column_type'=>'checkbox' ],
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
		        'title' => translate('Pages'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
				'object_name' => 'Page',
				'object_key' => 'page_id',
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



    
	public function store() 
	{

		$params = $this->app->params();

        try {	

			if (!trim($params['title']))
			{
				throw new \Exception(json_encode(['error'=>'Empty title']));
			}

        	$params['created_by'] = $this->app->auth()->id;
        	$params['content'] = $this->handleLangs($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	$returnData = json_encode(array('result'=>$e->getMessage(), 'error'=>1));
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->params();

        try {

        	$params['status'] = isset($params['status']) ? $params['status'] : null;
        	$params['homepage'] = isset($params['homepage']) ? $params['homepage'] : null;

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

        	$check = $this->repo->find($params['page_id']);

            if ($this->repo->delete($params['page_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }

	}

	public function validate($params) 
	{
		if (empty($params['content']['en']['title']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('NAME_EMPTY'), 'error'=>1)), 1);
		}
	}
	

	public function handleLangs($params) 
	{
		$langsRepo = new \Medians\Languages\Infrastructure\LanguageRepository();
		$langs = $langsRepo->getActive();
		$fields = [];
		foreach ($langs as $row) 
		{
			$fields[$row->language_code] = ["title"=> $params['title']];
		}
		return $fields;	
	}



    
    
    /**
     * Homepage for frontend
     */
    public function homepage()
    {
		
        $page = $this->repo->homepage();

		$settings = $this->app->SystemSetting();

		try {
			
            return render('views/front/'.($settings['template'] ?? 'default').'/page.html.twig', [
                'title' => translate('Homepage'),
                'page' => $page,
                'item' => $page,
				'specializations' => $this->specsRepo->get_root(),
				// 'story_dates' => $this->storyDateRepo->get(),
				'stories' => $this->storyRepo->get(3),
				'all_stories' => $this->storyRepo->get(),
				'doctors' => $this->doctorRepo->getHome(3),
	        	'headerPosition'=> 'lg-fixed',
				'blog' => $this->blogRepo->getFront(3),
				'all_technologies' => $this->technologyRepo->get(),
            ]);
            
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
    }


	/**
	 * Model object 
	 */
	public function find($prefix)
	{
	
		$item = $this->contentRepo->find($prefix);
		if ($item) { return $item;}

		$newPrefix = !empty($_SERVER['SCRIPT_URL']) ? explode('/', $_SERVER['SCRIPT_URL']) : explode('/',  !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REDIRECT_URL']);

		return $this->contentRepo->find($newPrefix[1]);
	}



    /**
     * Sub-pages for frontend
     */
    public function view_page($object)
    {

		try {
        	
			$item = $this->repo->find($object->item_id);
			$item->content = $object;

            return render('views/front/'.($settings['template'] ?? 'default').'/page.html.twig', [
                'page' => $item,
		        'item' => $item,
				'specializations' => $this->specsRepo->get_root(),
				// 'story_dates' => $this->storyDateRepo->get(),
				'stories' => $this->storyRepo->get(3),
				'all_stories' => $this->storyRepo->get(),
				'doctors' => $this->doctorRepo->getHome(3),
				'blog' => $this->blogRepo->getFront(3),
				'all_technologies' => $this->technologyRepo->get(),
            ]);
            
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
    }

	
    /**
     * Sub-pages for frontend
     */
    public function page($prefix)
    {
		
        $pageContent = $this->find(urldecode($prefix));

		try {

			return $this->handlePageObject($pageContent);
           
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
    }

	public function handlePageObject($pageContent)
	{
		if (isset($pageContent->item_type))
		{
			$_SESSION['lang'] = $pageContent->lang;


			switch ($pageContent->item_type) {
				
				case \Medians\Specializations\Domain\Specialization::class:
					return (new  \Medians\Specializations\Application\SpecializationController)->page($pageContent);
					break;
				
				case \Medians\Doctors\Domain\Doctor::class:
					return (new  \Medians\Doctors\Application\DoctorController)->page($pageContent);
					break;
				
				case \Medians\Blog\Domain\Blog::class:
					return (new  \Medians\Blog\Application\BlogController)->page($pageContent);
					break;
					
				case \Medians\Categories\Domain\Category::class:
					return (new  \Medians\Blog\Application\BlogController)->category($pageContent);
					break;
				
				case \Medians\Pages\Domain\Page::class:
					return (new  \Medians\Pages\Application\PageController)->view_page($pageContent);
					break;
				
				case \Medians\OnlineConsultations\Domain\OnlineConsultation::class:
					return (new  \Medians\OnlineConsultations\Application\OnlineConsultationController)->list($pageContent);
					break;
				
				case \Medians\Offers\Domain\Offer::class:
					return (new  \Medians\Offers\Application\OfferController)->list($pageContent);
					break;
				
				case \Medians\Technologies\Domain\Technology::class:
					return (new  \Medians\Technologies\Application\TechnologyController)->list($pageContent);
					break;
			}
		}

		return throw new \Exception(translate('Page not found'), 1);
		
	}
    
}