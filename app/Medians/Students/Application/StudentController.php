<?php
namespace Medians\Students\Application;

use Shared\dbaser\CustomController;

use Medians\Students\Infrastructure\StudentRepository;
use Medians\Customers\Infrastructure\ParentRepository;

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
            [ 'value'=> "name", 'text'=> translate('first_name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> translate('picture'),  ],
            [ 'value'=> "parent.name", 'text'=> translate('parent_name'), 'sortable'=> true ],
            [ 'value'=> "route.route_name", 'text'=> translate('route'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> translate('mobile'), 'sortable'=> true ],
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
            [ 'key'=> "student_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "parent_id", 'title'=> translate('Parent'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'name', 
				'data' => $this->parentRepo->get()  
			],
            [ 'key'=> "name", 'title'=> translate('first_name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "transfer_status", 'title'=> translate('Transfer status'), 
				'sortable'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'title', 
				'data' => [['transfer_status'=>'Approved','title'=>translate('Approved')], ['transfer_status'=>'Pending','title'=>translate('Pending')]]  
			],
            [ 'key'=> "mobile", 'title'=> translate('mobile'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "date_of_birth", 'title'=> translate('date_of_birth'), 'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=>true, 'column_type'=>'file' ],
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
	public function index( ) 
	{
		
		try {
			
		    return render('data_table', [
		        'load_vue' => true,
		        'title' => translate('Students list'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
				'object_name' => 'Student',
				'object_key'  => 'student_id'
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



	public function validate($params) 
	{

		if (empty($params['name']))
		{
			throw new \Exception(translate('NAME_EMPTY'), 0);
		}

		if (empty($params['parent_id']))
		{
			throw new \Exception(translate('parent_required'), 0);
		}

		if (empty($params['mobile']))
		{
			throw new \Exception(translate('MOBILE_ERR'), 0);
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
        	$params['status'] = isset($params['status']) ? 'on' : 0;

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

        	$params['status'] = !empty($params['status']) ? 'on' : 0;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
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
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
			}
            
        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}
	
	
	/**
	 * getRouteLocation
	 */
	public function loadLocations()
	{
		
		$params = (array) $this->app->params();

		$data =  $this->repo->findWithLocations($params['student_id'], $this->app->auth()->customer_id);

		return $data;
	}
	
	/**
	 * getRouteLocation
	 */
	public function loadStudent()
	{
		
		$studentId = $this->app->request()->get('student_id');

		$data =  $this->repo->findWithLocations($studentId, $this->app->auth()->customer_id);

		return $data;
	}
	
	public function addStudent() 
	{

		$params = (array) $this->app->params();
        try {	

			$params['parent_id'] =  $this->app->auth()->customer_id;
			$params['name'] =  $this->app->auth()->name;

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

			$params['parent_id'] =  $this->app->auth()->customer_id;

			$save = $this->repo->updateStudentInfo($params);

            $returnData =  (!empty($save)) 
            ? array('success'=>1, 'result'=>$save, 'error'=> null, 'reload'=>1)
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