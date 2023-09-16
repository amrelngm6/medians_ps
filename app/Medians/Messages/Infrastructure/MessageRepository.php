<?php

namespace Medians\Messages\Infrastructure;

use Medians\Messages\Domain\Message;
use Medians\Contacts\Domain\Contact;
use Medians\Conversations\Domain\Conversation;


class MessageRepository 
{


    public function messagesCount($dateStart = '-1days', $userId = 0)
    {
        $check =  Message::whereDate('created_at', '>', date('Y-m-d', strtotime($dateStart)));

        if ($userId)
            $check = $check->where('inserted_by', $userId);

        return $check->count();
    }

    public function messagesCharts($params)
    {
       
	  	$check = Message::whereBetween('created_at' , [$params['start'] , $params['end']])
		->selectRaw("*, COUNT(*) as y, DATE_FORMAT(created_at, '%Y-%m-%d') as label");

  		return $check->groupBy('label')->orderBy('label', 'ASC')->get();
    }



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
            'message_json' => isset($data['message_json']) ? $data['message_json'] : '',
            'message_type' => isset($data['message_type']) ? $data['message_type'] : '',
            'media_id'=> isset($data['media_id']) ? $data['media_id'] : '',
            'media_path'=> isset($data['media_path']) ? $data['media_path'] : '',
            'inserted_by'=> isset($data['inserted_by']) ? $data['inserted_by'] : 0,
        ]);
    }

    /**
     * Get unread new messages
     */
    public function getNew($user_id)
    {
         return Conversation::where('user_id', $user_id)
         ->whereHas('new_messages')
         ->with('new_messages')
         ->where('ended', '0')
         ->groupBy('wa_id')
         ->get();
    }
 
    
    public function getMessage ($id)
    {
        return Message::find($id);
    }
    
    public function getConversationId ($data)
    {
        return Message::where($data)->orderBy('id', 'DESC')->first();
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
