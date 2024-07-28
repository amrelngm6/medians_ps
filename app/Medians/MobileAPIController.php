<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;

use Medians\Bugs\Infrastructure\BugReportRepository;


class MobileAPIController extends CustomController
{

	/**
	* @var Object
	*/
	protected $app;


	
	/**
	 * Model object 
	 * 
	 */
	public function handle($model = null)
	{
		$this->app = new \config\APP;
		$return = [];
		$request = $this->app->request();
		$model = empty($model) ? $request->get('model') : $model;

		$params = $this->app->params();

		switch ($model) 
		{
			case 'APP':
				$return = ['app'=>$this->app, 'lang'=>(new \helper\Lang($this->app->default_lang))->load()->vueLang()];
				break;
		
			case 'load_config':
				$return = loadConfig(null, []);
				break;

			case 'app_settings':
				$return = (new \Medians\Settings\Application\AppSettingsController())->loadSetting();
				break;

			case 'system_settings':
				$return = (new \Medians\Settings\Application\SystemSettingsController())->getAll();
				break;

			case 'help_messages':
				$return = (new \Medians\Help\Application\HelpMessageController())->loadHelpMessages();
				break;
					
			case 'help_message':
				$return = (new \Medians\Help\Application\HelpMessageController())->loadHelpMessage();
				break;
					
			case 'agent_leads':
				$return = (new \Medians\Leads\Application\LeadController())->getByAgent();
				break;
					
			case 'agent_campaigns':
				$return = (new \Medians\Campaigns\Application\CampaignController())->getByAgent();
				break;

			case 'Agent.login':
				$return =  (new Customers\Application\AgentController())->login(); 
				break;

			case 'Agent.updateCallLog':
				$return =  (new CallLogs\Application\CallLogController())->storeLog(); 
				break;

			case 'Agent.updateLeadCall':
				$return =  (new Campaigns\Application\CampaignController())->updateLeadCall(); 
				break;

			case 'Agent.addLeadCall':
				$return =  (new CallLogs\Application\CallLogController())->store(); 
				break;

			case 'Driver.loginWithTwitter':
				$return =  (new Drivers\Application\DriverController())->loginWithTwitter(); 
				break;

			case 'notifications':
				$return =  (new Notifications\Application\NotificationController())->loadLatestMobileNotifications(); 
				break;

			case 'Lead.upload_picture':
				$return =  (new Leads\Application\LeadController())->uploadPicture(); 
				break;
				
			case 'load_languages':
				$return = (new Languages\Application\LanguageController)->getAll();
				break;
				
			case 'load_countries':
				$return = (new Locations\Application\CountryController)->getAll();
				break;

		}
		
		echo json_encode($return);
		
		return true;
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
			switch ($request->get('model')) 
			{
				case 'User.create':
					$return = (new Users\Application\UserController())->store();
					break;
					
				case 'DriverApplicant.create':
					$return =  (new Drivers\Application\DriverApplicantController())->store(); 
					break;
					
				case 'StudentApplicant.create':
					$return =  (new Customers\Application\StudentApplicantController())->store(); 
					break;					
					
				case 'HelpMessage.create':
					$return = (new \Medians\Help\Application\HelpMessageController())->storeMobile();
					break;

				case 'parent_help_message':
					$return = (new \Medians\Help\Application\HelpMessageController())->parentStore();
					break;
		
				case 'HelpMessageComment.create':
					return  (new Help\Application\HelpMessageController())->storeDriverComment(); 
					break;
			
				case 'HelpMessageComment.parent_comment':
					return  (new Help\Application\HelpMessageController())->storeParentComment(); 
					break;
						
	            case 'Student.create':
	                return  (new Students\Application\StudentController())->addStudent(); 
	                break;
						
	            case 'Transaction.create':
	                $return = (new Transactions\Application\TransactionController())->addTransaction(); 
	                break;
						
	            case 'Vacation.create':
	                $return = (new Vacations\Application\VacationController())->create(); 
	                break;
						
	            case 'Wallet.create':
	                $return = (new Wallets\Application\WalletController())->create(); 
	                break;
						
	            case 'Withdrawal.create':
	                $return = (new Wallets\Application\WithdrawalController())->create(); 
	                break;
						
			}

			echo json_encode($return);
		
			return true;

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

		$return = [];
		switch ($request->get('model')) 
		{

            case 'User.update':
                $return = (new Users\Application\UserController())->update(); 
                break;

            case 'Parent.update':
				$return = (new Customers\Application\ParentController())->updateMobile(); 
                break;

            case 'Driver.update':
				$return = (new Drivers\Application\DriverController())->updateMobile(); 
                break;

			case 'Notification.update':
				$return =  (new Notifications\Application\NotificationController())->update(); 
				break;

			case 'Student.updateStudentInfo':
				$return =  (new Students\Application\StudentController())->updateStudentInfo(); 
				break;

			case 'RouteLocation.update':
				$return =  (new Locations\Application\RouteLocationController())->updateDays(); 
				break;

			case 'Vacation.update':
				$return = (new Vacations\Application\VacationController())->update_student_vacation(); 
				break;

			case 'Wallet.update':
				$return = (new Wallets\Application\WalletController())->update_wallet(); 
				break;

			case 'Withdrawal.update':
				$return = (new Wallets\Application\WithdrawalController())->update_wallet(); 
				break;

		}

		echo json_encode($return);
		
		return true;
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
			switch ($request->get('model')) 
			{
				
				case 'Student.delete':
					return response((new Students\Application\StudentController())->delete());
					break;

				case 'Notification.delete':
					return response((new Notifications\Application\NotificationController())->delete_notification());
					break;

				case 'Subscription.cancel':
					$return = (new Packages\Application\PackageSubscriptionController())->cancelSubscription();
					break;

			}

			echo json_encode($return);
		
			return true;

		} catch (Exception $e) {
			throw new Exception("Error Processing Request : " . $e->getMessage(), 1);
					
		}
	} 

	
}
