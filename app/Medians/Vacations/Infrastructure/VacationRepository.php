<?php

namespace Medians\Vacations\Infrastructure;

use Medians\Vacations\Domain\Vacation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Drivers\Domain\Driver;
use Medians\Students\Domain\Student;
use Medians\Users\Domain\User;


class VacationRepository 
{


	public static function getModel()
	{
		return new Vacation();
	}


	public function find($id)
	{
		return Vacation::find($id);
	}

	public function get($limit = 100)
	{
		return Vacation::limit($limit)->orderBy('vacation_id', 'DESC')->get();
	}


	public function vacationsByDate($params)
	{
		$query = Vacation::whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Vacation();

		$data['user_type'] = Student::class;
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	return Vacation::create($dataArray);

    }
    	

    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Vacation::find($data['vacation_id']);
		
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
			
			$delete = Vacation::find($id)->delete();

			return $delete ? true : false;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



 
}