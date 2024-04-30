<?php

namespace Medians\Content\Infrastructure;

use Medians\Content\Domain\Content;
use Medians\Pages\Domain\Page;


class ContentRepository 
{

	
	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public function find($prefix)
	{
		return Content::where('prefix', $prefix)->first();
	}

	public function findPage($page_id)
	{
		return Content::where('item_id', $page_id)->where('model_type', Page::class)->first();
	}

	public function switch_lang($item)
	{
		$lang = $item->lang ?? '';
		return Content::where('item_id', $item->item_id)->where('item_type', $item->item_type)->where('lang', $lang)->first();
	}

	public function get($model, $limit = 100)
	{
		switch ($model) 
		{
				
			default:
				return Content::where('model', $model)->limit($limit)->get();
				break;
		}
	}

	public function categories($model)
	{
		return Category::where('model', $model)->get();
	}





}