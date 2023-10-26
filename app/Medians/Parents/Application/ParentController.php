<?php
namespace Medians\Parents\Application;

use Shared\dbaser\CustomController;

use Medians\Parents\Infrastructure\ParentRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class ParentController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new ParentRepository();
		$this->categoryRepo = new CategoryRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "parent_id", 'title'=> "#"],
            [ 'key'=> "name", 'title'=> __('Name'), 'sortable'=> true ],
            [ 'key'=> "email", 'title'=> __('Email'), 'sortable'=> true ],
            [ 'key'=> "mobile", 'title'=> __('Mobile'), 'sortable'=> false ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "parent_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('Email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "mobile", 'title'=> __('mobilecontact_number'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "password", 'title'=> __('Password'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'password' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'file' ],
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
			
		    return render('parents', [
		        'load_vue' => true,
		        'title' => __('Parent'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	/**
	 * Create new item
	 * 
	 */ 
	public function create() 
	{

		return render('views/admin/Student/create.html.twig', [
	        'title' => __('add_new'),
	        'langs_list' => ['ar','en'],
	        'categories' => $this->categoryRepo->get('Medians\Parents\Domain\Student'),
	    ]);

	}



	public function edit($id ) 
	{
		try {
				
			return render('views/admin/Student/Student.html.twig', [
		        'title' => __('edit_Student'),
		        'langs_list' => ['ar','en'],
		        'item' => $this->repo->find($id),
		        'categories' => $this->categoryRepo->get('Medians\Parents\Domain\Student'),
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

        	$check = $this->repo->find($params['parent_id']);


            if ($this->repo->delete($params['parent_id']))
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
	public function page($contentObject)
	{

		try {
			
			$item = $this->repo->find($contentObject->item_id);
			$item->addView();

			return render('views/front/page.html.twig', [
		        'item' => $item,
		        'similar_articles' => $this->repo->similar($item, 3),
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

		try {
				
			return render('views/front/Student.html.twig', [
		        'first_item' => $this->repo->getFeatured(1),
		        'search_items' => $request->get('search') ?  $this->repo->search($request, 10) : [],
		        'search_text' => $request->get('search'),
		        'items' => $this->repo->get(4),
		        'cat_her' => $this->repo->getByCategory(6, 4),
		        'cat_him' => $this->repo->getByCategory(7, 4),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}