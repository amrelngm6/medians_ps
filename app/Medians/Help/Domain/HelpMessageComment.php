<?php

namespace Medians\Help\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;

class HelpMessageComment extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'help_message_comments';

    protected $primaryKey = 'comment_id';
	
	public $fillable = [
		'user_id',
		'user_type',
		'message_id',
		'comment',
	];
	
	public $appends = ['user'];

	public function getUserAttribute()
	{
		return $this->driver;
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function driver() 
	{
    	return $this->morphOne(Driver::class, 'user');
	}

	
	
}
