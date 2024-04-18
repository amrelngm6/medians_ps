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
    	'model_id',
    	'model_type',
    	'action',
    	'data',
	];

	public static function addItem($model, $action, $updatedFields = null)
	{
		$user = (new \config\APP)->auth();
		if ($model::class == UsageLog::class)
		{
			return null;
		}
		$pk = $model->getPrimaryKey();
		$userpk = $user->getPrimaryKey();
		$data = array();
		$data['model_type'] = $model::class;
		$data['model_id'] = $model->$pk;
		$data['user_type'] = $user::class;
		$data['user_id'] = $user->$userpk;
		$data['action'] = $action;
		$data['data'] = $updatedFields ?? json_encode(json_decode($model));
		$save = UsageLog::firstOrCreate($data);
		return $save;
	}

}
