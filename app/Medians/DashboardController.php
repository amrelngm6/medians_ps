<?php

namespace Medians;
use \Shared\dbaser\CustomController;


class DashboardController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->app = new \config\APP;
	}

	/**
	 * Model object 
	 */
	public function index()
	{
		$ConversationRepository = new \Medians\Conversations\Infrastructure\ConversationRepository;
		$MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;

		try {
			
	        return  render('dashboard', [
	        	'load_vue'=> true,
				'active_conversations_count' => $ConversationRepository->activeConversationsCount(),
				'pending_conversations_count' => $ConversationRepository->pendingConversationsCount(),
				'ended_conversations_count' => $ConversationRepository->endedConversationsCount(),
				'messages_count' => $MessageRepository->messagesCount(),
	            'title' => __('Dashboard')
	        ]);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


	/**
	 * Load Active Messages
	 */
	public function activeMessages()
	{
		return $app->loadMessages();
	}




}