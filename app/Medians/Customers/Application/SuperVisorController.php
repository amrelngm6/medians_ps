<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure\SuperVisorRepository;

class SuperVisorController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new SuperVisorRepository($this->app->auth()->business);
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "customer_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> __('Name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> __('picture'), 'sortable'=>true ],
            [ 'value'=> "email", 'text'=> __('Email'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> __('Mobile'), 'sortable'=> false ],
            [ 'value'=> "birth_date", 'text'=> __('birth_date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> __('status'), 'sortable'=> true ],
			['value'=>'edit', 'text'=>__('Edit')],
			['value'=>'delete', 'text'=>__('Delete')],
        ];
	}
	
	
	
	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
		
		return [
			[ 'key'=> "supervisor_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "name", 'title'=> __('Name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> __('Email'), 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "mobile", 'title'=> __('Mobile'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "birth_date", 'title'=> __('birth_date'), 'fillable'=> true, 'column_type'=>'date' ],
			[ 'key'=> "gender", 'title'=> __('Gender'), 'column_type'=>'select', 'text_key'=>'title', 'withLabel'=>true, 'fillable'=> true,
				'data'=>  [['title'=>'Male', 'gender'=>'male'],['title'=>'Female','gender'=>'female']] ,
			],
            [ 'key'=> "status", 'title'=> __('status'), 'fillable'=>true, 'column_type'=>'checkbox'  ],
            [ 'key'=> "picture", 'title'=> __('picture'), 'fillable'=>true, 'column_type'=>'file' ],
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
		try 
		{
		    return render('supervisors', [
		        'load_vue' => true,
		        'title' => __('SuperVisors'),
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

		$params = $this->app->request()->get('params');

        try {	

        	$user = $this->app->auth();
        	$params['created_by'] = $user->id;
        	$params['business_id'] = $user->business->business_id;
        	$params['status'] = !empty($params['status']) ? 'on' : null;
        	
			$checkEmail = $this->repo->findByEmail($params['email']);
			
			if (isset($checkEmail->email))
				return array('error'=> __('EMAIL_FOUND'));

            return (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	return array('error'=>$e->getMessage());
        }

	}



	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

        	$params['status'] = !empty($params['status']) ? 'on' : null;

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>__('Updated'), 'reload'=>1);
            }
        
        } catch (\Exception $e) {
        	return array('error'=>$e->getMessage());
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->request()->get('params');

        try {

        	$check = $this->repo->find($params['supervisor_id']);

            if ($this->repo->delete($params['supervisor_id']))
            {
                return json_encode(array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


}