<?php

namespace Medians\Branches\Domain;

use \Medians\Users\Domain\User;
use \Medians\Settings\Domain\Settings;

use Shared\dbaser\CustomModel;

class Branch extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'branches';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'name',
    	'info',
    	'owner_id',
    	'status'
	];

	

	public $appends = ['owner_name'];

	public function getOwnerNameAttribute()
	{
		return isset($this->owner) ?  $this->owner->first_name : '';
	}

	public function getFields()
	{
		return $this->fillable;
	}	

	public function owner()
	{
		return $this->hasOne(
			User::class, 'id', 'owner_id'
		);
	}

	public function setting_data()
	{
		return array_column($this->settings, 'value', 'code');

	}

	public function settings()
	{
		return $this->hasMany(
			Settings::class, 'branch_id', 'id'
		);
	}
}
