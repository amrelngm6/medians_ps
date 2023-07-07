<?php

namespace Medians\Games\Domain;

use Shared\dbaser\CustomModel;
use Medians\Categories\Domain\Category;
use Medians\Devices\Domain\Device;
use Medians\Devices\Domain\OrderDevice;
use Medians\Devices\Domain\DeviceGames;


class Game extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'games';

	public $fillable = [
		'name',
		'picture',
		'branch_id',
		'category',
		'description',
		'created_by',
	];


	protected $appends = ['photo', 'label', 'y'];


	public function getLabelAttribute() 
	{
		return $this->name;
	}

	public function getYAttribute() 
	{
		return isset($this->bookings_count) ? $this->bookings_count : 0;
	}
	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_game.jpg';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function cat()
	{
		return $this->hasOne(Category::class, 'id', 'category');
	}

	public function devices()
	{
		return $this->hasMany(DeviceGames::class, 'game_id', 'id');
	}

	public function bookings()
	{
		return $this->hasMany(OrderDevice::class, 'game_id', 'id');
	}


}
