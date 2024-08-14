<?php

namespace Medians\OnlineConsultations\Application;
use Shared\dbaser\CustomController;

use Medians\OnlineConsultations\Infrastructure\OnlineConsultationRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\Specializations\Infrastructure\SpecializationRepository;

class OnlineConsultationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $specsRepo;
	protected $doctorRepo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new OnlineConsultationRepository();

		$this->specsRepo = new SpecializationRepository();

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
            [ 'value'=> "doctor.title", 'text'=> translate('Doctor'), 'sortable'=> true ],
            [ 'value'=> "sorting", 'text'=> translate('Sorting'), 'sortable'=> true ],
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
			[ 'key'=> "doctor_id", 'title'=> translate('Doctor'), 
				'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 'column_key' => 'id', 'required'=>true, 'withLabel'=>true, 
				'data' => $this->doctorRepo->get()
			],
            [ 'key'=> "consultation_sessions_count", 'title'=> translate('Sessions count'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "consultation_sessions_time", 'title'=> translate('Sessions time'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "consultation_speciality", 'title'=> translate('Speciality'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "consultation_old_price", 'title'=> translate('old price'), 'fillable'=>true, 'custom_field'=>true, 'column_type'=>'number' ],
            [ 'key'=> "sorting", 'title'=> translate('sorting'), 'fillable'=>true, 'column_type'=>'number' ],
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
			'title' => translate('online_consultation'),
			'columns' => $this->columns(),
			'fillable' => $this->fillable(),
			'items' => $this->repo->get(),
			'doctors' => $this->doctorRepo->get(),
			'object_name' => 'OnlineConsultation',
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
        	throw new \Exception($e->getMessage(), 1);
        	
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

		if (empty($params['doctor_id']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('Doctor_required'), 'error'=>1)), 1);
		}

	}


	/**
	 * Front page 
	 * @var Int
	 */
	public function list($pageinfo)
	{

		try {

			$explode = explode('/',  !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REDIRECT_URL']);
			
			if (!empty($explode[2]))
				return $this->page($explode[2]);

			$items = $this->repo->get();
			$this->repo->getModel()->addView();
			$settings = $this->app->SystemSetting();

		    
			return render('views/front/'.($settings['template'] ?? 'default').'/online_consultations.html.twig', [
		        'items' => $items,
				'specializations' => $this->specsRepo->get_root(),
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
	public function page($pageNum)
	{

		try {
			
			$item = $this->repo->find($pageNum);
			// $item->addView();
			$settings = $this->app->SystemSetting();

			return render('views/front/'.($settings['template'] ?? 'default').'/online_consultation.html.twig', [
		        'item' => $item,
		    ]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	} 

}
