<?php

namespace Medians\Events\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;
use Medians\Businesses\Domain\Business;

class Event extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'events';

    protected $primaryKey = 'event_id';
	
	public $fillable = [
		'business_id',
		'title',
		'description',
		'picture',
		'status',
		'created_by',
	];

	public $appends = ['date', 'short_date', 'last_update'];

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
	
	public function getFields()
	{
		return $this->fillable;
	}
	
	
	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	
	
}
