<?php

namespace Medians\Businesses\Infrastructure;

use Medians\Businesses\Domain\Business;
use Medians\Businesses\Domain\Company;
use Medians\Businesses\Domain\School;
use Medians\CustomFields\Domain\CustomField;


class BusinessRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public function find($id)
	{
		return Business::with('settings','packages','subscription')
		->withCount('routes', 'locations', 'drivers')
		->find($id);
	}

	public function getCompanies($limit = 100)
	{
		
		return Company::where('type', 'company')
		->withCount('routes', 'locations', 'drivers')
		->whereHas('Settings', function($q) {
			$q->where('code', 'allow_applicants')->where('value','on');	
		})
		->with('settings','packages')
		->where('status', 'on')
		->limit($limit)->get();
	}

	public function getSchools($limit = 100)
	{
		return School::where('type', 'school')
		->withCount('routes', 'locations', 'drivers')
		->whereHas('Settings', function($q) {
			$q->where('code', 'allow_applicants')->where('value','on');	
		})
		->with('settings','packages')
		->where('status', 'on')
		->limit($limit)->get();
	}

	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['business_id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Business::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}


	
	/**
	* Find all items between two days 
	*/
	public function masterByDateCount($params )
	{

	  	return Business::whereBetween('created_at' , [$params['start'] , $params['end']])->count();

	}

	
	/**
	* Find all items between two days 
	*/
	public function masterByDate($params, $limit )
	{
		
		return  Business::withCount(['locations as y'=>function($q) use ($params){
			if (isset($params['start']))
			{
				$q->whereBetween('created_at' , [$params['start'] , $params['end']]);
			}
		}])
		->selectRaw('business_name as label')
		->having('y', '>', 0)
		->orderBy('y', 'desc')
		->limit($limit)
		->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Business();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Business::create($dataArray);
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

		$Object = Business::find($data['business_id']);
		
		// Return the  object with the new data
    	$update = $Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['business_id']) : '';

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
			
			$delete = Business::find($id)->delete();

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
		CustomField::where('model_type', Business::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Business::class;	
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