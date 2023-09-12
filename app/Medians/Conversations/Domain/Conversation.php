<?php

namespace Medians\Conversations\Domain;

use Shared\dbaser\CustomModel;



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



}
