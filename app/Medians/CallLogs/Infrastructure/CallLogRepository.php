<?php

namespace Medians\CallLogs\Infrastructure;

use Medians\CallLogs\Domain\CallLog;
use Medians\CustomFields\Domain\CustomField;
use Medians\Drivers\Domain\Driver;
use Medians\Users\Domain\User;


class CallLogRepository 
{

	public function find($id)
	{
		return CallLog::find($id);
	}

	public function get($limit = 1000)
	{
		return CallLog::with('lead', 'agent')->limit($limit)->orderBy('created_at', 'DESC')->get();
	}


	public function getByDate($params)
	{
		$query = CallLog::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new CallLog();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = CallLog::firstOrCreate($dataArray);

    	return $Object;
    }
    	

    /**
     * Update CallLog
     */
    public function update($data)
    {

		$Object = CallLog::find($data['campaign_id']);
		
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
			
			$delete = CallLog::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}