<?php

namespace Medians\Businesses\Domain;


class School extends Business
{


    
	function __construct()
	{
        $this->where('type', 'School');
	}


    /*
	/ @var String
	*/
    public $type = 'School';
	

	/*
	/ return String
	*/
	public function type()
	{
		return 'School';
	}

}
