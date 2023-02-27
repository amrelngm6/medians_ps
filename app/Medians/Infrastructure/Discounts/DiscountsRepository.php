<?php

namespace Medians\Infrastructure\Discounts;

use Medians\Domain\Discounts\Discount;

class DiscountsRepository 
{
	


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	/*
	// Find item by `id` 
	*/
	public function getById($id) 
	{

		return  Discount::find($id);
	}


	
	/*
	// Find by code
	*/
	public function getByCode($code ) 
	{
	  	return Discount::where('branch_id', $this->app->branch->id)->where('code', $code)->first();
	}


	/*
	// Find all items 
	*/
	public function getAll($limit = 100)
	{
		return  Discount::where('branch_id', $this->app->branch->id)->limit($limit)->get();
	}


	

}