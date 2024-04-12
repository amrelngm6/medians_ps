<?php

namespace Medians\Businesses\Domain;

use Medians\Users\Domain\User;


class School extends Business
{

	public $appends = ['school_id','owner'];
    
	function __construct()
	{
        $this->where('type', 'school');
	}

	public function getOwnerAttribute ()
	{
		return isset($this->owner_user) ? $this->owner_user : null;
	}

    public function owner_user()
    {
		return $this->hasOne(User::class, 'id', 'user_id');	
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
