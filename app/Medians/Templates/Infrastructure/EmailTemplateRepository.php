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

	public function getObjectName()  {
		$a = explode('\\', get_class(new EmailTemplate));
		return end($a);
	}

	public function find($template_id, $prefix = null)
	{
		return EmailTemplate::with('content','langs_content')->find($template_id);
	}

	public function findByLang($template_id, $lang)
	{
		return EmailTemplate::with(['content'=>function ($q) use ($lang) {
			$q->where('lang', $lang);
		}])->find($template_id);
	}


	public function get($limit = 100)
	{
		return EmailTemplate::with('content','langs_content')->limit($limit)->get();
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
    	isset($data['field']) ? $this->storeFields($data['field'], $Object->template_id) : '';

    	// Store Lang content
    	isset($data['content']) ? $this->storeContent($data['content'], $Object->template_id) : '';

    	return $Object;
    }
    	
	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = EmailTemplate::find($data['template_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

		// Store Custom fields
    	isset($data['field']) ? $this->storeFields($data['field'], $Object->template_id) : '';

    	return $Object;

    }

	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($template_id) 
	{
		try {
			
			$delete = EmailTemplate::find($template_id)->delete();

			if ($delete){
				$this->storeContent(null, $template_id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	/**
	* Save related items to database
	*/
	public function storeContent($data, $template_id) 
	{
		Content::where('item_type', EmailTemplate::class)->where('item_id', $template_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = EmailTemplate::class;	
				$fields['item_id'] = $template_id;	
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
	public function storeFields($data, $template_id) 
	{
		CustomField::where('model_type', EmailTemplate::class)->where('model_id', $template_id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = array();
				$fields['model_type'] = EmailTemplate::class;	
				$fields['model_id'] = $template_id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;	

				$Model = CustomField::create($fields);
			}
	
			return $Model;		
		}
	}




 
}