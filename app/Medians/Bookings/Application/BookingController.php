<?php

namespace Medians\Bookings\Application;
use Shared\dbaser\CustomController;

use Medians\Bookings\Infrastructure\BookingRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;


class BookingController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new BookingRepository();
		$this->blogRepo = new BlogRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->doctorRepo = new DoctorRepository();
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
                'key'=> "date",
                'title'=> __('date'),
                'sortable'=> false,
            ],
            [
                'key'=> "name",
                'title'=> __('Name'),
                'sortable'=> true,
			],
            [
                'key'=> "full_mobile",
                'title'=> __('mobile'),
                'sortable'=> false,
            ],
            [
                'key'=> "email",
                'title'=> __('email'),
                'sortable'=> false,
            ],
            [
                'key'=> "class",
                'title'=> __('Type'),
                'sortable'=> false,
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
	public function index( $type = 'Booking') 
	{
		
		try {
			
		    return render('bookings', [
		        'load_vue' => true,
		        'title' => __('bookings'),
		        'columns' => $this->columns(),
		        'items' => $this->repo->get($type),
		    ]);
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

		if (empty($params['name']))
		{
        	throw new \Exception(json_encode(array('result'=>__('NAME_EMPTY'), 'error'=>1)), 1);
		}
	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function page($id)
	{

		try {

			$item = $this->doctorRepo->find($id);
			$this->repo->getModel()->addView();
			if (!empty($item))
				$item->addView();
			
			return render('views/front/booking.html.twig', [
		        'doctor' => $item,
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 



	/**
	 * Booking form submit
	 */ 
	public function submit_booking() 
	{

		$params = $this->app->request()->get('params');

        try {	

        	$params['branch_id'] = $this->app->branch->id;
        	
        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}


}
