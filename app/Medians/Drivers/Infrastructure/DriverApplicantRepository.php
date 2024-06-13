<?php

namespace Medians\Drivers\Infrastructure;

use Medians\Drivers\Domain\Driver;
use Medians\Drivers\Domain\DriverApplicant;
use Medians\Drivers\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


use Illuminate\Database\Capsule\Manager as Capsule;

class DriverApplicantRepository 
{


	 
	



	function __construct()
	{
		

		
	}


	public function find($id)
	{
		return DriverApplicant::find($id);
	}

	
	public function get($limit = 100)
	{
		return DriverApplicant::with('driver')
		
		->limit($limit)
		->orderBy('applicant_id', 'DESC')
		->get();
	}

	public function getAll($limit = 100)
	{
		return DriverApplicant::limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function checkDuplicate($driverId)
	{
		return DriverApplicant::where('driver_id', $driverId)->first();
	}

	public function getDriver($driverId)
	{
		return Driver::find($driverId);
	}
	
	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new DriverApplicant();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = DriverApplicant::create($dataArray);

    	return $Object;
    }
    	
	
	
    /**
     * Update Lead
     */
    public function update($params)
    {

		$Object = DriverApplicant::find($params['applicant_id']);
		
		
		// Return the  object with the new data
    	$Object->update( (array) $params);

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
			
			$delete = DriverApplicant::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}