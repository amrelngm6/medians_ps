<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;


class Country extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'countries';

    protected $primaryKey = 'country_id';
	
	public $fillable = [
		'name',
		'picture',
		'code',
		'status',
		'created_by',
	];

	public $timestamps = false;

	
}
