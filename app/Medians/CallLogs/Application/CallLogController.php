<?php
namespace Medians\CallLogs\Application;

use Shared\dbaser\CustomController;

use Medians\CallLogs\Infrastructure\CallLogRepository;
use Medians\Leads\Infrastructure\LeadRepository;
use Medians\Campaigns\Infrastructure\CampaignRepository;

class CallLogController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;
	
	protected $app;
	
	protected $leadRepo;

	protected $campaignRepo;
	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new CallLogRepository();
		$this->leadRepo = new LeadRepository();
		$this->campaignRepo = new CampaignRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "call_log_id", 'text'=> "#"],
            [ 'value'=> "lead.name", 'text'=> translate('Lead'), 'sortable'=> true ],
            [ 'value'=> "agent.name", 'text'=> translate('Agent'), 'sortable'=> true ],
            [ 'value'=> "date", 'text'=> translate('Date'), 'sortable'=> true ],
            [ 'value'=> "time", 'text'=> translate('Time'), 'sortable'=> true ],
            [ 'value'=> "duration", 'text'=> translate('Duration'), 'sortable'=> true ],
            [ 'value'=> "type", 'text'=> translate('Type'), 'sortable'=> true ],
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
            [ 'key'=> "call_log_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "name", 'title'=> translate('name'),  'fillable'=> true, 'column_type'=>'text', 'required'=>true ],
            [ 'key'=> "description", 'title'=> translate('Content'),  'fillable'=> true, 'column_type'=>'textarea','required'=>true ],
            [ 'key'=> "start_date", 'title'=> translate('Start date'),  'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "end_date", 'title'=> translate('End date'),  'fillable'=> true, 'column_type'=>'date' ],
            [ 'key'=> "status", 'title'=> translate('status'),  'fillable'=>true, 'column_type'=>'checkbox' ],
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
			
		    return render('data_table', 
			[
		        'load_vue' => true,
		        'title' => translate('CallLogs'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
		        'no_create' => true,
				'object_name' => 'CallLog',
				'object_key' => 'call_log_id'
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	


	public function store() 
	{

		$params = $this->app->params();

        try {	

			$lead = $this->leadRepo->findByMobile($params['mobile']);
			$params['lead_id'] = $lead->lead_id ?? 0;
			$returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

			if ($value['lead_id'] > 0)
			{
				$campaignLead = $this->campaignRepo->getByLeadAgent($params['lead_id'], $user->customer_id);
				$campaignLead->update(['status'=>$params['status']]);
			}

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	


	public function storeLog() 
	{

		$params = $this->app->params();
		$user = $this->app->auth();

        try {	
			$response = null;
			foreach ($params as $key => $value) {
				$value = (array) $value;
				$lead = $this->leadRepo->findByMobile($value['mobile']);
				$value['lead_id'] = $lead->lead_id ?? 0;
				$response = $this->repo->store($value);

				if ($value['lead_id'] > 0)
				{
					$campaignLead = $this->campaignRepo->getByLeadAgent($value['lead_id'], $user->customer_id);
					$campaignLead->update(['status'=>$value['status']]);
				}
			}

			return $response;
        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
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
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{

		$params = $this->app->params();

        try {

        	$check = $this->repo->find($params['call_log_id']);

            if ($this->repo->delete($params['call_log_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}