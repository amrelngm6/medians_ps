<?php

namespace Medians\Customers\Infrastructure;

use Medians\Students\Domain\Student;
use Medians\Customers\Domain\StudentApplicant;
use Medians\Locations\Domain\RouteLocation;
use Medians\CustomFields\Domain\CustomField;
use Medians\Packages\Domain\PackageSubscription;


use Illuminate\Database\Capsule\Manager as Capsule;

class StudentApplicantRepository 
{

	
	function __construct()
	{
		

		
	}


	public function find($id)
	{
		return StudentApplicant::find($id);
	}

	
	public function get($limit = 100)
	{
		return StudentApplicant::with('model','subscription')->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function getAll($limit = 100)
	{
		return StudentApplicant::with('model','subscription')->limit($limit)->orderBy('applicant_id', 'DESC')->get();
	}

	public function checkDuplicate($modelId)
	{
		return StudentApplicant::where('model_id', $modelId)->first();
	}

	public function getStudentApplicants($modelId)
	{
		return StudentApplicant::with('model', 'subscription')->where('model_type', Student::class)->where('model_id', $modelId)->get();
	}


	public function getStudent($modelId)
	{
		return Student::find($modelId);
	}
	
	public function eventsByDate($params)
	{
		$query = StudentApplicant::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}
	
	public function allEventsByDate($params)
	{
		$query = StudentApplicant::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}


	/**
	* Find all items between two days 
	*/
	public function getAllByDateCharts($params )
	{

	  	$check = StudentApplicant::whereBetween('created_at' , [$params['start'] , $params['end']])
		->selectRaw('COUNT(*) as y, created_at as label');

  		return $check->limit(5)->groupBy('created_at')->orderBy('created_at', 'ASC')->get();
	}
	
	
	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new StudentApplicant();
		$data['model_type'] = Student::class;
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = StudentApplicant::create($dataArray);

    	// Store subscription
    	!empty($data['subscription']) ? $this->saveSubscription((array) $data['subscription'], $Object) : '';

    	return $Object;
    }
    	
	
	
    /**
     * Update Lead
     */
    public function update($params)
    {

		$Object = StudentApplicant::find($params['applicant_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $params);

		if (strtolower($params['status']) == 'approved')
		{
			$this->updateStudent($params);
		}

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
			
			$delete = StudentApplicant::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


    /**
     * Update Student Transfer Status
     */
    public function updateStudent($params)
    {

		$Object = Student::find($params['model_id']);
		
		$data = ['transfer_status' => 'Approved'];

		// Return the  object with the new data
    	$Object = $Object->update( (array) $data);

		// Update Location status
		$updateLocation = $this->updateLocation($params);

    	return $Object;

    }

    /**
     * Update Lead
     */
    public function updateLocation($params)
    {

		$Object = RouteLocation::where('model_type', Student::class)->where('model_id', $params['model_id'])->first();
		
		$data = [];
		$data['status'] = 'on';
		$data['route_id'] = $params['route_id'];

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
			
			$Object->update(['subscription_id'=>$Model->subscription_id]);

			return $Model;		
		}
	}




 
}