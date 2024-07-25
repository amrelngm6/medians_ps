<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;

class Agent extends Customer
{

	public $appends = ['agent_id','field','usertype'];

	public function getUsertypeAttribute()
	{
		return 'Agent';
	}


	public function getFieldAttribute()
	{
		return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
	}

	public function getAgentIdAttribute() 
	{
		return $this->customer_id;
	}

	public function getAgentNameAttribute() : String
	{
		return $this->first_name .' '.$this->last_name;
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}


	/**
	 * Relations with onother Models
	 */
	

	 
    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }



	/**
	 * Create Custom filed for Session of Agent
	 */
	public function insertCustomField($code, $value)
	{
		$delete = CustomField::where('code', $code)
		->where('model_type', Agent::class)
		->where('model_id', $this->customer_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Agent::class, 
			'model_id'=>$this->customer_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  


}