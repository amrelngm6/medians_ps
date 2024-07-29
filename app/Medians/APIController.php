<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Bugs\Infrastructure\BugReportRepository;

use Medians\Blog\Infrastructure\BlogRepository;


class APIController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;
	protected $app;

	protected $BugReportRepo;



	function __construct()
	{
	
	}


	/**
	 * Model object 
	 * 
	 */
	public function handle($path)
	{

		$this->app = new \config\APP;
		$request = $this->app->request();
		$return = [];
		switch ($path) 
		{
			case 'load_config':
				$return = loadConfig($request->get('component'), []);
				break;

			case 'addCampaignLeads':
				$request_body = file_get_contents('php://input');
				$data = array_values(json_decode($request_body, true));
				$return = (new  Campaigns\Application\CampaignController)->addLeads($data[0], $_GET['campaign_id']);
				break;

			case 'loadCampaignLeads':
				$return = (new  Campaigns\Application\CampaignController)->loadLeads();
				break;

			case 'StatusWeekLeads':
				$return = (new  Status\Application\StatusController)->getWeekLeads();
				break;
		}

		echo json_encode($return);
	} 

	/**
	 * Create model 
	 * 
	 */
	public function create()
	{
		
		$app = new \config\APP;
		$request = $app->request();
		
		try {
				
			$return = [];
			switch ($request->get('type')) 
			{

				case 'User.create':
					$return = (new Users\Application\UserController())->store();
					break;

				case 'Agent.create':
					$return = (new Customers\Application\AgentController())->store();
					break;


				case 'Lead.create':
					return response((new Leads\Application\LeadController())->store());
					break;

				case 'Campaign.create':
					return response((new Campaigns\Application\CampaignController())->store());
					break;

				case 'HelpMessage.create':
					return response((new Help\Application\HelpMessageController())->store());
					break;

	            case 'NotificationEvent.create':
	                $return =  (new Notifications\Application\NotificationEventController())->store(); 
	                break;

	            case 'Role.create':
	                $return =  (new Roles\Application\RoleController())->store(); 
	                break;
				
				case 'HelpMessageComment.create':
					$return =  (new Help\Application\HelpMessageController())->storeComment(); 
					break;
		
				case 'Language.create':
					$return = (new Languages\Application\LanguageController)->store();
					break;
					
				case 'Translation.create':
					$return = (new Languages\Application\TranslationController())->store(); 
					break;
					
				case 'EmailTemplate.create':
					$return = (new Templates\Application\EmailTemplateController())->store(); 
					break;
					
				case 'Country.create':
					$return = (new Locations\Application\CountryController())->store(); 
					break;
					
				case 'Status.create':
					$return = (new StatusList\Application\StatusController())->store(); 
					break;
	
			}

			return response(json_encode($return));

		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function update()
	{
		$app = new \config\APP;
		$request = $app->request();

		switch ($request->get('type')) 
		{
			case 'SystemSettings.update':
                $controller =  new Settings\Application\SystemSettingsController; 
				break;

			case 'AppSettings.update':
                $controller =  new Settings\Application\AppSettingsController; 
				break;

			case 'Agent.update':
				$controller = new Customers\Application\AgentController;
				break;

			case 'Lead.update':
				$controller = new Leads\Application\LeadController;
				break;
				
			case 'Campaign.update':
				$controller = new Campaigns\Application\CampaignController;
				break;

			case 'HelpMessage.update':
				$controller =  new Help\Application\HelpMessageController;
				break;
	
            case 'Settings.update':
                $controller = new Settings\Application\SettingsController; 
                break;

            case 'User.update':
                $controller = new Users\Application\UserController; 
                break;

            case 'NotificationEvent.update':
                $controller =  new Notifications\Application\NotificationEventController; 
                break;

			case 'Role.update':
				$controller =  new Roles\Application\RoleController; 
				break;			

			case 'Role.updatePermissions':
				return (new Roles\Application\RoleController)->updatePermissions(); 
				break;
		
			case 'User.updateStatus':
				return (new Users\Application\UserController())->updateStatus();
				break;
	
			case 'Language.update':
				$controller = new Languages\Application\LanguageController;
				break;
				
			case 'Translation.update':
				$controller = new Languages\Application\TranslationController; 
				break;
	
			case 'EmailTemplate.update':
				$controller = new Templates\Application\EmailTemplateController; 
				break;

			case 'Status.update':
				$controller = new StatusList\Application\StatusController; 
				break;

			case 'CampaignLead.update':
				$controller = new Campaigns\Application\CampaignLeadController; 
				break;
		}

		return response(isset($controller) ? json_encode($controller->update()) : []);
	} 

	

	/**
	 * delete model 
	 * 
	 */
	public function delete()
	{

		$app = new \config\APP;
		$request = $app->request();

		try {
			
			$return = [];
			switch ($request->get('type')) 
			{

				case 'User.delete':
					return response((new Users\Application\UserController())->delete());
					break;

				case 'Agent.delete':
					return response((new Customers\Application\AgentController())->delete());
					break;

				case 'HelpMessage.delete':
					return response((new Help\Application\HelpMessageController())->delete());
					break;

				case 'Role.delete':
					return response((new Roles\Application\RoleController())->delete());
					break;

				case 'NotificationEvent.delete':
					return response((new Notifications\Application\NotificationEventController())->delete());
					break;
			
				case 'Event.delete':
					return response((new Events\Application\EventController())->delete());
					break;
			
				case 'Language.delete':
					return response((new Languages\Application\LanguageController())->delete());
					break;
					
				case 'EmailTemplate.delete':
					return response((new Templates\Application\EmailTemplateController())->delete());
					break;
					
				case 'Status.delete':
					return response((new StatusList\Application\StatusController())->delete());
					break;
	
			}


		} catch (Exception $e) {
			throw new Exception( $e->getMessage(), 1);
					
		}
	} 


	/**
	 * Debug function that takes screenshot 
	 * and save at the server with txt file 
	 * with full log
	 */
	public function bug_report()
	{
		$this->app = new \config\APP;

		$info = $_POST['info'];
		$err = $_POST['err'];
		$root_path_info = pathinfo(dirname(__DIR__));
		$output = date('YmdHis').'-'.$this->app->auth()->id.'-'.$info;
		file_put_contents($root_path_info['dirname'].'/uploads/bugs/'.$output.'.jpg', file_get_contents($_POST['image']));

		$txtLog = $root_path_info['dirname'].'/uploads/bugs/error_bugs.txt'; 
		file_put_contents($txtLog, file_get_contents($txtLog)."\r\n".$output . $err);

		$this->BugReportRepo = new BugReportRepository;

		$data = array();
		$data['user_id'] = $this->app->auth()->id;
		$data['file_name'] = $output.'.jpg';
		$data['info'] =  $info;
		$data['error'] =  $err;
		$this->BugReportRepo->store($data);

	}

}
