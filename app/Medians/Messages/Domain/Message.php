<?php

namespace Medians\Messages\Domain;

use Shared\dbaser\CustomModel;



class Message extends CustomModel 
{

	/*
	/ @var String
	*/
	protected $table = 'messages';


	protected $fillable = [
    	'message_id',
    	'conversation_id',
    	'sender_id',
    	'receiver_id',
    	'message_text',
    	'message_type',
    	'media_id',
    	'sent_at',
	];

	// public $timestamps = false;


	public $appends = ['income'];

	public function getIncomeAttribute()
	{
		return $this->sender_id == '201096869285' ? 1 : 0;
	}

}
