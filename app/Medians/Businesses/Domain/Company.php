<?php

namespace Medians\Businesses\Domain;


class Company extends Business
{

	public $appends = ['company_id'];
    
	function __construct()
	{
        $this->where('type', 'company');
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
