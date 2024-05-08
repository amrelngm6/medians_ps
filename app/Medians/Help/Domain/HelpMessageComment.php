<?php

namespace Medians\Help\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;
use Medians\Businesses\Domain\Business;

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
	
	public $appends = ['date', 'short_date', 'receiver'];
	
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
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	
	
    public function message() {
        return $this->hasOne(HelpMessage::class, 'message_id', 'message_id')->with('business');
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
		return $this->message->where('user_type', Parents::class)->user;
	}

	public function receiverAsDriver() 
	{
		return $this->message->where('user_type', Driver::class)->user;
	}

	public function receiverAsUser() 
	{
		$item =  $this->with('message')->find($this->comment_id);
		return isset($model->message->business->owner) ?  [$model->message->business->owner] : null;
	}

}
