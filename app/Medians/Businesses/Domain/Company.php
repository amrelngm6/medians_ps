<?php

namespace Medians\Businesses\Domain;


class Company extends Business
{

    
	function __construct()
	{
        $this->where('type', 'Company');
	}

    /*
	/ @var String
	*/
    public $type = 'Company';

	/*
	/ return String
	*/
	public function type()
	{
		return 'Company';
	}

}
