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

	public function getLastWeekLeads()
	{
		return Status::whereCount("select `status_list`.*, 
						(select count(*) 
						from `campaign_leads` 
						where `status_list`.`value` COLLATE utf8_unicode_ci = `campaign_leads`.`status` COLLATE utf8_unicode_ci 
						and date(`updated_at`) <= '2024-07-29' 
						and date(`updated_at`) > '2024-07-22') as `leads_count` 
					from `status_list` 
					order by `sort` asc")->get();
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