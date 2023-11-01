<?php

namespace Medians\Help\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;

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
		'priority',
		'status',
	];

	public $appends = ['name'];

	public function getNameAttribute()
	{
		return ($this->user_type == Driver::class && isset($this->driver->first_name)) ? $this->driver->first_name : '';
	}


	public function getFields()
	{
		return $this->fillable;
	}
	
	public function driver() 
	{
    	return $this->hasOne(Driver::class, 'driver_id', 'user_id');
	}
	
	public function comments() 
	{
    	return $this->hasMany(HelpMessageComment::class, 'message_id', 'message_id');
	}

	
	
}
