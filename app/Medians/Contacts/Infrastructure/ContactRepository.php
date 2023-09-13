<?php

namespace Medians\Contacts\Infrastructure;

use Medians\Contacts\Domain\Contact;


class ContactRepository 
{

    public function loadContacts()
    {
        $return = Contact::with('last_message')
        ->with('last_sent_message')
        ->with('conversations')
        ->whereHas('conversations')
        // ->WhereDoesntHave('new_conversation', function($q){

        // }) 
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
