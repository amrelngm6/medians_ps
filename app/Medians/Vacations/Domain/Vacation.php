<?php

namespace Medians\Vacations\Domain;


use Shared\dbaser\CustomModel;


class Vacation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'vacations';

    protected $primaryKey = 'vacation_id';
	
	public $fillable = [

		'notes',
		'date',
		'user_id',
		'user_type',
	];


	/**
	 * Relations with onother Models
	 */
	
	

	
    public function user()
    {
        return $this->morphTo();
    }

}
