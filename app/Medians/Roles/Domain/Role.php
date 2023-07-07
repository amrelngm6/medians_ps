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


}
