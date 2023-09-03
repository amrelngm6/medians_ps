<?php

namespace Medians\Bookings\Infrastructure;

use Medians\Bookings\Domain\Booking;
use Medians\CustomFields\Domain\CustomField;


class BookingRepository 
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
		return new Booking();
	}


	public function find($id)
	{
		return Booking::with('content')->find($id);
	}

	public function get($type = 'Booking', $limit = 100)
	{
		return Booking::where('class', $type)->with('content','user','custom_fields', 'consultation' , 'offer')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}

	public function similar($item, $limit = 3)
	{
		if (empty($item->content->title))
			return null;
		
		$title = str_replace(' ', '%', $item->content->title);
		return Booking::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%')->orWhere('content', 'LIKE', '%'.$title.'%');
		})
		->where('id', '!=', $item->id)
		->with('content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}

	public function get_root($limit = 100)
	{
		$lang = __('lang');
		return Booking::where('parent_id', '0')
		->with(['childs'=>function($q)  use ($lang) {
			$q->with(['content'=>function($q) use ($lang)
			{
				$q->where('lang', $lang);
			}]);
		}])
		->with('content','user')
		->where('id','!=','1')
		->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Booking();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Booking::create($dataArray);
    	$Object->update($dataArray);

    	$this->storeCustomFields($data['custom_field'] ,$Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Booking::find($data['id']);
		
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
			
			return Booking::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}





	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('item_type', Booking::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['item_type'] = Booking::class;	
				$fields['item_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;	

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}



 
}
