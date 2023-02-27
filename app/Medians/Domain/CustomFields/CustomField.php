<?php

namespace Medians\Domain\CustomFields;


use Shared\dbaser\CustomController;


class CustomField extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'custom_fields';


	public $fillable = [
			'code',
			'value',
			'title',
			'model_type',
			'model_id',
			'inserted_by',
		];

	// public $timestamps = null;


	public static function add($object, $code, $value)
	{
		CustomField::remove($object, $code);

		$new = new CustomField;
		$new->code = $code;
		$new->value = $value;
		$new->model_id = $object->id;
		$new->model_type = get_class($object);
		$new->title = '';
		$new->save();
		
		return $new;
	}

	public static function remove($object, $code)
	{

		return CustomField::where('model_type', get_class($object))
		->where('model_id', $object->id)
		->where('code', $code)
		->delete();
		
	}

}
