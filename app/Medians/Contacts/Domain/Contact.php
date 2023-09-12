<?php

namespace Medians\Contacts\Domain;

use Shared\dbaser\CustomModel;

use Medians\Messages\Domain\Message;
use Medians\Conversations\Domain\Conversation;


class Contact extends CustomModel 
{

	/*
	/ @var String
	*/
	protected $table = 'contacts';


	protected $fillable = [
    	'name',
    	'wa_id',
    	'phone_number',
    	'picture',
	];

	// public $timestamps = false;

	public function last_message()
	{
		return $this->hasOne(Message::class, 'sender_id','wa_id')->orderBy('id', 'DESC');
	}

	public function last_sent_message()
	{
		return $this->hasOne(Message::class, 'receiver_id','wa_id')->orderBy('id', 'DESC');
	}

	public function conversation()
	{
		return $this->hasMany(Conversation::class, 'wa_id','wa_id')->orderBy('id', 'DESC');
	}
	
	public function new_conversation()
	{
		return $this->hasOne(Conversation::class, 'wa_id','wa_id')->where('user_id', null);
	}


}
