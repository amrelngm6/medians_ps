<?php

namespace Medians\Roles\Domain;

use Shared\dbaser\CustomController;

use Medians\Users\Domain\User;

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
