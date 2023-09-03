<?php

namespace Medians\Contacts\Domain;

use Shared\dbaser\CustomController;



class Contact extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'contacts';


	protected $fillable = [
    	'name',
    	'wa_id',
    	'picture',
	];

	// public $timestamps = false;



}
