<?php

namespace Medians\Domain\Customers;

use Shared\dbaser\CustomController;
use Medians\Domain\Properties\Property;
use Medians\Domain\ModelOptions;
use Medians\Domain\Leads\LeadSources;
use Medians\Domain\Stages\Stage;
use Medians\Domain\Users\Agent;


class Customer extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'customers';

	public $fillable = [
		'stage_id',
		'first_name',
		'last_name',
		'email',
		'phone',
		'business_type',
		'created_by',
		'agent_id',
		'source_type',
		'source_id',
	];



	public $appends = ['name', 'photo', 'location_fields'];

	public function getNameAttribute() : String
	{
		return $this->name();
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function name() : String
	{
		return $this->first_name.' '.$this->last_name;
	}



	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			return $q;
		}, $this->fillable));
	}


	/**
	 * Set relation with Agent
	*/ 
	public function Agent()
	{
		return $this->HasOne(Agent::class, 'id', 'agent_id');
	}


	/**
	 * Set relation with Agent
	*/ 
	public function Source()
	{
		return $this->HasOne(LeadSources::class, 'id', 'source_id');
	}

	/**
	 * Set relation with Agent
	*/ 
	public function Stage()
	{
		return $this->HasOne(Stage::class, 'id', 'stage_id');
	}

	/**
	 * Set relation with Agent
	*/ 
	public function properties()
	{
		return $this->HasOne(Property::class, 'customer_id');
	}


	/**
	 * Set relation with Lead Sources
	*/ 
	public function LoadSources()
	{
		return LeadSources::get();
	}

	/**
	 * Set relation with Stages
	*/ 
	public function LoadStages()
	{
		return Stage::get();
	}


	/** 
	 * Render options values
	 */ 
	public function renderOptions($category)
	{
		return (object) array_column(
				array_map(function($q) use ($category) {
					if ($q->category == $category) { return $q; }
				}, (array) json_decode($this->SelectedOption))
			, 'value', 'code');

	}


	/** 
	 * Load Location fields as custom fields
	 */ 
	public function getLocationFieldsAttribute()
	{
		return (new ModelOptions\LocationInfo)->getFields();
	}



}
