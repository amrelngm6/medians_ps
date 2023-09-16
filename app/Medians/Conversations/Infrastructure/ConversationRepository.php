<?php

namespace Medians\Conversations\Infrastructure;

use Medians\Conversations\Domain\Conversation;
use Medians\Contacts\Domain\Contact;


class ConversationRepository 
{



    public function activeConversationsCount($dateStart = '-1days', $userId = 0)
    {
        $check = Conversation::where('user_id', '>', '0')
        ->where('ended', '0')
        ->whereDate('created_at', '>', date('Y-m-d', strtotime($dateStart)));

        if ($userId)
            $check = $check->where('inserted_by', $userId);

        return $check->count();
    }

    public function pendingConversationsCount($dateStart = '-1days', $userId = 0)
    {
        
        $check = Conversation::where('user_id', '<', 1)
        ->where('ended', '0')
        ->whereDate('created_at', '>', date('Y-m-d', strtotime($dateStart)));
        
        if ($userId)
            $check = $check->where('inserted_by', $userId);

        return $check->count();
    }

    public function endedConversationsCount($dateStart = '-1days', $userId = 0)
    {
        
        $check = Conversation::where('ended', '1')
        ->whereDate('created_at', '>', date('Y-m-d', strtotime($dateStart)));
        
        if ($userId)
            $check = $check->where('inserted_by', $userId);

        return $check->count();
    }

    public function getNew()
    {
        return Conversation::where('user_id', 0)->with(['contact' => function($q){
            return $q->with('last_message');
        }])->get();
    }

    public function checkOld(String $wa_id)
    {
        return Conversation::where('ended', '0')->where('wa_id', $wa_id)->whereDate('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 day')))->first();
    }
    

    public function saveConversation(Array $data)
    {
        return Conversation::firstOrCreate($data);
    }
    

    public function endConversation(String $id)
    {
        return Conversation::where('id', $id)->update(['ended' => 1]);
    }
    
    public function checkIfActive(Array $data)
    {
        return Conversation::where('ended', '0')->where('wa_id', $data['wa_id'])->where('user_id', $data['user_id'])->orderBy('id','DESC')->first();
    }
    
    
    public function joinConversation(Array $data)
    {
        return Conversation::where('wa_id', $data['wa_id'])
        ->where('ended', '0')
        ->update($data);
    }
    
 
}
