<?php

namespace Medians\Messages\Infrastructure;

use Medians\Messages\Domain\Message;
use Medians\Contacts\Domain\Contact;


class MessageRepository 
{



    public function saveMessage(Array $data, String $senderID)
    {

        Message::create([
            'message_id' => $data['message_id'],
            'sender_id' => $senderID,
            'receiver_id' => $data['to'],
            'message_time'=> isset($data['message_time']) ? $data['message_time'] : '',
            'conversation_id' => isset($data['conversation_id']) ? $data['conversation_id'] : '',
            'message_text' => isset($data['message_text']) ? $data['message_text'] : '',
            'message_type' => isset($data['message_type']) ? $data['message_type'] : '',
            'media_id'=> isset($data['media_id']) ? $data['media_id'] : '',
            'media_path'=> isset($data['media_path']) ? $data['media_path'] : '',
            'sent_at',
        ]);
    }
    

    public function updateMedia(String $mediaId, $newpath = null)
    {

        return Message::where('media_id', $mediaId)->update([
            'media_path'=> $newpath,
        ]);
    }
    // Array ( [messaging_product] => whatsapp [to] => 201096869285 [type] => text [text] => Array ( [body] => test ) [message_id] => wamid.HBgMMjAxMDk2ODY5Mjg1FQIAERgSRjEyNEJFMzA1QTg5REUxODg2AA== )


    public function loadMessages(String $id = null)
    {
        return Message::where('sender_id' , $id)->orWhere('receiver_id' , $id)->get();
    }

    public function loadContacts()
    {
        return Contact::get();
    }

    public function saveContact($data)
    {
        Contact::firstOrCreate(
            $data
        );
    }

}
