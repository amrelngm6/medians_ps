<?php

namespace Medians\Help\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;
use Medians\Businesses\Domain\Business;

class HelpMessage extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'help_messages';

    protected $primaryKey = 'message_id';
	
	public $fillable = [
		'business_id',
		'user_id',
		'user_type',
		'title',
		'subject',
		'message',
		'priority',
		'status',
	];

	public $appends = ['name', 'date', 'short_date', 'last_update'];

	public function getShortDateAttribute()
	{
		$date = date('Y-m-d', strtotime($this->created_at));
		return date( ($date == date('Y-m-d')) ? 'H:i' : 'M d, H:i'  , strtotime($this->created_at));
	}

	public function getDateAttribute()
	{
		return date('Y-m-d H:i', strtotime($this->created_at));
	}
	public function getLastUpdateAttribute()
	{
		return date('Y-m-d H:i', strtotime($this->updated_at));
	}
	public function getNameAttribute()
	{
		return ($this->user_type == Driver::class && isset($this->driver->first_name)) ? $this->driver->first_name : '';
	}

	
	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	
	
    public function user() {
        return $this->morphTo();
    }

	public function getFields()
	{
		return $this->fillable;
	}
	
	public function comments() 
	{
    	return $this->hasMany(HelpMessageComment::class, 'message_id', 'message_id')->with('user');
	}

	public function receiverAsParent() 
	{
		return $this->where('user_type', Parents::class)->user;
	}

	public function receiverAsDriver() 
	{
		return $this->where('user_type', Driver::class)->user;
	}

	
	
}
