<?php

namespace Medians\Conversations\Infrastructure;

use Medians\Conversations\Domain\Conversation;
use Medians\Contacts\Domain\Contact;


class ConversationRepository 
{



    public function getNew()
    {
        return Conversation::where('user_id', 0)->with(['contact' => function($q){
            return $q->with('last_message');
        }])->get();
    }

    public function checkOld(String $wa_id)
    {
        return Conversation::where('wa_id', $wa_id)->whereDate('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->first();
    }
    

    public function saveConversation(Array $data)
    {
        return Conversation::firstOrCreate($data);
    }
    
    public function checkIfPending(Array $data)
    {
        return Conversation::where('wa_id', $data['wa_id'])->orderBy('id','DESC')->first();
    }
    
    
    public function joinConversation(Array $data)
    {
        return Conversation::where('wa_id', $data['wa_id'])
        ->where('user_id', '<', 1)
        ->update($data);
    }
    
 
}
