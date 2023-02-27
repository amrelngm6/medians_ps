<?php

namespace Medians\Domain\Branches;


use Shared\dbaser\CustomController;

class Branch extends CustomController
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
			Medians\Domain\Users\User::class, BranchUsers::class, 'userId', 'id', 'id'
		);
	}
}
