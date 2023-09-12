<?php

namespace Medians\Conversations\Infrastructure;

use Medians\Conversations\Domain\Conversation;
use Medians\Contacts\Domain\Contact;


class ConversationRepository 
{



    public function saveConversation(Array $data)
    {

        return Message::firstOrCreate($data);
    }
    
 
}
