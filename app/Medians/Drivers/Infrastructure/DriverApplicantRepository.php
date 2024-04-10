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
    public function update($data)
    {

		$Object = DriverApplicant::where('business_id', $this->business_id)->find($data['applicant_id']);
		
		$data = [];
		$data['business_id'] = $this->business_id;
		$data['status'] = 'on';
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['applicant_id']) : '';

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

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



	/**
	* validate Email 
	*/
	public function validateEmail($email, $id = 0) 
	{
		if (!empty($email))
		{
			$check = DriverApplicant::where('email', $email)->where('applicant_id', '!=', $id)->first();
		}

		return  (empty($check)) ? null : __('EMAIL_FOUND');
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
				$fields['model_type'] = DriverApplicant::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', DriverApplicant::class)->where('code',$key)->where('model_id', $id)->delete();
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