<?php

namespace Medians\Conversations\Infrastructure;

use Medians\Conversations\Domain\Conversation;
use Medians\Contacts\Domain\Contact;


class ConversationRepository 
{



    public function getNew()
    {
        return Conversation::where('user_id', 0)->with('contact')->get();
    }

    public function checkOld(String $wa_id)
    {
        return Conversation::where('wa_id', $wa_id)->whereDate('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->first();
    }
    
 

    public function saveConversation(Array $data)
    {
        return Conversation::firstOrCreate($data);
    }
    
 
}
