<?php

namespace Medians\Drivers\Infrastructure;

use Medians\Drivers\Domain\Driver;
use Medians\Drivers\Domain\DriverApplicant;
use Medians\Drivers\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


use Illuminate\Database\Capsule\Manager as Capsule;

class DriverApplicantRepository 
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
		return DriverApplicant::find($id);
	}

	
	public function get($limit = 100)
	{
		return DriverApplicant::with('driver')->where('business_id', $this->business_id)->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function getAll($limit = 100)
	{
		return DriverApplicant::where('business_id', $this->business_id)->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function checkDuplicate($businessId, $driverId)
	{
		return DriverApplicant::where('business_id', $businessId)->where('driver_id', $driverId)->first();
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

		$Object = DriverApplicant::where('business_id', $this->business_id)->find($params['applicant_id']);
		
		
		// Return the  object with the new data
    	$Object->update( (array) $params);

		(strtolower($params['status']) == 'approved') ? $this->updateDriverBusiness($params) : null;

    	return $Object;

    }

    /**
     * Update Lead
     */
    public function updateDriverBusiness($params)
    {

		$Object = Driver::find($params['driver_id']);
		
		$data = [];
		$data['business_id'] = $this->business_id;


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
			
			$delete = DriverApplicant::where('business_id', $this->business_id)->find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}