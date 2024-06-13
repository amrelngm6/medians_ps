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

	 
	

	protected $routeLocationRepository ;

	function __construct()
	{
		
		$this->routeLocationRepository = new RouteLocationRepository();
	}

	public function getClassName()
	{
		return Student::class;
	}

	public function find($id)
	{
		return Student::find($id);
	}

	public function get($limit = 100)
	{
		return Student::with('route_location','parent','route')->limit($limit)->orderBy('student_id', 'DESC')->get();
	}

	public function findWithLocations($student_id, $parent_id)
	{
		return Student::where('parent_id', $parent_id)->with('route_location', 'route','subscription')->find($student_id);
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

    	// Store Custom fields
		if (isset($data['field'])) {
	    	$this->storeCustomFields($data['field'], $Object->id);
		}

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

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['student_id']) : '';

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
		
    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $Object->student_id) : '';

    	return $Object->with('route_location')->find($Object->student_id);
    }


	
	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Student::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Student::class)->where('code',$key)->where('model_id', $id)->delete();
					foreach ($value as $k => $v) {
						$Model = CustomField::firstOrCreate($fields);
						$Model->update(['value'=>$v]);
					}
				} else {
					$Model = CustomField::firstOrCreate($fields);
					$Model->update(['value'=>$value]);
				}
			}
	
			return $Model;		
		}
	}



	
}