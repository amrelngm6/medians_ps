<?php

namespace Medians\Locations\Infrastructure;

use Medians\Locations\Domain\Destination;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;


class DestinationRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 */ 
	protected $app ;


	function __construct()
	{
	}


	public static function getModel()
	{
		return new Destination();
	}


	public function find($id)
	{
		return Destination::find($id);
	}

	public function get($limit = 100)
	{
		return Destination::limit($limit)->orderBy('destination_id','DESC')->get();
	}

	public function getRouteStudents($route_id)
	{
		return Destination::where('route_id', $route_id)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Destination();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Destination::create($dataArray);


    	return $Object;
    }
    	

    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Destination::find($data['destination_id']);
		
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
			
			$delete = Destination::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function deleteByStudent($student_id) 
	{
		try {
			
			$delete = Destination::where('model_id',$student_id)->where('model_type',Student::class)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



 
}