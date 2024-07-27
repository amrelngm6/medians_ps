<?php
namespace Medians\Campaigns\Application;

use Shared\dbaser\CustomController;

use Medians\Campaigns\Infrastructure\CampaignRepository;

class CampaignController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new CampaignRepository	();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "campaign_id", 'text'=> "#"],
            [ 'value'=> "name", 'text'=> translate('name'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "start_date", 'text'=> translate('Start date'), 'sortable'=> true ],
            [ 'value'=> "end_date", 'text'=> translate('End date'), 'sortable'=> true ],
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
            [ 'key'=> "campaign_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
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
			
		    return render('campaigns', 
			[
		        'load_vue' => true,
		        'title' => translate('Campaigns'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->get(),
				'object_name' => 'Campaign',
				'object_key' => 'campaign_id'
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
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (Exception $e) {
        	throw new Exception(json_encode(array('result'=>$e->getMessage(), 'error'=>1)), 1);
        }

		return $returnData;
	}

	/**
	 * Load latest notifications at mobile
	 * 
	 */
	public function loadCampaigns()
	{
		$this->app = new \config\APP;

		return $this->repo->loadDriverMessages($this->app->auth(), 100);
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

        	$check = $this->repo->find($params['campaign_id']);


            if ($this->repo->delete($params['campaign_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{

		if (empty($params['content']['ar']['title']))
		{
        	throw new \Exception(json_encode(array('result'=>translate('NAME_EMPTY'), 'error'=>1)), 1);
		}

	}


	
	public function addLeads($data)
	{
		$params = $this->app->params();

		print_r($_GET['campaign_id']);

		$leadRepo = new \Medians\Leads\Infrastructure\LeadRepository;
        try 
		{
			$row = [];
			$campaignLeadRow = [];
			foreach ($data as $key => $leadRow) 
			{
				$leadRow['name'] = $leadRow['full_name']; 
				$leadRow['mobile'] = $leadRow['phone_number'];
				$lead = $leadRepo->store($leadRow);
				$campaignLeadRow = [
					'campaign_id' => $_GET['campaign_id'],
					'lead_id' => $lead->lead_id,
				];
				$addCampaignLead = $this->repo->storeLead($lead);
			}

            if ($addCampaignLead)
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request ". $e->getMessage(), 1);
        }
	}

}