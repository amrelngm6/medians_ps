<?php

namespace Medians\Messages\Infrastructure;

use Medians\Messages\Domain\Message;


class MessageRepository 
{



    public function saveMessage(Array $data, String $senderID)
    {

        Message::create([
            'message_id' => $data['message_id'],
            'sender_id' => $senderID,
            'receiver_id' => $data['to'],
            'conversation_id',
            'message_text' => $data['text']['body'],
            'media_id'=> '',
            'sent_at',
        ]);

    }
    // Array ( [messaging_product] => whatsapp [to] => 201096869285 [type] => text [text] => Array ( [body] => test ) [message_id] => wamid.HBgMMjAxMDk2ODY5Mjg1FQIAERgSRjEyNEJFMzA1QTg5REUxODg2AA== )

}
