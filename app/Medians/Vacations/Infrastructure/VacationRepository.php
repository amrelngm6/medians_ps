<?php

namespace Medians\Vacations\Infrastructure;

use Medians\Vacations\Domain\Vacation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;


class VacationRepository 
{


	 
	



	function __construct()
	{
		
		
	}



	public function find($id)
	{
		return Vacation::with('user')->find($id);
	}

	public function get($limit = 100)
	{
		return Vacation::with('user')->limit($limit)->get();
	}
	

	public function getStudentVacations($studentId)
	{
		return Vacation::where('user_id', $studentId)->where('user_type', Student::class)->with('user')->orderBy('created_at', 'DESC')->get();
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

		unset($data['user_type']);

		$Object = Vacation::find($data['vacation_id']);
		
		if ($Object->date < date('Y-m-d'))
		{
			return translate('Not allowed Vacation date has passed');
		}

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
			
			$delete = Route::find($id)->delete();

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