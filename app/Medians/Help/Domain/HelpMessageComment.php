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
	
	public $appends = ['date', 'user'];
	

	public function getUserAttribute()
	{
		return $this->message->user;
	}

	public function getDateAttribute()
	{
		return date('Y-m-d H:i', strtotime($this->created_at));
	}

    public function message() {
        return $this->hasOne(HelpMessage::class, 'message_id', 'message_id');
    }

	public function getFields()
	{
		return $this->fillable;
	}

	
	
}
