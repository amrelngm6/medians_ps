<?php

namespace Medians\OnlineConsultations\Infrastructure;

use Medians\OnlineConsultations\Domain\OnlineConsultation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Content\Domain\Content;


class OnlineConsultationRepository 
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
		return new OnlineConsultation();
	}


	public function find($id)
	{
		return OnlineConsultation::with('content')->find($id);
	}

	public function get($limit = 100)
	{
		return OnlineConsultation::with('content','user')
		->limit($limit)
		->orderBy('sorting', 'DESC')
		->get();
	}

	public function similar($item, $limit = 3)
	{
		if (empty($item->content->title))
			return null;
		
		$title = str_replace(' ', '%', $item->content->title);
		return OnlineConsultation::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%')->orWhere('content', 'LIKE', '%'.$title.'%');
		})
		->where('id', '!=', $item->id)
		->with('content','user')->limit($limit)->orderBy('sorting', 'DESC')->get();
	}

	public function get_root($limit = 100)
	{
		$lang = translate('lang');
		return OnlineConsultation::where('parent_id', '0')
		->with(['childs'=>function($q)  use ($lang) {
			$q->with(['content'=>function($q) use ($lang)
			{
				$q->where('lang', $lang);
			}]);
		}])
		->with('content','user')
		->where('id','!=','1')
		->limit($limit)->orderBy('sorting', 'DESC')->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new OnlineConsultation();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = OnlineConsultation::create($dataArray);
    	$Object->update($dataArray);

    	// Store languages content
    	$this->storeContent($data['content'] ,$Object->id);

    	// Store Custom fields
    	$this->storeCustomFields($data['field'] ,$Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = OnlineConsultation::find($data['id']);
		
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
			
			$delete = OnlineConsultation::find($id)->delete();

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
		Content::where('item_type', OnlineConsultation::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = OnlineConsultation::class;	
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
		CustomField::where('model_type', OnlineConsultation::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = OnlineConsultation::class;	
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
