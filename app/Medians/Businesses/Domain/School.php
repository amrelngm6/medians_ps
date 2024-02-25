<?php

namespace Medians\Businesses\Domain;


class School extends Business
{


    
	function __construct()
	{
        $this->where('type', 'school');
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
