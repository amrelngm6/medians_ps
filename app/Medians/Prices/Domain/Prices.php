<?php

namespace Medians\Prices\Domain;

use Medians\Devices\Domain\Device;

use Shared\dbaser\CustomController;


class Prices extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'prices';


	public $fillable = [
			'model_id',
			'model_type',
			'code',
			'value'
		];

	public $timestamps = null;


}
