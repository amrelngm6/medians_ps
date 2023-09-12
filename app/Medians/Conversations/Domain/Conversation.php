<?php

namespace Medians\Conversations\Domain;

use Shared\dbaser\CustomModel;

use Medians\Contacts\Domain\Contact;
use Medians\Messages\Domain\Message;



class Conversation extends CustomModel 
{

	/**
	* @var String
	*/
	protected $table = 'conversations';


	protected $fillable = [
    	'conversation_id',
    	'user_id',
    	'wa_id',
	];


	
	public function contact()
	{
		return $this->hasOne(Contact::class, 'wa_id','wa_id');
	}


	
	public function new_messages()
	{
		return $this->hasMany(Message::class, 'sender_id','wa_id');
	}


}
