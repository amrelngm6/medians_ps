<?php

namespace Medians\Stories\Infrastructure;

use Medians\Stories\Domain\Story;
use Medians\CustomFields\Domain\CustomField;
use Medians\Content\Domain\Content;


class StoryRepository 
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
		
		foreach ($this->get(100) as $key => $value) 
		{
			// (new \Medians\Media\Infrastructure\MediaRepository)->resize($value->picture, 72, 80);
		}
	}


	public static function getModel()
	{
		return new Story();
	}


	public function find($id)
	{
		return Story::with('content')->find($id);
	}

	public function get($limit = 100)
	{
		return Story::with('content','user')
		->limit($limit)
		->get();
	}



	public function random($limit = 100)
	{
		return Story::with('content','user')->limit($limit)->inRandomOrder()->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Story();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Story::create($dataArray);
    	$Object->update($dataArray);

    	// Store languages content
    	$this->storeContent($data['content'], $Object->id);

    	// Store Custom fields
    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Story::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// Store languages content
    	!empty($data['content']) ? $this->storeContent($data['content'], $data['id']) : '';

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['id']) : '';

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
			
			$delete = Story::find($id)->delete();

			if ($delete){
				$this->storeContent(null, $id);
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
	public function storeContent($data, $id) 
	{
		Content::where('item_type', Story::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Story::class;	
				$fields['item_id'] = $id;	
				$fields['lang'] = $key;	
				$fields['prefix'] = isset($value['prefix']) ? $value['prefix'] : Content::generatePrefix($value['title']);	
				$fields['created_by'] = $this->app->auth()->id;

				$Model = Content::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}




	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Story::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Story::class;	
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
