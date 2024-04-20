<?php

namespace Medians\Businesses\Domain;

use Medians\Users\Domain\User;

class Company extends Business
{

	public $appends = ['company_id','owner', 'logo'];
    
	function __construct()
	{
        $this->where('type', 'company');
	}

	public function getLogoAttribute ()
	{
		return isset($this->logo_field) ? $this->logo_field->value : null;
	}
	
	public function getOwnerAttribute ()
	{
		return isset($this->owner_user) ? $this->owner_user : null;
	}

    public function owner_user()
    {
		return $this->hasOne(User::class, 'id', 'user_id');	
    }

	public function getCompanyIdAttribute()
	{
		return $this->business_id;
	}


    /*
	/ @var String
	*/
    public $type = 'company';

	/*
	/ return String
	*/
	public function type()
	{
		return 'company';
	}

}
