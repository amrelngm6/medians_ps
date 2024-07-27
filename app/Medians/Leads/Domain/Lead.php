<?php

namespace Medians\Leads\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;
use Medians\Campaigns\Domain\CampaignLead;


class Lead extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'leads';

    protected $primaryKey = 'lead_id';

	protected $fillable = [
    	'name',
    	'email',
    	'country',
    	'gender',
    	'picture',
    	'birth_date',
    	'mobile',
    	'whatsapp',
    	'job_title',
    	'status',
	];

	public $appends = ['field'];


    public function getFieldAttribute() 
    {
        return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
    }

	public function hasToken()
	{
        return $this->hasOne(CustomField::class, 'model_id', 'id')->where('model_type', User::class);
	}

	
	public function campaignLead()
	{
		$this->hasOne(CampaignLead::class, 'lead_id', 'lead_id');
	}


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }



	/**
	 * Create Custom filed for user
	 */
	public function insertCustomField($code, $value)
	{

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Lead::class, 
			'model_id'=>$this->id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  




}
