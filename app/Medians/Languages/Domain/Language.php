<?php

namespace Medians\Languages\Domain;

use Shared\dbaser\CustomModel;


class Language extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'languages';

    protected $primaryKey = 'language_id';
	
	public $fillable = [
		'name',
		'code',
		'icon',
		'status',
		'created_by',
	];


	
}
