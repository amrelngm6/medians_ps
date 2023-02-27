<?php

namespace Medians\Domain\Events;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

use Medians\Domain\Users\Agent;

class Event extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'events';


	protected $fillable = [
		'title',
		'type',
		'start_date',
		'start_time',
		'end_date',
		'end_time',
		'property_id',
		'agent_id',
		'active',
		'status',
	];



	public $appends = [];

	function __construct()
	{
	}


	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			if (!in_array($q, array('model_type' ,'model_id')))
			{
				return $q;
			}
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
	 * Set relation with Files
	*/ 
	public function Files()
	{
		return $this->MorphMany(Files::class, 'model');
	}


	/**
	 * Set Relation with SelectedOption 
	 */
	public function SelectedOption()
	{
		return $this->MorphMany(ModelOptions\SelectedOption::class, 'model');
	} 

	public function loadAgents()
	{
		return User::where('')->get();
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
	 * Render options values
	 */ 
	public function renderFields($category)
	{
		return array_column(Options::where('model', Property::class)->where('category', $category)->get()->toArray(), 'title', 'code');
	}
}
