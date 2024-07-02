<?php

namespace Medians\Doctors\Application;
use Shared\dbaser\CustomController;

use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Offers\Infrastructure\OfferRepository;


class DoctorController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $specsRepo;
	protected $offersRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new DoctorRepository();
		$this->specsRepo = new SpecializationRepository();
		$this->offersRepo = new OfferRepository();
	}


	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "id", 'text'=> "#"],
            [ 'value'=> "picture", 'text'=> translate('picture'), 'sortable'=> false ],
            [ 'value'=> "title", 'text'=> translate('Name'), 'sortable'=> true ],
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
			[ 'key'=> "title", 'title'=> translate('Title'), 'required'=>true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "booking_price", 'title'=> translate('booking_price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "short_name", 'title'=> translate('Short name'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "short_name_ar", 'title'=> translate('Short name ar'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "evening_booking", 'title'=> translate('evening_booking'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "afternoon_booking", 'title'=> translate('afternoon_booking'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "profile_link", 'title'=> translate('profile_link'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "booking_days", 'title'=> translate('booking_days'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "twitter_url", 'title'=> translate('Twitter_url'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "instagram_url", 'title'=> translate('Instagram_url'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "facebook_url", 'title'=> translate('facebook_url'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
			[ 'key'=> "price_eg", 'title'=> translate('EG price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "price_ly", 'title'=> translate('Libya price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "price_sd", 'title'=> translate('Sudan price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "branches", 'title'=> translate('Branches'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
			[ 'key'=> "picture", 'title'=> translate('Picture'), 'required'=>true, 'fillable'=> true, 'column_type'=>'picture' ],
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
			'title' => translate('doctors'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->getAll(),
			'object_name' => 'Doctor',
			'object_key' => 'id',
		]);
	}


	/**
	 * Store item to database
	 */ 
	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	/**
	 * Update item at database
	 */ 
	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	/**
	 * Remove item from database
	 */ 
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

	/**
	 * Validate store
	 */ 
	public function validate($params) 
	{

		if (empty($params['title']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('NAME_required'), 'error'=>1)), 1);
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
			$specs = $this->specsRepo->similar($item, 2);

			$item->addView();
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/doctor.html.twig', [
		        'item' => $item,
		        'offers' => $this->offersRepo->random(1),
		        'specializations' => count($specs) ? $specs : $this->specsRepo->get(2),
		        'similar' => $this->repo->similar($item, 1),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

	/**
	 * Front page for items list
	 * @var Int
	 */
	public function list()
	{

		try {
			$this->repo->getModel()->addView();
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/doctors.html.twig', [
		        'items' => $this->repo->get(12),
		        'specializations' => $this->specsRepo->get(),
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}
