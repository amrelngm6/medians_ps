<?php

namespace Medians\Conversations\Infrastructure;

use Medians\Conversations\Domain\Conversation;
use Medians\Contacts\Domain\Contact;


class ConversationRepository 
{



    public function checkOld(String $wa_id)
    {
        return Conversation::where('wa_id', $wa_id)->whereDate('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->first();
    }
    
 

    public function saveConversation(Array $data)
    {
        $check = Conversation::where('wa_id', $data['wa_id'])->where('user_id', 0)->first();

        if ($check)
            return $check->update(['user_id'=>$data['user_id']]);
        
        return Conversation::firstOrCreate($data);
    }
    
 
}
