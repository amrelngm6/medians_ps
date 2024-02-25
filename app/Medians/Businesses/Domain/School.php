<?php

namespace Medians\Businesses\Domain;


class School extends Business
{

	public $appends = ['school_id'];
    
	function __construct()
	{
        $this->where('type', 'school');
	}


	public function getSchoolIdAttribute()
	{
		return $this->business_id;
	}

    /*
	/ @var String
	*/
    public $type = 'school';
	

	/*
	/ return String
	*/
	public function type()
	{
		return 'school';
	}

}
