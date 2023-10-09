<?php

namespace Medians\Roles\Infrastructure;

use Medians\Roles\Domain\Role;


class RoleRepository 
{



	public function find($id)
	{
		return Role::find($id);
	}

	public function get($limit = 100)
	{
		return Role::limit($limit)->get();
	}

 
}