<?php

namespace Medians\StatusList\Domain;

use Shared\dbaser\CustomModel;
use Medians\Users\Domain\User;
use Medians\Campaigns\Domain\CampaignLead;


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
		'model',
		'icon'
	];


	public function getFields()
	{
		return $this->fillable;
	}
	
	public function leads()
	{
		return $this->hasMany(CampaignLead::class, 'status', 'value');
	}
	
}
