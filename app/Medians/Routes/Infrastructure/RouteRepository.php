<?php

namespace Medians\Routes\Infrastructure;

use Medians\Routes\Domain\Route;
use Medians\Routes\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


class RouteRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	public static function getModel()
	{
		return new Route();
	}


	public function find($id)
	{
		return Route::with('pickup_locations', 'driver')->find($id);
	}

	public function get($limit = 100)
	{
		return Route::limit($limit)->get();
	}

	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['route_id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Route::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Route();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Route::create($dataArray);
    	$Object->update($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Route::find($data['route_id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['route_id']) : '';

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
			
			$delete = Route::find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Route::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Route::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}


 
}