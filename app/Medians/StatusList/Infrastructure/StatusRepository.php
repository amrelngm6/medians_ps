<?php

namespace Medians\StatusList\Infrastructure;

use Medians\StatusList\Domain\Status;
use Medians\CustomFields\Domain\CustomField;


class StatusRepository 
{

	public function find($id)
	{
		return Status::find($id);
	}

	public function get($limit = 100)
	{
		return Status::limit($limit)->orderBy('sort')->get();
	}

	public function getWithLeads($startData, $endData)
	{
		return Status::with('leads')->limit($limit)->orderBy('sort')->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Status();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Status::create($dataArray);

    	return $Object;
    }
    	

    /**
     * Update Status
     */
    public function update($data)
    {

		$Object = Status::find($data['status_id']);
		
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
			
			$delete = Status::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}