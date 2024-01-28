<?php

namespace Medians\Categories\Infrastructure;

use Medians\Categories\Domain\Category;
use Medians\Devices\Domain\Device;
use Medians\Products\Domain\Product;


class CategoryRepository 
{

	protected $app;



	function __construct()
	{
	}


	public function find($id)
	{
		return Category::find($id);
	}

	public function get($model, $limit = 100)
	{
		switch ($model) 
		{
			case Product::class:
				return Category::withCount('products')->where('model', $model)->limit($limit)->get();
				break;
			
			case Device::class:
				return Category::withCount('devices')->where('model', $model)->limit($limit)->get();
				break;
		}
	}

	/**
	 * Get all categories by Model
	 * 
	 * @param String
	 */ 
	public function categories($model)
	{
		return Category::where('model', $model)->orderBy('id', 'DESC')->get();
	}






	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Category();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$dataArray['status'] = isset($dataArray['status']) ? 'on' : 0;
		// Return the Model object with the new data
    	$Object = Category::firstOrCreate($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Category::find($data['id']);
		
		// Return the Model object with the new data
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
			
			return Category::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

}
