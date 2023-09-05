<?php

namespace Medians\Contacts\Domain;

use Shared\dbaser\CustomModel;



class Contact extends CustomModel 
{

	/*
	/ @var String
	*/
	protected $table = 'contacts';


	protected $fillable = [
    	'name',
    	'wa_id',
    	'phone_number',
    	'picture',
	];

	// public $timestamps = false;



}
