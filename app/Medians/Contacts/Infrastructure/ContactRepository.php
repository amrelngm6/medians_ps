<?php

namespace Medians\Contacts\Infrastructure;

use Medians\Contacts\Domain\Contact;


class ContactRepository 
{

    public function loadContacts()
    {
        $return = Contact::with('last_message')
        ->with('last_sent_message')
        ->groupBy('wa_id')->where('id', '>', '1')->get();


        foreach($return as $key => $item)
        {
            if (isset($item->last_sent_message->id) && isset($item->last_message->id)) {
                $item->last_message = $item->last_sent_message->id > $item->last_message->id  ? $item->last_sent_message : $item->last_message;
            }
            print_r($item);
            $return[$key] = $item ;
        }
        
        return $return;
    }



}
