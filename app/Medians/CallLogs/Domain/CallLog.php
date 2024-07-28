<?php

namespace Medians\CallLogs\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;


class CallLog extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'call_logs';

    protected $primaryKey = 'call_log_id';
	
	public $fillable = [

		'lead_id',
		'mobile',
		'agent_id',
		'date',
		'duration',
		'type',
		'status',
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	
	
}
