<?php

namespace Medians\Domain\Users;

use Shared\dbaser\CustomController;

class Role extends CustomController
{


	/*
	/ @var String
	*/
	protected $table = 'roles';


	protected $fillable = [
    	'name',
    	'permissions',
	];


	/**
	 * Relation with role 
	 */
	public function Users() 
	{
		return $this->hasOne(User::class, 'role_id');
	}
}
