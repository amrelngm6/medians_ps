<?php

namespace Medians\Domain\FaceBook;

use Shared\dbaser\CustomController;


class FBUserInfo extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'facebook_rx_fb_user_info';


	protected $fillable = [
    	'facebook_rx_config_id',
    	'user_id',
    	'access_token',
    	'name',
    	'email',
    	'fb_id',
    	'add_date',
    	'need_to_delete',
    	'deleted',
	];

	public $timestamps = false;


	function __construct()
	{
		
	}


}
