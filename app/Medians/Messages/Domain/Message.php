<?php

namespace Medians\Messages\Domain;

use Shared\dbaser\CustomModel;



class Message extends CustomModel 
{

	/*
	/ @var String
	*/
	protected $table = 'messages';


	protected $fillable = [
    	'message_id',
    	'conversation_id',
    	'sender_id',
    	'receiver_id',
    	'message_text',
    	'message_type',
    	'media_id',
    	'media_path',
    	'time',
    	'sent_at',
	];

	// public $timestamps = false;


	public $appends = ['income', 'image_path', 'media_title'];

	public function getIncomeAttribute()
	{
		return $this->sender_id == '106672422075870' ? 0 : 1;
	}

	public function getImagePathAttribute()
	{
		return $this->message_type == 'image' ? $this->media_path : null;
	}

	public function getMediaTitleAttribute()
	{
		$return =  $this->media_path ? explode('/', $this->media_path) : null;
		return $return ? end($return) : NULL;
	}

}
