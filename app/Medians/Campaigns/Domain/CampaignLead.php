<?php

namespace Medians\Campaigns\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Drivers\Domain\Driver;


class CampaignLead extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'campaign_leads';

    protected $primaryKey = 'campaign_lead_id';
	
	public $fillable = [
		'campaign_id',
		'lead_id',
		'agent_id',
		'status',
		'created_by',
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
}
