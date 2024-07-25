<?php

namespace Medians\Campaigns\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;


class Campaign extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'campaigns';

    protected $primaryKey = 'campaign_id';
	
	public $fillable = [

		'name',
		'description',
		'start_date',
		'end_date',
		'status',
		'created_by',
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	
	
}
