<?php

namespace Medians\Roles\Domain;

use Shared\dbaser\CustomModel;

class Permission extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'permissions';


	protected $fillable = [
    	'role_id',
    	'branch_id',
    	'model',
    	'action',
    	'access',
	];


}
