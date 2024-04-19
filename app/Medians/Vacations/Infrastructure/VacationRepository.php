<?php

namespace Medians\Vacations\Infrastructure;

use Medians\Vacations\Domain\Vacation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;


class VacationRepository 
{


	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}



	public function find($id)
	{
		return Vacation::with('user')->find($id);
	}

	public function get($limit = 100)
	{
		return Vacation::where('business_id', $this->business_id)->with('user')->limit($limit)->get();
	}
	
	


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Vacation();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['user_type'] = $this->handleType($data);

		// Return the  object with the new data
    	$Object = Vacation::firstOrCreate($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Vacation::where('business_id', $this->business_id)->find($data['vacation_id']);
		
		// Return the  object with the new data
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
			
			$delete = Route::where('business_id', $this->business_id)->find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

	public function handleType($data) 
	{
		
		switch (strtolower($data['user_type']))
		{
			case 'student':
				return Student::class;
				break;

			default:
				return $data['user_type'];
				break;
		}
	}


 
}