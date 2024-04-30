<?php

namespace Medians\Newsletters\Domain;

use Shared\dbaser\CustomModel;


class NewsletterSubscriber extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'newsletter_subscribers';

    protected $primaryKey = 'subscriber_id';
	
	public $fillable = [
		'name',
		'email',
		'status',
	];

}
