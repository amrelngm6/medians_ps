<?php

namespace Medians\Offers\Application;
use Shared\dbaser\CustomController;

use Medians\Offers\Infrastructure\OfferRepository;

class OfferController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;
	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new OfferRepository();
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
			[ 'key'=> "title", 'title'=> translate('title'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "discount", 'title'=> translate('discount'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "old_price", 'title'=> translate('old_price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "price_eg", 'title'=> translate('EG price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "price_ly", 'title'=> translate('Libya price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "price_sd", 'title'=> translate('Sudan price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "icon", 'title'=> translate('icon'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],

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
			'title' => translate('Offers'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->getAll(),
			'object_name' => 'Offer',
			'object_key' => 'id',
		]);
	}



	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['branch_id'] = $this->app->branch->id;
        	$params['title'] = isset($params['content']['en']['title']) ? $params['content']['en']['title'] : '';
        	
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : '0';

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

		if (empty($params['content']['ar']['title']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('NAME_EMPTY'), 'error'=>1)), 1);
		}

	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function list($pageinfo)
	{

		try {

			$items = $this->repo->get();
			$this->repo->getModel()->addView();
			$settings = $this->app->SystemSetting();

			return render('views/front/'.($settings['template'] ?? 'default').'/offers.html.twig', [
		        'items' => $items,
		        'pageinfo' => $pageinfo,
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

	/**
	 * Front page 
	 * @var Int
	 */
	public function page($id=null)
	{

		try {
			$item = $this->repo->find($id);
			$item->addView();
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/offer.html.twig', [
		        'item' => $item,
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}
