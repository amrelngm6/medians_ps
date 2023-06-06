<?php

namespace Medians\CustomFields\Domain;

use Shared\dbaser\CustomModel;

class CustomField extends CustomModel
{

	protected $table = 'custom_fields';

	public $fillable = ['title', 'code','model_type', 'model_id', 'value', 'field_id'];

	public $timestamps = false;

}
