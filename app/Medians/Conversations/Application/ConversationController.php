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
        
        $ContactRepository = new \Medians\Contacts\Infrastructure\ContactRepository;
        
        $ConversationRepository = new \Medians\Conversations\Infrastructure\ConversationRepository;

        $data['conversation_id'] = $check->conversation_id;
        $data['wa_id'] = $wa_id;
        $data['user_id'] = $app->auth()->id;
        $data['ended'] = '0';

        $save = $ConversationRepository->joinConversation($data);
        
        if ($save)
            echo json_encode($ContactRepository->find($wa_id));

        return true;
    }
    

    /**
     * End conversation 
     * 
     */
    public function end_chat(String $wa_id)
    {

        $app = new \config\APP;

        $ConversationRepository = new \Medians\Conversations\Infrastructure\ConversationRepository;

        $data['wa_id'] = $wa_id;
        $data['user_id'] = $app->auth()->id;

        $check = $ConversationRepository->checkIfActive($data);
        
        if (isset($check->id) && empty($check->ended))
        {
            $update = $check->update(['ended'=>1]);
        }


        echo 'Error';

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
