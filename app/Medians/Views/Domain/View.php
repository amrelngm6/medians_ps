<?php

namespace Medians\Views\Domain;


use Shared\dbaser\CustomModel;

class View extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'views';


	protected $fillable = [
    	'item_type',
    	'item_id',
    	'session',
    	'times',
    	'date',
	];


	public static function itemViews($item, $item_id, $start, $end)
	{
		return View::where('item_type', get_class($item))->where('item_id', $item_id)->whereBetween('date', [$params['start'], $params['end']])->count();
	}

	public static function totalViews($start, $end)
	{
		return View::whereBetween('date', [$params['start'], $params['end']]);
	}

}
