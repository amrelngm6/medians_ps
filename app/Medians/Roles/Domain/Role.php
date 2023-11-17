<?php

namespace Medians\Roles\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;

class Role extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'roles';


	protected $fillable = [
    	'name',
	];


	public $appends = ['role_id'];

	public $timestamps = false;

	public function permissions()
	{
		return $this->hasMany(Permission::class, 'role_id', 'id');
	}

	public function getRoleIdAttribute()
	{
		return $this->id;
	}
	
}
