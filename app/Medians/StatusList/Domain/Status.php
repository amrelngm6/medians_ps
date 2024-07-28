<?php

namespace Medians\StatusList\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;


class Status extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'status_list';

    protected $primaryKey = 'status_id';
	
	public $fillable = [

		'title',
		'value',
		'sort',
		'model'
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	
}
