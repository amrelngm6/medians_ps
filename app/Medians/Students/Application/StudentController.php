<?php
namespace Medians\Students\Application;

use Shared\dbaser\CustomController;

use Medians\Students\Infrastructure\StudentRepository;
use Medians\Parents\Infrastructure\ParentRepository;

class StudentController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	public $parentRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new StudentRepository();
		$this->parentRepo = new ParentRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "student_id", 'text'=> "#"],
            [ 'value'=> "first_name", 'text'=> __('first_name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> __('picture'),  ],
            [ 'value'=> "parent.first_name", 'text'=> __('parent_name'), 'sortable'=> true ],
            [ 'value'=> "route.route_name", 'text'=> __('route'), 'sortable'=> true ],
            [ 'value'=> "contact_number", 'text'=> __('contact_number'), 'sortable'=> true ],
            [ 'value'=> "edit", 'text'=> __('edit')  ],
            [ 'value'=> "delete", 'text'=> __('delete')  ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "student_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "parent_id", 'title'=> __('Parent'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'parent_name', 
				'data' => $this->parentRepo->get()  
			],
            [ 'key'=> "first_name", 'title'=> __('first_name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "last_name", 'title'=> __('last_name'), 'fillable'=>true, 'column_type'=>'text' ],
            [ 'key'=> "transfer_status", 'title'=> __('Transfer status'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
				'data' => [['transfer_status'=>'Approved','title'=>__('Approved')], ['transfer_status'=>'Pending','title'=>__('Pending')]]  
			],
            [ 'key'=> "contact_number", 'title'=> __('contact_number'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "date_of_birth", 'title'=> __('date_of_birth'), 'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=>true, 'column_type'=>'file' ],
            [ 'key'=> "status", 'title'=> __('Status'), 'fillable'=>true, 'column_type'=>'checkbox' ],
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
			
		    return render('students', [
		        'load_vue' => true,
		        'title' => __('Student'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function validate($params) 
	{

		if (empty($params['first_name']))
		{
			throw new \Exception(__('NAME_EMPTY'), 0);
		}

		if (empty($params['parent_id']))
		{
			throw new \Exception(__('parent_required'), 0);
		}

		if (empty($params['contact_number']))
		{
			throw new \Exception(__('MOBILE_ERR'), 0);
		}

	}



	public function store() 
	{

		$params = $this->app->params();

        try {	

			try {
				
				$this->validate($params);

			} catch (\Exception $e) {
	        	return array('result'=>$e->getMessage(), 'error'=>1);
			}

        	$params['created_by'] = $this->app->auth()->id;
        	$params['status'] = isset($params['status']) ? 1 : 0;
        	

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (\Exception $es) {
        	return array('result'=>$es->getMessage(), 'error'=>1);
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->params();

        try {

        	$params['status'] = !empty($params['status']) ? 1 : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request" . $e->getMessage(), 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['student_id']);


            if ($this->repo->delete($params['student_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
			}
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}
	
	
	/**
	 * getPickupLocation
	 */
	public function loadLocations()
	{
		
		

		$params = (array) $this->app->params();

		$data =  $this->repo->findWithLocations($params['student_id'], $this->app->auth()->parent_id);

		return $data;
	}
	
	public function addStudent() 
	{

		$params = (array) $this->app->params();
        try {	

			$params['parent_id'] =  $this->app->auth()->parent_id;
			$params['last_name'] =  $this->app->auth()->first_name;

			$save = $this->repo->store($params);

            $returnData =  (!empty($save)) 
            ? array('success'=>1, 'result'=>$save, 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		echo  json_encode($returnData);

		return null;
	}

	public function updateStudentInfo() 
	{

		$params = (array) $this->app->params();
        try {	

			$params['parent_id'] =  $this->app->auth()->parent_id;
			$params['last_name'] =  $this->app->auth()->first_name;

			$save = $this->repo->updateStudentInfo($params);

            $returnData =  (!empty($save)) 
            ? array('success'=>1, 'result'=>$save, 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}


	public function uploadPicture()
	{
		$student_id = $this->app->request()->get('student_id');
		$media = new \Medians\Media\Application\MediaController;
		$pictureName =  $media->uploadFile('students');
		$student =  $this->repo->find($student_id);
		$student->picture = '/uploads/students/'.$pictureName;
		$student->save();
		return  $student->picture;
	} 
}