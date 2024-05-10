<?php
namespace Medians\Blog\Application;

use Shared\dbaser\CustomController;

use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;

class BlogController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $categoryRepo;
	

	function __construct()
	{

		$this->repo = new BlogRepository();
		$this->categoryRepo = new CategoryRepository();
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
            ],
            [
                'key'=> "title",
                'title'=> __('title'),
                'sortable'=> true,
            ],
            [
                'key'=> "category_name",
                'title'=> __('category'),
                'sortable'=> false,
            ],
            [
                'key'=> "date",
                'title'=> __('Date'),
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
			
		    return render('blog', [
		        'load_vue' => true,
		        'title' => __('blog'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function store() 
	{

		$params = $this->app->params();

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

		$params = $this->app->params();

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



}