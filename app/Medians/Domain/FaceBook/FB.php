<?php

namespace Medians\Domain\FaceBook;

use Shared\dbaser\CustomController;


class FB extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'facebook_rx_config';


	protected $fillable = [
    	'app_name',
    	'api_id',
    	'api_secret',
    	'numeric_id',
    	'user_access_token',
    	'status',
    	'deleted',
    	'user_id',
    	'use_by',
    	'developer_access',
    	'facebook_id',
    	'secret_code'
	];

	public $timestamps = false;


	function __construct()
	{
		
	}


}
