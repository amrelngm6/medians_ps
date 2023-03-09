<?php

namespace Medians\Products\Infrastructure;

use Medians\Products\Domain\Product;



/**
 * Product class database queries
 */
class ProductsRepository 
{

	public $app ;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	public function getModel()
	{
		return new Product;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Product::find($id);
	}

	/*
	// Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Product::with('category')
		->where('branch_id', $this->app->branch->id)->get();
	}

	/**
	* Find items by stock alert 
	* @param Int $limit
	*/
	public function getByStock(Int $limit) 
	{
		return Product::with('category')
		->where('stock', '<=', $limit)
		->where('stock', '>', 0)
		->where('branch_id', $this->app->branch->id)->get();
	}

	/**
	* Find items by stock alert 
	* @param Int $limit
	*/
	public function getByStockOut() 
	{
		return Product::with('category')
		->where('stock', '<', 1)
		->where('branch_id', $this->app->branch->id)->get();
	}

	/**
	 * Find items by `params` 
	*/
	public function getItems($params = null) 
	{
		$query = Product::with('category');

		$query = isset($params['status']) ? $query->where('status', '!=', '0') : $query;

		$query = isset($params['stock']) ? $query->where('stock','>',0) : $query;
		
		return $query->where('branch_id', $this->app->branch->id)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Product();
		$dataArray = ['branch_id'=>$this->app->branch->id];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Product::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Product::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Product::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}