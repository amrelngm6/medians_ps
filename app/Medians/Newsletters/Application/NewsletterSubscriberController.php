<?php
namespace Medians\Newsletters\Application;

use Shared\dbaser\CustomController;

use Medians\Newsletters\Infrastructure\NewsletterSubscriberRepository;

class NewsletterSubscriberController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new NewsletterSubscriberRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "subscriber_id", 'text'=> "#",'sortable'=> true ],
            [ 'value'=> "email", 'text'=> translate('email'), 'sortable'=> true ],
            [ 'value'=> "name", 'text'=> translate('Name'), 'sortable'=> true ],
            [ 'value'=> "delete", 'text'=> translate('delete') ],
        ];
	}

	

	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function fillable( ) 
	{
		return [
            [ 'key'=> "subscriber_id", 'title'=> "#", 'column_type'=>'hidden'],
            [ 'key'=> "name", 'title'=> translate('name'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "email", 'title'=> translate('email'), 'sortable'=> true, 'fillable'=> true, 'column_type'=>'text' ],
            [ 'key'=> "status", 'title'=> translate('status'), 'sortable'=> true, 'fillable'=>true, 'column_type'=>'checkbox', 'withlabel'=>true ],
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
		    return render('newsletter_subscribers', 
			[
		        'load_vue' => true,
		        'title' => translate('Newsletter subscribers'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
				'no_create' => true
		    ]);
			
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}
	

	public function store() 
	{
		$params = $this->app->request()->get('params');

        try {	

			$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Subscribed successfully'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	$returnData  = json_encode(array('result'=>$e->getMessage(), 'error'=>1));
        }

		return $returnData;
	}



	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

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

        	$check = $this->repo->find($params['subscriber_id']);

            if ($this->repo->delete($params['subscriber_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request ".$e->getMessage(), 1);
        	
        }

	}

	public function validate($params) 
	{
		if (empty($params['email']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('Email EMPTY'), 'error'=>1)), 1);
		}
		
		if (!empty($this->repo->findByEmail($params['email'])))
		{
        	throw new \Exception(json_encode(array('result'=>translate('email_already_found'), 'error'=>1)), 1);
		}
	}


}