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

	
	public function getQuery($type, $limit = 1000)
	{
		$query =  Business::where('type', $type)
		->withCount('routes', 'locations', 'drivers')
		->with('settings','packages');

		return $query->limit($limit)->get();
	}

	public function getCompanies($params, $limit = 100)
	{
		
		$query =  Company::where('type', 'company')
		->withCount('routes', 'locations', 'drivers')
		->whereHas('Settings', function($q) {
			$q->where('code', 'allow_applicants')->where('value','on');	
		})
		->with('settings','packages')
		->where('status', 'on');
		
		if (isset($params['business_name']))
		{
			$query = $query->where('business_name', 'LIKE', '%'.$params['business_name'].'%');
		}
		
		if (isset($params['last_ids']))
		{
			$query = $query->whereNotIn('business_id', json_decode($params['last_ids']));
		}
		return $query->limit($limit)->get();
	}

	public function getSchools($params, $limit = 100)
	{
		$query = School::where('type', 'school')
		->withCount('routes', 'locations', 'drivers')
		->whereHas('Settings', function($q) {
			$q->where('code', 'allow_applicants')->where('value','on');	
		})
		->with('settings','packages')
		->where('status', 'on');

		if (isset($params['business_name']))
		{
			$query = $query->where('business_name', 'LIKE', '%'.$params['business_name'].'%');
		}
		if (isset($params['last_ids']))
		{
			$query = $query->whereNotIn('business_id', json_decode($params['last_ids']));
		}
		return $query->limit($limit)->get();

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