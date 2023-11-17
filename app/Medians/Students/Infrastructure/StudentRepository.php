<?php

namespace Medians\Students\Infrastructure;

use Medians\Students\Domain\Student;
use Medians\Students\Domain\Content;
use Medians\Locations\Domain\PickupLocation;
use Medians\Locations\Domain\Destination;
use Medians\CustomFields\Domain\CustomField;
use Medians\Locations\Infrastructure\PickupLocationRepository;


class StudentRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;

	protected $pickupLocationRepository ;


	function __construct()
	{
		$this->pickupLocationRepository = new PickupLocationRepository;
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
		return Student::with('pickup_location','parent')->limit($limit)->orderBy('student_id', 'DESC')->get();
	}

	public function search($request, $limit = 20)
	{
		$title = $request->get('search');
		$arr =  json_decode(json_encode(['id'=>0, 'content'=>['title'=>$title ? $title : '-']]));

		return $this->similar( $arr, $limit);
	}


	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Student::whereHas('content', function($q) use ($title){
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
		CustomField::where('model_type', Student::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Student::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}

    	
    /**
     * Update Lead
     */
    public function updateStudentInfo($data)
    {

		$Object = Student::find($data['student_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

		if (isset($data['pickup_location']))
		{
			$location = (array) $data['pickup_location'];
			$location['model_id'] = $data['student_id'];
			$location['model_type'] = Student::class;
			$this->pickupLocationRepository->store($location);
		}
		
		if (isset($data['destination']))
		{
			$destination = (array)  $data['destination'];
			$destination['model_id'] = $data['student_id'];
			$destination['model_type'] = Student::class;
			$this->pickupLocationRepository->storeDestination($destination);
		}

    	return $Object->with('pickup_location','destination')->find($Object->student_id);
    }

 
}