<?php

namespace Medians\Conversations\Application;

use Medians\Contacts\Infrastructure\ContactRepository;
use Medians\Messages\Infrastructure\MessageRepository;
use Medians\Conversations\Infrastructure\ConversationRepository;

class ConversationController
{

    
	/**
	 * Admin index items
	 * 
	 */ 
	public function index( ) 
	{
        
        $repo = new ConversationRepository;
        
		try {
			
		    return render('new_chats', [
		        'load_vue' => true,
		        'title' => __('conversations'),
		        'contacts' => $repo->getNew(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}



    /**
     * Save conversation 
     * 
     */
    public function save(String $wa_id)
    {

        $app = new \config\APP;

        $MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
        $check = $MessageRepository->getConversationId(['sender_id'=>$wa_id]);
        
        $ConversationRepository = new \Medians\Conversations\Infrastructure\ConversationRepository;

        $data['conversation_id'] = $check->conversation_id;
        $data['wa_id'] = $wa_id;
        $data['user_id'] = $app->auth()->id;

        $save = $ConversationRepository->checkIfPending($data) ? $ConversationRepository->joinConversation($data)  : $ConversationRepository->saveConversation($data);
        
        if ($save)
            echo json_encode(["success"=>true]);

        return true;
    }
    

    /**
     * Save conversation 
     * 
     */
    public function new_chats()
    {
        $app = new \config\APP;

        $ConversationRepository = new \Medians\Conversations\Infrastructure\ConversationRepository;

        echo json_encode(['contacts'=>$ConversationRepository->getNew()]);
    }
    


}
