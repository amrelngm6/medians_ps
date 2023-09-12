<?php

namespace Medians\Conversations\Application;

use Medians\Contacts\Infrastructure\ContactRepository;
use Medians\Messages\Infrastructure\MessageRepository;
use Medians\Conversations\Infrastructure\ConversationRepository;

class ConversationController
{


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
        
        // print_r($data);
        $save = $ConversationRepository->saveConversation($data);

        if ($save)
            echo json_encode(["success"=>true]);
        return true;
    }
    


}
