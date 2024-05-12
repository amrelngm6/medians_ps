<?php
namespace Medians\Products\Application;

use Shared\dbaser\CustomController;

use Medians\Products\Infrastructure\ProductRepository;
use Medians\Products\Infrastructure\CategoryRepository;
use Medians\Brands\Infrastructure\BrandRepository;
use Medians\Shipping\Infrastructure\ShippingRepository;

class ProductController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $brandRepo;

	public $categoryRepo;

	public $shippingRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new ProductRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->brandRepo = new BrandRepository();
		$this->shippingRepo = new ShippingRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "product_id", 'text'=> "#"],
            [ 'value'=> "lang_content.title", 'text'=> translate('product_name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> translate('picture'), 'sortable'=> true ],
            [ 'value'=> "category.name", 'text'=> translate('Category'), 'sortable'=> true ],
            [ 'value'=> "path", 'text'=> translate('Path'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('Status'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> translate('Edit') ],
            [ 'value'=> "delete", 'text'=> translate('Delete') ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
	}

	

	/**
	 * Admin index items
	 * 
	 */ 
	public function index( ) 
	{
		try {

			return render('products', [
		        'load_vue' => true,
		        'title' => translate('Products'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'fillable_category' => (new CategoryController())->fillable(),

		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	 * Admin product page
	 * 
	 */ 
	public function product( $product_id ) 
	{
		try {

			$item = $this->repo->find($product_id);

			return render('products', [
		        'load_vue' => true,
		        'title' => translate('Product page'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'item' => $item,
		        'categories' => $this->categoryRepo->list($item->parent_id),
		        'brands' => $this->brandRepo->get(),
		        'shipping' => $this->shippingRepo->get(),
		        'fillable_category' => (new CategoryController())->fillable(),

		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	 * Admin create product page
	 * 
	 */ 
	public function create( ) 
	{
		try {

			return render('products', [
		        'load_vue' => true,
		        'title' => translate('Products'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'categories' => $this->categoryRepo->list(),
		        'brands' => $this->brandRepo->get(),
		        'shipping' => $this->shippingRepo->get(),
		        'fillable_category' => (new CategoryController())->fillable(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	 * getProduct
	 */
	public function getProduct($id)
	{
		$data =  $this->repo->find($id);

		echo  json_encode($data);
	}


	public function store() 
	{	

		$params = $this->app->request()->get('params');

        try {	
			
			$user = $this->app->auth();

			// Administrator user id
			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;
        	$params['user_id'] = $user->id;
        	$params['user_type'] = get_class($user);

			try {
				
				$returnData = (!empty($this->repo->store($params))) 
				? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
				: array('success'=>0, 'result'=>'Error', 'error'=>1);
	
			} catch (\Throwable $th) {
				return array('error'=>$th->getMessage());
			}

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

			$params['status'] = (isset($params['status']) && $params['status'] != 'false') ? 'on' : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['product_id']);


            if ($this->repo->delete($params['product_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}



	/**
	 * Ajax load productsby with filters
	 */
	public function load_products()
	{
		$params = $this->app->request()->get('params');
		echo render('/views/front/blocks/category_product.html.twig', [
			'products'=> $this->repo->getWithFilter($params)
		]);
	}
}