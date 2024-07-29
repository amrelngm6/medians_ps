<?php

namespace Medians\CallLogs\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Customers\Domain\Agent;
use Medians\Leads\Domain\Lead;


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
		'time',
		'duration',
		'type',
		'notes',
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	
	public function lead()
	{
		return $this->hasOne(Lead::class, 'lead_id', 'lead_id');
	}

	public function agent()
	{
		return $this->hasOne(Agent::class, 'customer_id', 'agent_id');
	}

	
}
