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
            [ 'value'=> "name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "picture", 'text'=> translate('picture'), 'sortable'=>true ],
            [ 'value'=> "email", 'text'=> translate('Email'), 'sortable'=> true ],
            [ 'value'=> "mobile", 'text'=> translate('Mobile'), 'sortable'=> false ],
            [ 'value'=> "birth_date", 'text'=> translate('birth_date'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
			['value'=>'edit', 'text'=>translate('Edit')],
			['value'=>'delete', 'text'=>translate('Delete')],
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
            [ 'key'=> "name", 'title'=> translate('Name'), 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('Email'), 'fillable'=> true, 'column_type'=>'email' ],
            [ 'key'=> "mobile", 'title'=> translate('Mobile'), 'fillable'=> true, 'column_type'=>'phone' ],
            [ 'key'=> "birth_date", 'title'=> translate('birth_date'), 'fillable'=> true, 'column_type'=>'date' ],
			[ 'key'=> "gender", 'title'=> translate('Gender'), 'column_type'=>'select', 'text_key'=>'title', 'withLabel'=>true, 'fillable'=> true,
				'data'=>  [['title'=>'Male', 'gender'=>'male'],['title'=>'Female','gender'=>'female']] ,
			],
            [ 'key'=> "status", 'title'=> translate('status'), 'fillable'=>true, 'column_type'=>'checkbox'  ],
            [ 'key'=> "picture", 'title'=> translate('picture'), 'fillable'=>true, 'column_type'=>'file' ],
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
		        'title' => translate('SuperVisors list'),
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
				return array('error'=> translate('EMAIL_FOUND'));

            return (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
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

        	$check = $this->repo->find($params['supervisor_id']);

            if ($this->repo->delete($params['supervisor_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


}