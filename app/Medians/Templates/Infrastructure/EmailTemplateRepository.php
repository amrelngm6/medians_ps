<?php

namespace Medians\Templates\Infrastructure;

use Medians\Templates\Domain\EmailTemplate;

use Medians\Content\Domain\Content;
use Medians\CustomFields\Domain\CustomField;

class EmailTemplateRepository 
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
		return EmailTemplate::with(['content'=>function($q) use ($prefix){
			$prefix ? $q->where('prefix', $prefix) : $q;
		}])->find($page_id);
	}


	public function homepage()
	{
		$_SESSION['lang'];
		return EmailTemplate::where('homepage', 'on')->with(['content'=>function($q) {
			$q->where('lang', $_SESSION['lang']);
		}])->first();
	}

	public function get($limit = 100)
	{
		return EmailTemplate::with('content')->limit($limit)->get();
	}

	public function getByCategory($page_id, $limit = 100)
	{
		return EmailTemplate::with('content','user')->where('category_id', $page_id)->limit($limit)->orderBy('page_id', 'DESC')->get();
	}

	public function getFeatured($limit = 1)
	{
		return EmailTemplate::with('content','user')->orderBy('updated_at', 'DESC')->first();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new EmailTemplate();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = EmailTemplate::create($dataArray);

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

		$Object = EmailTemplate::find($data['page_id']);
		
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
			
			$delete = EmailTemplate::find($page_id)->delete();

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
		Content::where('item_type', EmailTemplate::class)->where('item_id', $page_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = EmailTemplate::class;	
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
		CustomField::where('model_type', EmailTemplate::class)->where('model_id', $page_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = array();
				$fields['model_type'] = EmailTemplate::class;	
				$fields['model_id'] = $page_id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;	

				$Model = CustomField::create($fields);
			}
	
			return $Model;		
		}
	}




 
}