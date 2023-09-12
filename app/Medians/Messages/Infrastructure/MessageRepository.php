<?php

namespace Medians\Messages\Infrastructure;

use Medians\Messages\Domain\Message;
use Medians\Contacts\Domain\Contact;


class MessageRepository 
{



    public function saveMessage(Array $data, String $senderID)
    {

        return Message::create([
            'message_id' => $data['message_id'],
            'sender_id' => $senderID,
            'receiver_id' => $data['to'],
            'reply_message_id'=> isset($data['reply_message_id']) ? $data['reply_message_id'] : '',
            'message_time'=> isset($data['message_time']) ? $data['message_time'] : '',
            'conversation_id' => isset($data['conversation_id']) ? $data['conversation_id'] : '',
            'message_text' => isset($data['message_text']) ? $data['message_text'] : '',
            'message_type' => isset($data['message_type']) ? $data['message_type'] : '',
            'media_id'=> isset($data['media_id']) ? $data['media_id'] : '',
            'media_path'=> isset($data['media_path']) ? $data['media_path'] : '',
            'inserted_by'=> isset($data['inserted_by']) ? $data['inserted_by'] : 0,
        ]);
    }
    
    public function getMessage ($id)
    {
        return Message::find($id);
    }

    public function updateMedia(String $mediaId, $newpath = null)
    {
        return Message::where('media_id', $mediaId)->update([
            'media_path'=> $newpath,
        ]);
    }

    public function updateReplyId(String $message_id, String $reply_message_id)
    {
        return Message::where('message_id', $message_id)->update([
            'reply_message_id'=> $reply_message_id,
        ]);
    }

    public function readMessage($message_id)
    {
        return Message::where('message_id', $message_id)->update([
            'read'=> 1,
        ]);
    }
    // Array ( [messaging_product] => whatsapp [to] => 201096869285 [type] => text [text] => Array ( [body] => test ) [message_id] => wamid.HBgMMjAxMDk2ODY5Mjg1FQIAERgSRjEyNEJFMzA1QTg5REUxODg2AA== )


    public function loadMessages(String $id = null)
    {
        return Message::with('reply_message')
        ->with('reaction')
        ->where('sender_id' , $id)->orWhere('receiver_id' , $id)
        ->with('reaction')
        ->with('reply_message')
        ->get();
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
