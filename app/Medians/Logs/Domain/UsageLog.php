<?php

namespace Medians\Logs\Domain;


use Shared\dbaser\CustomModel;

class UsageLog extends CustomModel
{


	/*
	/ @var String
	*/
	protected $table = 'usage_log';


	protected $fillable = [
    	'user_type',
    	'user_id',
    	'model',
    	'action',
    	'data',
	];

	public static function addItem($model)
	{
		if ($model::class == UsageLog::class)
		{
			return null;
		}
		$data = array();
		$data['model'] = $model::class;
		$data['action'] = 'create';
		$data['data'] = json_encode(json_decode($model));
		$save = UsageLog::create($data);
		return $save;
	}

}
