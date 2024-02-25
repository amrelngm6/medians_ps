<?php

namespace Medians\Businesses\Domain;


class Company extends Business
{

    
	function __construct()
	{
        $this->where('type', 'company');
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
