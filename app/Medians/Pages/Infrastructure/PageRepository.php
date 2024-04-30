<?php

namespace Medians\Pages\Infrastructure;

use Medians\Pages\Domain\Page;

use Medians\Content\Domain\Content;
use Medians\CustomFields\Domain\CustomField;

class PageRepository 
{

	
	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 */ 
	protected $app ;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	public function find($page_id, $prefix = null)
	{
		return Page::with(['content'=>function($q) use ($prefix){
			$prefix ? $q->where('prefix', $prefix) : $q;
		}])->find($page_id);
	}


	public function homepage()
	{
		$_SESSION['lang'];
		return Page::where('homepage', 'on')->with(['content'=>function($q) {
			$q->where('lang', $_SESSION['lang']);
		}])->first();
	}

	public function get($limit = 100)
	{
		return Page::with('content','user')->limit($limit)->orderBy('page_id', 'DESC')->get();
	}

	public function getByCategory($page_id, $limit = 100)
	{
		return Page::with('content','user')->where('category_id', $page_id)->limit($limit)->orderBy('page_id', 'DESC')->get();
	}

	public function getFeatured($limit = 1)
	{
		return Page::with('content','user')->orderBy('updated_at', 'DESC')->first();
	}

	public function getMenuPages($position)
	{
		return Page::where('status', 'on')
		->with(['content'=>function($q){
			return $q->select('title', 'prefix', 'item_id');
		}])
		->whereHas('custom_fields',function($q) use ($position){
			return $q->where('code', $position);
		})
		->get();
	}

	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['page_id'=>0, 'content'=>['title'=>$title]]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		if (empty($item->content->title))
			return null;
		
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Page::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->where('page_id', '!=', $item->page_id)
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Page();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Page::create($dataArray);

    	// Store Custom fields
    	isset($data['field']) ? $this->storeFields($data['field'], $Object->page_id) : '';

    	// Store Lang content
    	isset($data['content']) ? $this->storeContent($data['content'], $Object->page_id) : '';

    	return $Object;
    }
    	
	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Page::find($data['page_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

		// Store Custom fields
    	isset($data['field']) ? $this->storeFields($data['field'], $Object->page_id) : '';

    	return $Object;

    }

	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($page_id) 
	{
		try {
			
			$delete = Page::find($page_id)->delete();

			if ($delete){
				$this->storeContent(null, $page_id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	/**
	* Save related items to database
	*/
	public function storeContent($data, $page_id) 
	{
		Content::where('item_type', Page::class)->where('item_id', $page_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Page::class;	
				$fields['item_id'] = $page_id;	
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
	public function storeFields($data, $page_id) 
	{
		CustomField::where('model_type', Page::class)->where('model_id', $page_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = array();
				$fields['model_type'] = Page::class;	
				$fields['model_id'] = $page_id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;	

				$Model = CustomField::create($fields);
			}
	
			return $Model;		
		}
	}




 
}