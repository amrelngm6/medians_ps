<?php

namespace Medians\Forum\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Customers\Domain\Customer;

class ForumComment extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'forum_comments';

	public $fillable = [
		'user_name',
		'user_email',
		'user_phone',
		'item_id',
		'content',
		'reply',
		'status',
	];
	
	public $appends = ['date', 'short_date', 'email'];

	public function getEmailAttribute() 
	{
		return $this->user_email;
	}


	public function getShortDateAttribute()
	{
		$date = date('Y-m-d', strtotime($this->created_at));
		return date( ($date == date('Y-m-d')) ? 'H:i' : 'M d, H:i'  , strtotime($this->created_at));
	}


	public function getReceiverAttribute()
	{
		// return null;
		return $this->message->user;
	}

	public function getDateAttribute()
	{
		return date('M d, H:i', strtotime($this->created_at));
	}

	
	/**
	 * Relations with onother Models
	 */
    public function post() {
        return $this->hasOne(Forum::class, 'id', 'item_id');
    }

    public function user() {
        return $this->morphTo();
    }

	public function getFields()
	{
		return $this->fillable;
	}
	
	
	public function receiverAsCustomer() 
	{
		return $this;
	}

	public function receiverAsUser() 
	{
		return User::first();
	}

}
