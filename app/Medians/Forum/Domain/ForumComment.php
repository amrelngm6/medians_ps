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

    protected $primaryKey = 'comment_id';
	
	public $fillable = [
		'user_name',
		'user_email',
		'user_phone',
		'item_id',
		'content',
		'status',
	];
	
	public $appends = ['date', 'short_date'];
	
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
		return date('Y-m-d H:i', strtotime($this->created_at));
	}

	
	/**
	 * Relations with onother Models
	 */
    public function message() {
        return $this->hasOne(Forum::class, 'message_id', 'message_id');
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
		return $this->message->where('user_type', Customer::class)->user;
	}

	public function receiverAsUser() 
	{
	}

}
