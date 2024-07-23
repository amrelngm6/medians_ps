<?php
namespace Medians\Customers\Application;

use Shared\dbaser\CustomController;

use Medians\Customers\Infrastructure\LeadRepository;

class LeadController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new LeadRepository();
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
			[ 'key'=> "customer_id", 'title'=> "#", 'column_type'=>'hidden'],
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
		
		try {
			
		    return render('data_table', [
		        'load_vue' => true,
		        'title' => translate('Leads list'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
				'object_name' => 'Lead',
				'object_key'  => 'lead_id'
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	/**
	 * Lead Login through Mobile API
	 */
	public function login()
	{
		$Auth = new \Medians\Auth\Application\AuthService;
		$repo = new \Medians\Leads\Infrastructure\LeadRepository;

		$this->app = new \config\APP;
		$request = $this->app->request();
		
		$params = json_decode($request->get('params'));		

		$checkLogin = $repo->checkLogin($params->email, $Auth->encrypt($params->password));
		
		if (empty($checkLogin->lead_id)) {
			return ['error'=> translate("User credentials not valid")]; 
		}
		
		$token = $Auth->encrypt(strtotime(date('YmdHis')).$checkLogin->lead_id);
		$generateToken = $checkLogin->insertCustomField('API_token', $token);

		return 
		[
			'success'=>true, 
			'lead_id'=> isset($checkLogin->lead_id) ? $checkLogin->lead_id : null, 
			'token'=>$generateToken->value
		];
	}  



	public function signup() 
	{
		$params = (array) $this->app->params();
        try {	

            return  (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Password sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}



	public function resetPassword() 
	{
		$params = (array) $this->app->params();

        try {	

			$check = $this->repo->resetPassword($params);

            return  ($check == 1) 
            ? array('success'=>1, 'result'=>translate('Confirmation code sent through email'), 'reload'=>1)
            : array('success'=>0, 'result'=> $check, 'error'=>1);
			
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	/**
	 * Reset and change password  
	 */
	public function resetChangePassword()
	{
		$params = (array) $this->app->params();

        try {
			
			$check = $this->repo->resetChangePassword($params);
            return isset($check->lead_id)
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}

	public function updateMobile()
	{
		$params = $this->app->params();
		$params = is_array($params) ?  (array) $params : json_decode($params);

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	public function changePassword()
	{
		$_params = $this->app->params();
		$params = (array) (is_array($_params) ?  $_params : json_decode($_params));

        try {
			
			$params['lead_id'] = $this->app->auth()->lead_id;

			$check = $this->repo->changePassword($params);
            return isset($check->lead_id)
			 ? array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1)
			 : array('error'=>$check, 'result'=>translate('Error'));

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        }
	}


	public function store() 
	{

		$params = $this->app->params();

        try {	

        	$user = $this->app->auth();
        	$params['created_by'] = $user->id;
        	
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
		$params = $this->app->params();

        try {

        	$params['status'] = !empty($params['status']) ? $params['status'] : null;

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

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['lead_id']);


            if ($this->repo->delete($params['lead_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	/**
	 * get Lead
	 */
	public function getLeads()
	{
		$this->app = new \config\APP;

		$data =  $this->repo->getLeads();

		echo  json_encode($data);
	}


	/**
	 * get Lead
	 */
	public function checkLead($id)
	{
		$data =  $this->repo->getLead($id);

		echo  json_encode($data);
	}


}