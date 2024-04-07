<?php

namespace Medians\Students\Infrastructure;

use Medians\Students\Domain\Student;
use Medians\Students\Domain\Content;
use Medians\Locations\Domain\RouteLocation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Locations\Infrastructure\RouteLocationRepository;
use Medians\Packages\Infrastructure\PackageSubscriptionRepository;


class StudentRepository 
{

	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $routeLocationRepository ;

	function __construct($business)
	{
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
		$this->routeLocationRepository = new RouteLocationRepository($business);
		$this->subscriptionRepository = new PackageSubscriptionRepository($business);
	}

	public function getClassName()
	{
		return Student::class;
	}

	public function find($id)
	{
		return Student::where('business_id', $this->business_id)->find($id);
	}

	public function get($limit = 100)
	{
		return Student::where('business_id', $this->business_id)->with('route_location','parent','route')->limit($limit)->orderBy('student_id', 'DESC')->get();
	}

	public function findWithLocations($student_id, $parent_id)
	{
		return Student::where('parent_id', $parent_id)->with('route_location','subscription')->find($student_id);
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{
		$Model = new Student();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Student::create($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Student
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
     * Update Student
     */
    public function updateStudentInfo($data)
    {	
		$data = (array) $data;

		$Object = Student::find($data['student_id']);
		
		if (!$Object)
		{
			$Object = $this->store($data);
		}

		// Return the  object with the new data
    	$Object->update( $data);

		if (isset($data['location']))
		{
			$this->routeLocationRepository->deleteByStudent($Object->student_id);

			$location = (array) $data['location'];
			$location['model_id'] = $data['student_id'];
			$location['model_type'] = Student::class;
			$this->routeLocationRepository->store($location);
		}
		
    	return $Object->with('route_location')->find($Object->student_id);
    }

	
}