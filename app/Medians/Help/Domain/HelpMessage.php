<?php

namespace Medians\Help\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;

class HelpMessage extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'help_messages';

    protected $primaryKey = 'message_id';
	
	public $fillable = [
		'user_id',
		'user_type',
		'subject',
		'message',
	];


	public function user() 
	{
    	return $this->hasOne(User::class, 'id', 'user_id') ;
	}

	
	
}
