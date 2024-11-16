<?php

namespace Medians\Forum\Application;
use Shared\dbaser\CustomController;

use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Forum\Infrastructure\ForumRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Offers\Infrastructure\OfferRepository;
use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\Blog\Infrastructure\BlogRepository;

use \libphonenumber\PhoneNumberUtil;
use \libphonenumber\PhoneNumberFormat;
use \libphonenumber\PhoneNumberType;


class ForumController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $blogRepo;
	protected $specsRepo;
	protected $doctorRepo;
	protected $categoryRepo;
	protected $offersRepo;
	protected $storiesRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new ForumRepository();
		$this->blogRepo = new BlogRepository();
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
            [ 'value'=> "id", 'text'=> "#"],
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
			'title' => translate('Forum'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->get(),
			'object_name' => 'Forum',
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
	        'categories' => $this->categoryRepo->get('Medians\Forum\Domain\Forum'),
	    ]);

	}



	public function edit($id ) 
	{
		try {
				
				// print_r($this->repo->find($id));
			return render('views/admin/blog/blog.html.twig', [
		        'title' => translate('edit_blog'),
		        'langs_list' => ['ar','en'],
		        'item' => $this->repo->find($id),
		        'categories' => $this->categoryRepo->get('Medians\Forum\Domain\Forum'),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

			$params['customer_name'] = !empty($params['customer_name']) ? 'on' : 0;
			$params['customer_email'] = !empty($params['customer_email']) ? 'on' : 0;
			$params['customer_phone'] = !empty($params['customer_phone']) ? 'on' : 0;
			$params['contact_phone'] = !empty($params['contact_phone']) ? 'on' : 0;
			$params['contact_email'] = !empty($params['contact_email']) ? 'on' : 0;
			$params['status'] = 0;
        	
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
				

		try {
					
			// Create an instance of PhoneNumberUtil
			$phoneNumberUtil = PhoneNumberUtil::getInstance();

			$number = $params['mobile_key'] . $params['mobile'];

			if (empty($params['customer_phone']))
			{
				throw new \Exception(translate("Mobile is required"), 1);
			}
			
			// Parse the phone number
			$phoneNumber = $phoneNumberUtil->parse($number, $params['mobile_country']);

			// Validate the phone number
			$isValid = $phoneNumberUtil->isValidNumber($phoneNumber);

			// Get the phone number in a standardized format
			$formattedPhoneNumber = $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);

			// Get the type of phone number (Mobile, Fixed Line, etc.)
			$numberType = $phoneNumberUtil->getNumberType($phoneNumber);

			if (!$isValid)
			{
				throw new \Exception(translate("MOBILE_ERR"), 1);
			}

		} catch (\Exception $e) {
        	throw new \Exception($e->getMessage(), 1);
		}

	}


	
    /**
     * Create Forum Post
     */
    public function forum_post_form()
    {
		try {
        	
			$settings = $this->app->SystemSetting();

            return render('views/front/'.($settings['template'] ?? 'default').'/post_form.html.twig', []);
            
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
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

			return render('views/front/'.($settings['template'] ?? 'default').'/forum_post.html.twig', [
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
	 * Forum page at Frontend 
	 */
	public function list()
	{
		$request =  $this->app->request();

		try {
        	
			$settings = $this->app->SystemSetting();

            return render('views/front/'.($settings['template'] ?? 'default').'/forum.html.twig', [
				'items' => $this->repo->get(),
				'specializations' => $this->specsRepo->get_root(),
				'doctors' => $this->doctorRepo->getHome(3),
				'blog' => $this->blogRepo->getFront(3),
            ]);
            
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

}