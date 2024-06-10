<?php

namespace Medians\Offers\Infrastructure;

use Medians\Offers\Domain\Offer;
use Medians\CustomFields\Domain\CustomField;
use Medians\Content\Domain\Content;


class OfferRepository 
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
		return new Offer();
	}


	public function find($id)
	{
		return Offer::with('content')->find($id);
	}

	public function get($limit = 100)
	{
		return Offer::with('content','user', 'speciality')->where('status', 'on')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}

	public function getAll()
	{
		return Offer::with('content','user', 'speciality')->orderBy('id', 'DESC')->get();
	}

	public function random($limit = 100)
	{
		return Offer::with('content','user')->where('status', 'on')->limit($limit)->inRandomOrder()	->get();
	}

	public function similar($item, $limit = 3)
	{
		if (empty($item->content->title))
			return null;
		
		$title = str_replace(' ', '%', $item->content->title);
		return Offer::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%')->orWhere('content', 'LIKE', '%'.$title.'%');
		})
		->where('id', '!=', $item->id)
		->with('content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Offer();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Offer::create($dataArray);
    	$Object->update($dataArray);

    	$this->storeCustomFields($data['field'] ,$Object->id);
    	
    	$this->storeContent($data['content'] ,$Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Offer::find($data['id']);
		
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
			
			$delete = Offer::find($id)->delete();

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
		Content::where('item_type', Offer::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Offer::class;	
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
		CustomField::where('model_type', Offer::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Offer::class;	
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
