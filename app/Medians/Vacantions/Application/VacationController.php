<?php
namespace Medians\Vacations\Application;

use Shared\dbaser\CustomController;

use Medians\Vacations\Infrastructure\VacationRepository;
use Medians\Students\Infrastructure\StudentRepository;

class VacationController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;
		$this->studentRepo = new StudentRepository();
		$this->repo = new VacationRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'key'=> "vacation_id", 'title'=> "#"],
            [ 'key'=> "title", 'title'=> __('Title'), 'sortable'=> true ],
            [ 'key'=> "date", 'title'=> __('date'), 'sortable'=> true ],
            [ 'key'=> "student_name", 'title'=> __('user_name'), 'sortable'=> true ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{

		return [
            [ 'key'=> "vacation_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "title", 'title'=> __('title'),  'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "date", 'title'=> __('Date'),  'fillable'=> true, 'column_type'=>'date' ],
			[ 'key'=> "student_id", 'title'=> __('Student'), 
				'fillable'=> true, 'column_type'=>'select', 'column_key'=>'student_id', 'text_key'=>'student_name', 
				'data' => $this->studentRepo->get()
			],
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
			
		    return render('vacations', [
		        'load_vue' => true,
		        'title' => __('Vacations'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
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

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}
	
	
	/**
	 * Load latest vacations at mobile
	 * 
	 */
	public function loadVacations()
	{
		$this->app = new \config\APP;

		return $this->repo->loadDriverMessages($this->app->auth(), 100);
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

        	$check = $this->repo->find($params['pickup_id']);


            if ($this->repo->delete($params['pickup_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	
}