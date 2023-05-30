<?php

namespace Medians\Users\Domain;


use Shared\dbaser\CustomModel;

use Medians\Plans\Domain\Plan;
use Medians\Plans\Domain\PlanSubscription;
use Medians\Roles\Domain\Role;
use \Medians\CustomFields\Domain\CustomField;

class User extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'users';


	protected $fillable = [
    	'active_branch',
    	'first_name',
    	'last_name',
    	'email',
    	'phone',
    	'profile_image',
    	'role_id',
    	'active',
	];

	public $appends = ['name', 'photo', 'password', 'field'];


	public function getPasswordAttribute() 
	{
		return null;
	}


	public function getNameAttribute() : String
	{
		return $this->name();
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}

    public function getFieldAttribute() 
    {
        return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
    }

	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function name() : String
	{
		return $this->first_name.' '.$this->last_name;
	}

	public function email() : String
	{
		return $this->email;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setName($name) : void
	{
		$this->name = $name;
	}

	public function setEmail($email) : void
	{
		$this->email = $email;
	}

	public function setPublish($publish) : void
	{
		$this->publish = $publish;
	}


	public function branch()
	{
		return $this->hasOne(Branch::class , 'id', 'active_branch');
	}


	/**
	 * Relation with role 
	 */
	public function Role() 
	{
		return $this->hasOne(Role::class, 'id', 'role_id');
	}

	public function Plan() 
	{
		return $this->hasOneThrough(Plan::class, PlanSubscription::class, 'branch_id', 'id', 'active_branch', 'plan_id')->orderBy('id', 'DESC')->with('plan_features');
	}


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'item');
    }


	
	/**
	 * Password encryption method
	 * @param $value String 
	 */ 	
	public static function encrypt(String $value ) : String 
	{
		return sha1(md5($value));
	}



}
