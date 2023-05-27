<?php

namespace Medians\Pages\Application;

use Medians\Pages\Infrastructure\PageRepository;
use Medians\Content\Infrastructure\ContentRepository;


class PageController
{

	/**
	* @var Object
	*/
	protected $repo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new PageRepository();
		$this->contentRepo = new ContentRepository();
	}


	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [
                'key'=> "id",
                'title'=> "#",
                'type'=> "number",
            ],
            [
                'key'=> "name",
                'title'=> __('name'),
                'sortable'=> true,
            ]
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
			
		    return render('pages', [
		        'load_vue' => true,
		        'title' => __('pages'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}







	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['created_by'] = $this->app->auth()->id;
        	
        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
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

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['id']);


            if ($this->repo->delete($params['id']))
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


	/**
	 * Front page 
	 * @var Int
	 */
	public function page()
	{

		try {
			
			return render('views/front/index.html.twig', []);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 


	/**
	 * Front page 
	 * @var Int
	 */
	public function calculator()
	{

		try {
			
			return render('views/front/includes/calculator.html.twig', [
				'specializations' => $this->specsRepo->get_root(),
				'story_dates' => $this->storyDateRepo->get(),
				'stories' => $this->storyRepo->get(3),
				'doctors' => $this->doctorRepo->get(3),
				'blog' => $this->blogRepo->get(3),
				'blog' => $this->blogRepo->get(3),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 


	/**
	 * Front Search page 
	 * @var Int
	 */
	public function search()
	{
		try {
			$request = $this->app->request();

			return render('views/front/search_results.html.twig', [
		        'search_articles' => (!$request->get('for') || $request->get('for') == 'blog') ? $this->blogRepo->search($request, 10) : [],
		        'search_doctors' => (!$request->get('for') || $request->get('for') == 'doctor') ? $this->doctorRepo->search($request, 10) : [],
		        'search_specs' => (!$request->get('for') || $request->get('for') == 'specialization') ? $this->specsRepo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
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
	 * Model object 
	 */
	public function pages($prefix, $id = 0)
	{
		try 
		{
			$item = $this->find($prefix);
			if ($prefix && empty($item->home))
			{
			    $_SESSION['site_lang'] = (isset($item->lang) && $item->lang == 'ar') ? 'arabic' : 'english';
			}

			if (isset($item->item_type))
			{

		        switch ($item->item_type) 
		        {
		        	case \Medians\Specializations\Domain\Specialization::class:
		        		return (new  \Medians\Specializations\Application\SpecializationController)->page($item);
		        		break;
		        	
		        	case \Medians\Doctors\Domain\Doctor::class:
		        		return (new  \Medians\Doctors\Application\DoctorController)->page($item);
		        		break;
		        	
		        	case \Medians\Blog\Domain\Blog::class:
		        		return (new  \Medians\Blog\Application\BlogController)->page($item);
		        		break;
		        	
		        	case \Medians\Pages\Domain\Page::class:
		        		return (new  \Medians\Pages\Application\PageController)->page($item);
		        		break;
		        	
		        	case \Medians\OnlineConsultations\Domain\OnlineConsultation::class:
		        		return (new  \Medians\OnlineConsultations\Application\OnlineConsultationController)->list($item);
		        		break;
		        	
		        	case \Medians\Offers\Domain\Offer::class:
		        		return (new  \Medians\Offers\Application\OfferController)->list($item);
		        		break;
		        	
		        	default:
		        		// code...
		        		break;
		        }
			}

		        

		} catch (\Exception $e) {
			throw new \Exception( $e->getMessage(), 1);
		}
	} 



	/**
	 * Submit builder requests
	 */ 
	public function updateContent()
	{	

		$request = $this->app->request();
		
		if (!$request->get('section') || !$request->get('content'))			
			return true;

		$content = $request->get('content');
		$section = $request->get('section');
		$page = str_replace('-section', '.html.twig', $section);
		$fileLocation = $_SERVER['DOCUMENT_ROOT'].'/app/views/front/content/'.$page;

		if (!is_file($fileLocation))
			return true;

		file_put_contents($fileLocation, $content);

		echo 'Done';
	}



	/**
	 * Editor page 
	 * @var Int
	 */
	public function editor()
	{
		try {
			
			return render('views/front/editor.html.twig', []);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 


}