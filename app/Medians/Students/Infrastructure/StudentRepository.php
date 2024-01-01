<?php

namespace Medians\Students\Infrastructure;

use Medians\Students\Domain\Student;
use Medians\Students\Domain\Content;
use Medians\Locations\Domain\PickupLocation;
use Medians\Locations\Domain\Destination;
use Medians\CustomFields\Domain\CustomField;
use Medians\Locations\Infrastructure\PickupLocationRepository;
use Medians\Locations\Infrastructure\DestinationRepository;


class StudentRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;

	protected $pickupLocationRepository ;
	protected $destinationRepository ;


	function __construct()
	{
		$this->pickupLocationRepository = new PickupLocationRepository;
		$this->destinationRepository = new DestinationRepository;
	}


	public static function getModel()
	{
		return new Student();
	}


	public function find($id)
	{
		return Student::find($id);
	}

	public function get($limit = 100)
	{
		return Student::with('pickup_location','parent','route')->limit($limit)->orderBy('student_id', 'DESC')->get();
	}

	public function findWithLocations($student_id, $parent_id)
	{
		return Student::where('parent_id', $parent_id)->with('pickup_location', 'destination')->find($student_id);
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{
		$Model = new Student();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Student::create($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Student::find($data['student_id']);
		
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
			
			$delete = Student::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

    	
    /**
     * Update Lead
     */
    public function updateStudentInfo($data)
    {

		$Object = Student::find($data['student_id']);
		
		if (!$Object)
		{
			$Object = $this->store($data);
		}

		// Return the  object with the new data
    	$Object->update( (array) $data);

		if (isset($data['pickup_location']))
		{
			$this->pickupLocationRepository->deleteByStudent($Object->student_id);

			$location = (array) $data['pickup_location'];
			$location['model_id'] = $data['student_id'];
			$location['model_type'] = Student::class;
			$this->pickupLocationRepository->store($location);
		}
		
		if (isset($data['destination']))
		{
			$this->destinationRepository->deleteByStudent($Object->student_id);

			$destination = (array)  $data['destination'];
			$destination['model_id'] = $data['student_id'];
			$destination['model_type'] = Student::class;
			$this->destinationRepository->store($destination);
		}

    	return $Object->with('pickup_location','destination')->find($Object->student_id);
    }

	
}