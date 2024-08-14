<?php

namespace Medians\Doctors\Infrastructure;

use Medians\Doctors\Domain\Doctor;
use Medians\Doctors\Domain\Category;
use Medians\Doctors\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


class DoctorRepository 
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
		// foreach ($this->get(100) as $key => $value) 
		// {
			// (new \Medians\Media\Infrastructure\MediaRepository)->resize($value->picture, 72, 80);
		// }
	}


	public static function getModel()
	{
		return new Doctor();
	}


	public function find($id)
	{
		return Doctor::with('content','custom_fields')->find($id);
	}

	public function getAll()
	{
		return Doctor::with('content','user')->orderBy('id', 'ASC')->get();
	}

	public function getHome($limit = 100)
	{
		return Doctor::whereHas('content', function($q) {
			$q->where('content', '!=', '');
		})
		->with('content','user')->where('status', '!=', '0')->limit($limit)->orderBy('id', 'ASC')->get();
	}

	public function get($limit = 100)
	{
		return Doctor::with('content','user')->where('status', '!=', '0')->limit($limit)->orderBy('id', 'ASC')->get();
	}


	public function filterSearchTitle($title)
	{
		$title = str_replace(
			[ 'اسباب'  ,'اسماعيل','استاذ']
			, ['أسباب' ,"إسماعيل",'أستاذ']
			, $title);
		return str_replace(' ', '%', trim($title));
	}
	public function search($request, $limit = 20)
	{

		$title = $request->get('search') ? $this->filterSearchTitle($request->get('search')) : '';
		$return = Doctor::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%');
		})
		->where('status', '!=', '0')
		->with('content','user')->limit($limit)->orderBy('updated_at', 'DESC')
		->get();
		// ->toSql();

		// print_r($return);
		return $return;
	}

	public function random($limit = 100)
	{
		return Doctor::with('content','user')->where('status', 'on')->limit($limit)->inRandomOrder()->get();
	}

	public function similar($item, $limit = 3)
	{
		
		$title = $item->content->title ? str_replace(' ', '%', $item->content->title) : '';
		$return = Doctor::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%')->orWhere('content', 'LIKE', '%'.$title.'%');
		})
		->where('id', '!=', $item->id)
		->where('status', '!=', '0')
		->with('content','user')->limit($limit)->orderBy('updated_at', 'DESC')
		->get();


		return count($return->toArray()) ? $return : $this->random($limit);

	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Doctor();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$data['title'] = $data['title'] ?? '';

		// Return the FBUserInfo object with the new data
    	$Object = Doctor::create($dataArray);
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

		$Object = Doctor::find($data['id']);
		
		$data['title'] = isset($data['content']['en']['title']) ? $data['content']['en']['title'] : ($data['title'] ?? '');

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
			
			$delete = Doctor::find($id)->delete();

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
		Content::where('item_type', Doctor::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Doctor::class;	
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
		CustomField::where('model_type', Doctor::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Doctor::class;	
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
