<?php

namespace Medians\Builders\Infrastructure;

use Medians\Builders\Domain\Builder;
use Medians\Content\Domain\Content;

class BuilderRepository 
{
	

	public function find($id)
	{
		return Builder::find($id); 
	}	

	public function get()
	{
		$save = [];

		foreach (Builder::with('childs')->get() as $key => $value) 
		{
			if (count($value->childs))
			{
				$save[$value->category] = $value->childs;
			}
		}
		return  $save ? $save : 0;
	}	

	public function store($object)
	{
		$save = Builder::firstOrCreate((array) $object);
		return  $save ? $save : 0;
	}	


	public function updateMeta($request)
	{

		$check = Content::where('prefix', $request->get('prefix'))->first();
		$check->prefix = ($request->get('seoName') == $request->get('prefix')) ? $request->get('prefix') : Content::generatePrefix($request->get('seoName'));
		$check->title = $request->get('title');
		$check->short = $request->get('short') ;
		$check->seo_title = $request->get('seo_title');
		$check->seo_keywords = $request->get('seo_keywords');
		$check->seo_desc = $request->get('seo_desc');
		$save = $check->save();
		if ($save)
		{
			echo __('Done');
		}
		return true;
	}	

	
}
