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
    	'message_time',
    	'inserted_by',
    	'sent',
    	'read',
    	'sent_at',
	];

	// public $timestamps = false;


	public $appends = ['income', 'image_path', 'message_emojis', 'media_title', 'time_ago'];

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

	public function getTimeAgoAttribute()
	{
		return date('h:i A',strtotime($this->created_at));	
	}


	public function getMessageEmojisAttribute()
	{

		$return = ($this->message_time && is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/chat/'.$this->message_time.'.json')) 
			? file_get_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/chat/'.$this->message_time.'.json') 
			: null;


		if (!$return)
			return null;
		
		$jsonData = json_decode(json_encode($return));
		$message = isset($jsonData->entry[0]->changes[0]->value->messages[0]) 
			? $jsonData->entry[0]->changes[0]->value->messages[0]
			: null;

		return $message;

			
	}

}
