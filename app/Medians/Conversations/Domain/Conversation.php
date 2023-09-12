<?php

namespace Medians\Conversations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Contacts\Domain\Contact;



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


}
