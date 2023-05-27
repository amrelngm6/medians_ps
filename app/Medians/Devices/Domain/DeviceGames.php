<?php

namespace Medians\Devices\Domain;


use Shared\dbaser\CustomModel;

use Medians\Devices\Domain\Device;
use Medians\Games\Domain\Game;
use Medians\Products\Domain\Product;


class DeviceGames extends CustomModel
{


	/**
	* @var String
	*/
	protected $table = 'device_games';

	/**
	* @var Array
	*/
	public $fillable = [
		'device_id',	
		'game_id',	
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;

	public $appends = ['name', 'id', 'picture'];


	public function getIdAttribute()
	{
		return $this->game_id;
	}
	public function getNameAttribute()
	{
		return isset($this->game->name) ? $this->game->name : null;
	}

	public function getPictureAttribute()
	{
		return isset($this->game->picture) ? $this->game->picture : 'Uploads/images/default_game.png';
	}


	/**
	 * Relations
	 */
	public function game()
	{
		return $this->hasOne(Game::class, 'id', 'game_id');
	}




}