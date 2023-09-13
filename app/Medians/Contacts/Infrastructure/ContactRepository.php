<?php

namespace Medians\Contacts\Infrastructure;

use Medians\Contacts\Domain\Contact;


class ContactRepository 
{

    public function loadContacts()
    {
        $user = (new \config\APP)->auth();
        $return = Contact::with('last_message')
        ->with('last_sent_message')
        ->with('conversations')
        ->whereHas('conversations', function($q) use ($user){
            $q->where('user_id', $user->id);
        })
        ->where('id', '>', '1')
        ->groupBy('wa_id')
        ->get();


        foreach($return as $key => $item)
        {
            if (isset($item->last_sent_message->id) || isset($item->last_message->id)) {
                $item->msg = (isset($item->last_sent_message->id) && $item->last_sent_message->id > $item->last_message->id)  
                    ? $item->last_sent_message 
                    : $item->last_message;
            } 
            $return[$key] = $item ;
        }

        
        return $return;
    }



}
