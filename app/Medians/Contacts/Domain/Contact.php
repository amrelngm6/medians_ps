<?php

namespace Medians\Contacts\Domain;

use Shared\dbaser\CustomModel;

use Medians\Messages\Domain\Message;


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


}
