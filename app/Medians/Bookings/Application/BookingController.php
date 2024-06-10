<?php

namespace Medians\Bookings\Application;
use Shared\dbaser\CustomController;

use Medians\Bookings\Infrastructure\BookingRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\Specializations\Infrastructure\SpecializationRepository;


class BookingController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $categoryRepo;
	protected $blogRepo;
	protected $doctorRepo;
	protected $specsRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new BookingRepository();
		$this->blogRepo = new BlogRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->doctorRepo = new DoctorRepository();
		$this->specsRepo = new SpecializationRepository();
	}



	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{
		return [
            [ 'value'=> "id", 'text'=> "#"],
            [ 'value'=> "date", 'text'=> translate('date'), 'sortable'=> true ],
            [ 'value'=> "name", 'text'=> translate('name'), 'sortable'=> true ],
            [ 'value'=> "full_mobile", 'text'=> translate('mobile'), 'sortable'=> true ],
            [ 'value'=> "email", 'text'=> translate('email'), 'sortable'=> true ],
            [ 'value'=> "class", 'text'=> translate('class'), 'sortable'=> true ],
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
			[ 'key'=> "name", 'title'=> translate('name'),  'disabled'=> true, 'column_type'=>'text' ],
			[ 'key'=> "email", 'title'=> translate('email'),  'disabled'=> true, 'column_type'=>'text' ],
            [ 'key'=> "mobile", 'title'=> translate('mobile'),  'disabled'=> true, 'custom_field'=>true, 'column_type'=>'phone' ],
            [ 'key'=> "mobile_country", 'title'=> translate('Country'), 'disabled'=> true, 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "mobile_key", 'title'=> translate('Country code'),'disabled'=> true,  'fillable'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "specialization", 'title'=> translate('specialization'), 'disabled'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
			[ 'key'=> "offer.title", 'title'=> translate('Plan'), 'disabled'=> true, 'column_type'=>'text' ],
			[ 'key'=> "consultation.doctor_name", 'title'=> translate('Consultation Dr'), 'disabled'=> true, 'column_type'=>'text' ],
            [ 'key'=> "msg", 'title'=> translate('msg'), 'disabled'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
            [ 'key'=> "notes", 'title'=> translate('Notes'), 'disabled'=>true, 'custom_field'=>true, 'column_type'=>'text' ],
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
	public function index($type = 'Booking') 
	{
		
		return render('data_table', 
		[
			'load_vue' => true,
			'title' => translate('bookings'),
			'columns' => $this->columns($type),
			'fillable' => $this->fillable($type),
			'items' => $this->repo->get($type),
			'doctors' => $this->doctorRepo->get(),
			'no_create' => true,
			'object_name' => 'Booking',
			'object_key' => 'id',
		]);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index_offers() 
	{
		
		try {
			
		    return $this->index('Offers');

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index_consultation() 
	{
		
		try {
			
		    return $this->index('OnlineConsultation');

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index_contact() 
	{
		
		try {
			
		    return $this->index('Contact');

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}




	public function store() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['branch_id'] = $this->app->branch->id;
        	
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

        	$params['status'] = !empty($params['status']) ? $params['status'] : 0;

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

		if (empty($params['name']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('NAME_EMPTY'), 'error'=>1)), 1);
		}
	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function page($id)
	{

		try {

			$item = $this->repo->find($id);
			$this->repo->getModel()->addView();
			
			if (!empty($item))
				$item->addView();
				$settings = $this->app->SystemSetting();

			return render('views/front/'.($settings['template'] ?? 'default').'/booking_details.html.twig', [
		        'item' => $item,
				'specializations' => $this->specsRepo->get_root()
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 


	/**
	 * Front page 
	 * @var Int
	 */
	public function thanks_page()
	{

		try {
			$settings = $this->app->SystemSetting();

		    // return  render('login', [
			return render('views/front/'.($settings['template'] ?? 'default').'/booking_details.html.twig', [
		        'item' => [],
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 




}
