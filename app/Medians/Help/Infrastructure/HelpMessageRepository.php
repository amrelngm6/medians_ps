<?php

namespace Medians\Help\Infrastructure;

use Medians\Help\Domain\HelpMessage;
use Medians\Help\Domain\HelpMessageComment;
use Medians\CustomFields\Domain\CustomField;
use Medians\Drivers\Domain\Driver;
use Medians\Customers\Domain\Parents;
use Medians\Users\Domain\User;


class HelpMessageRepository 
{

	/**
	 * Business id
	 */ 
	protected $business_id ;


	function __construct($business)
	{
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}


	public function find($id)
	{
		return HelpMessage::where('business_id', $this->business_id)->find($id);
	}

	public function get($limit = 100)
	{
		return HelpMessage::where('business_id', $this->business_id)->with('comments')->with('user')->limit($limit)->orderBy('message_id', 'DESC')->get();
	}

	public function loadDriverMessages($user, $limit = 100)
	{
		return HelpMessage::where('business_id', $this->business_id)->with('user','comments' )->where('user_id', $user->driver_id)->where('user_type', Driver::class)->limit($limit)->orderBy('message_id', 'DESC')->get();
	}

	public function loadParentMessages($user, $limit = 100)
	{
		return HelpMessage::where('business_id', $this->business_id)->with('user','comments' )->where('user_id', $user->customer_id)->where('user_type', Parents::class)->limit($limit)->orderBy('message_id', 'DESC')->get();
	}

	public function load($limit = 100)
	{
		return HelpMessage::where('business_id', $this->business_id)->with('user','comments' )->limit($limit)->orderBy('message_id', 'DESC')->get();
	}
	
	public function eventsByDate($params)
	{
		$query = HelpMessage::where('business_id', $this->business_id)->whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}

	public function allEventsByDate($params)
	{
		$query = Trip::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}


	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['location_id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}

	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return HelpMessage::where('business_id', $this->business_id)->whereHas('content', function($q) use ($title){
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

		$Model = new HelpMessage();

		$data['user_type'] = Driver::class;
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = HelpMessage::create($dataArray);

    	return $Object;
    }
    	
	
	/**
	* Save item to database
	*/
	public function parentStore($data) 
	{

		$Model = new HelpMessage();

		$data['user_type'] = Parents::class;
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = HelpMessage::create($dataArray);

    	return $Object;
    }
    	

	/**
	* Save Comment from Admin / Agent
	*/
	public function storeUserComment($data) 
	{

		$Model = new HelpMessageComment();

		$data['user_type'] = User::class;
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = HelpMessageComment::create($dataArray);

    	return $Object;
    }
    	

	/**
	* Save Comment from Admin / Agent
	*/
	public function storeDriverComment($data) 
	{

		$Model = new HelpMessageComment();

		$data['user_type'] = Driver::class;
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = HelpMessageComment::create($dataArray);

    	return $Object;
    }
    	

	/**
	* Save Comment from Admin / Agent
	*/
	public function storeParentComment($data) 
	{

		$Model = new HelpMessageComment();

		$data['user_type'] = Parents::class;
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = HelpMessageComment::create($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = HelpMessage::where('business_id', $this->business_id)->find($data['message_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['message_id']) : '';

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
			
			$delete = HelpMessage::where('business_id', $this->business_id)->find($id)->delete();

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
		CustomField::where('model_type', HelpMessage::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = HelpMessage::class;	
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