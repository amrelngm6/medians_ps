<?php

namespace Medians\Blog\Domain;

use Medians\Categories\Domain\Category as Model;

class Category extends Model
{
	public static function getClass()
	{
		return Model::class;
	}
}
