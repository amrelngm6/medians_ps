<?php

namespace Medians\Branches\Domain;

use Medians\Settings\Domain\Settings;

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
    	'status'
	];

	public $timestamps = null;
		

	public function users()
	{
		return $this->hasOneThrough(
			Medians\Users\Domain\User::class, BranchUsers::class, 'userId', 'id', 'id'
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
