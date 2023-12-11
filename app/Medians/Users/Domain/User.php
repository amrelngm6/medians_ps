<?php

namespace Medians\Users\Domain;

use Shared\dbaser\CustomModel;

use Medians\Mail\Application\MailService;

use Medians\Drivers\Domain\Driver;
use Medians\Roles\Domain\Role;
use Medians\Roles\Domain\Permission;
use Medians\CustomFields\Domain\CustomField;

class User extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'users';


	protected $fillable = [
    	'first_name',
    	'last_name',
    	'email',
    	'phone',
    	'profile_image',
    	'role_id',
    	'active',
	];

	protected $appends = ['name', 'photo', 'password', 'field', 'permissions', 'user_id'];


	public function getUserIdAttribute() 
	{
        return $this->id;
	}

	public function getPermissionsAttribute() 
	{
        return !empty($this->RolePermissions) ? array_column($this->RolePermissions->toArray(), 'access', 'action') : [];
	}

	/**
	 * Override password filed data 
	 * for queries security
	 */
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
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.png';
	}

	public function name() : String
	{
		return $this->first_name.' '.$this->last_name;
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



	/**
	 * Relation with role 
	 */
	public function Role() 
	{
		return $this->hasOne(Role::class, 'id', 'role_id');
	}

	/**
	 * Relation with role 
	 */
	public function driver() 
	{
		return $this->hasOne(Driver::class, 'user_id', 'id');
	}

	public function hasToken()
	{
        return $this->hasOne(CustomField::class, 'model_id', 'id')->where('model_type', User::class);
	}

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }

    public function RolePermissions()
    {
		return $this->hasMany(Permission::class, 'role_id', 'role_id')->where('access', 1);
    }

	
	/**
	 * Password encryption method
	 * @param $value String 
	 */ 	
	public static function encrypt(String $value ) : String 
	{
		return sha1(md5($value));
	}


	/**
	 * Create Custom filed for user
	 */
	public function insertCustomField($code, $value)
	{

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>User::class, 
			'model_id'=>$this->id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  





    /**
     * Handle the event after an item 
     * has been updated 
     * 
     */
    public function updatedEvent()
    {
    	$fields = array_fill_keys($this->fillable,1);
    	$fields['password'] = 1;
    	$updatedFields = array_intersect_key($fields, $this->getDirty());

    	if (empty($updatedFields))
    		return null;


    	// Insert activation code 
		$this->insertCustomField('activation_token', User::encrypt(strtotime(date('YmdHis')).$this->id));
    }  

	

}
