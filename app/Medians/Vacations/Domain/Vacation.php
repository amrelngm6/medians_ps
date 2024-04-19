<?php

namespace Medians\Vacations\Domain;

use Medians\Businesses\Domain\Business;
use Shared\dbaser\CustomModel;


class Vacation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vacations';

    protected $primaryKey = 'vacation_id';
	
	public $fillable = [
		'business_id',
		'notes',
		'date',
		'user_id',
		'user_type',
	];


	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}
	

	
    public function user()
    {
        return $this->morphTo();
    }

}
