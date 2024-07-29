<?php
namespace Medians\Campaigns\Application;

use Shared\dbaser\CustomController;

use Medians\Campaigns\Infrastructure\CampaignRepository;
use Medians\Customers\Infrastructure\AgentRepository;

class CampaignLeadController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $agentRepo;

	protected $app;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new CampaignRepository();
		$this->agentRepo = new AgentRepository();
	}




	/**
	 * Columns list to view at DataTable 
	 *  
	 */ 
	public function columns( ) 
	{

		return [
            [ 'value'=> "campaign_lead_id", 'text'=> "#"],
            [ 'value'=> "lead.name", 'text'=> translate('name'), 'sortable'=> true ],
            [ 'value'=> "lead.mobile", 'text'=> translate('Mobile'), 'sortable'=> true ],
            [ 'value'=> "agent.name", 'text'=> translate('agent'), 'sortable'=> true ],
            [ 'value'=> "campaign.name", 'text'=> translate('campaign'), 'sortable'=> true ],
            [ 'value'=> "status", 'text'=> translate('status'), 'sortable'=> true ],
            [ 'value'=> "notes", 'text'=> translate('notes'), 'sortable'=> true ],
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
            [ 'key'=> "campaign_lead_id", 'title'=> "", 'fillable'=>true, 'column_type'=>'hidden'],
            [ 'key'=> "lead_id", 'title'=> translate('Lead ID'),  'disabled'=> true, 'column_type'=>'number'  ],
			['key'=> "campaign_id", 'title'=> translate('Campaign'), 'help_text' => translate('Change Campaign'),'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'name',  'required'=> true, 
				'data'=> $this->repo->get()
			],
            ['key'=> "agent_id", 'title'=> translate('Agent'), 'help_text' => translate('Change Agent'),'withLabel'=> true, 'fillable'=> true, 'column_type'=>'select','text_key'=>'name',  'required'=> true, 
				'data'=> $this->agentRepo->get()
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
			
		    return render('data_table', 
			[
		        'load_vue' => true,
		        'title' => translate('Campaign Leads'),
		        'columns' => $this->columns(),
		        'fillable' => $this->fillable(),
		        'items' => $this->repo->getCampaignLeads(),
		        'agents' => $this->agentRepo->get(),
				'object_name' => 'CampaignLead',
				'object_key' => 'campaign_lead_id'
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


	public function store() 
	{

	}


	public function update()
	{
		$params = $this->app->params();

        try {

        	unset($params['status']);

            if ($this->repo->updateLead($params))
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

        	$check = $this->repo->find($params['campaign_lead_id']);


            if ($this->repo->deleteLead($params['campaign_lead_id']))
            {
                return json_encode(array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1));
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

}