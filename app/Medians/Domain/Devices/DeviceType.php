<?php

namespace Medians\Domain\Devices;

use Shared\dbaser\CustomController;



class DeviceType extends CustomController
{


	/*
	/ @var String
	*/
	protected $table = 'devices_types';


	protected $fillable = [
    	'title',
    	'publish'
	];

	public $timestamps = false;

	public function id() : ?String
	{
		return $this->id;
	}


	public function title() : String
	{
		return $this->title;
	}


	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : DeviceType
	{
		$this->id = $id;
		return $this;
	}

	public function setTitle($title) : DeviceType
	{
		$this->title = $title;
		return $this;
	}

	public function setPublish($publish) : DeviceType
	{
		$this->publish = $publish;
		return $this;
	}


}
