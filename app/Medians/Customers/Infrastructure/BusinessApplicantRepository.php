<?php

namespace Medians\Customers\Infrastructure;

use Medians\Students\Domain\Student;
use Medians\Customers\Domain\BusinessApplicant;
use Medians\CustomFields\Domain\CustomField;
use Medians\Packages\Domain\PackageSubscription;


use Illuminate\Database\Capsule\Manager as Capsule;

class BusinessApplicantRepository 
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
		return BusinessApplicant::find($id);
	}

	
	public function get($limit = 100)
	{
		return BusinessApplicant::with('model')->where('business_id', $this->business_id)->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function getAll($limit = 100)
	{
		return BusinessApplicant::where('business_id', $this->business_id)->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function checkDuplicate($businessId, $modelId)
	{
		return BusinessApplicant::where('business_id', $businessId)->where('model_id', $modelId)->first();
	}

	public function getStudentApplicants($businessId, $modelId)
	{
		return BusinessApplicant::where('model_type', Student::class)->where('model_id', $modelId)->first();
	}

	public function getStudent($modelId)
	{
		return Student::find($modelId);
	}
	
	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new BusinessApplicant();
		$data['model_type'] = Student::class;
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = BusinessApplicant::create($dataArray);

    	// Store subscription
    	!empty($data['subscription']) ? $this->saveSubscription((array) $data['subscription'], $Object) : '';

    	return $Object;
    }
    	
	
	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = BusinessApplicant::where('business_id', $this->business_id)->find($data['applicant_id']);
		
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
			
			$delete = BusinessApplicant::where('business_id', $this->business_id)->find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


    /**
     * Update Lead
     */
    public function updateStudentBusiness($data)
    {

		$Object = Student::find($data['model_id']);
		
		$data['business_id'] = $this->business_id;
		$data['transfer_status'] = 'Approved';

		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    }



	/**
	* Save related items to database
	*/
	public function saveSubscription($data, $Object) 
	{
		if ($data)
		{
			$fields = [];

			$fields['business_id'] = $Object->business_id;
			$fields['model_id'] = $Object->model_id;
			$fields['model_type'] = $Object->model_type;
			$fields['package_id'] = $data['package_id'];
			$fields['start_date'] = $data['start_date'];
			$fields['end_date'] = $data['end_date'];
			$fields['payment_type'] = $data['payment_type'];
			$fields['payment_status'] = 'unpaid';
			$fields['daily_trips'] = 2;
			$fields['total_cost'] = $data['total_cost'];
			$fields['notes'] = $data['notes'];

			$Model = PackageSubscription::firstOrCreate($fields);
	
			return $Model;		
		}
	}




 
}