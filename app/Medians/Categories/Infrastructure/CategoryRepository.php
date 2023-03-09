<?php

namespace Medians\Categories\Infrastructure;

use Medians\Categories\Domain\Category;


class CategoryRepository 
{




	function __construct()
	{
		$this->app = new \config\APP;
	}


	public static function getModel()
	{
		return new Category();
	}


	public function find($id)
	{
		return Category::find($id);
	}

	public function get($model, $limit = 100)
	{
		switch ($model) 
		{
			case 'Medians\Products\Domain\Product':
				return Category::withCount('products')->where('model', $model)->where('branch_id', $this->app->branch->id)->limit($limit)->get();
				break;
			
			case 'Medians\Devices\Domain\Device':
				return Category::withCount('devices')->where('model', $model)->where('branch_id', $this->app->branch->id)->limit($limit)->get();
				break;
		}
	}

	public function categories($model)
	{
		return Category::where('branch_id', $this->app->branch->id)->where('model', $model)->get();
	}






	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Category();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$dataArray['status'] = isset($dataArray['status']) ? 'on' : 0;
		// Return the FBUserInfo object with the new data
    	$Object = Category::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Category::find($data['id']);
		
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
			
			return Category::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

}
