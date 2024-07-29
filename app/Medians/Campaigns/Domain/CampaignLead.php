<?php

namespace Medians\Campaigns\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Leads\Domain\Lead;


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
		'notes',
		'created_by',
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	public function lead()
	{
		return $this->hasOne(Lead::class, 'lead_id', 'lead_id');
	}

	public function campaign()
	{
		return $this->hasOne(Campaign::class, 'campaign_id', 'campaign_id');
	}

}
