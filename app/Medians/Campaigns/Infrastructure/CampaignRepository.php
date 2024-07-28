<?php

namespace Medians\Campaigns\Infrastructure;

use Medians\Campaigns\Domain\Campaign;
use Medians\Campaigns\Domain\CampaignLead;
use Medians\CustomFields\Domain\CustomField;
use Medians\Leads\Domain\Lead;
use Medians\Users\Domain\User;


class CampaignRepository 
{

	public function find($id)
	{
		return Campaign::find($id);
	}

	public function get($limit = 100)
	{
		return Campaign::limit($limit)->orderBy('campaign_id', 'DESC')->get();
	}

	public function getLeads($campaignId)
	{
		return Lead::whereHas('campaignLead', function($q) use ($campaignId) {
			$q->where('campaign_id', $campaignId);
		})
		->with('campaignLead')
		->get();
	}


	public function getByDate($params)
	{
		$query = Campaign::whereBetween('created_at', [$params['start'], $params['end']]);
		return $query;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Campaign();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = Campaign::create($dataArray);

    	return $Object;
    }
    	

	/**
	* Save item to database
	*/
	public function storeLead($data) 
	{
		$Model = new CampaignLead();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = CampaignLead::firstOrCreate($dataArray);

    	return $Object;
    }
    	

    /**
     * Update Campaign
     */
    public function update($data)
    {

		$Object = Campaign::find($data['campaign_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    }

    /**
     * Update Campaign Lead
     */
    public function updateLead($data)
    {

		$Object = CampaignLead::find($data['campaign_lead_id']);
		
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
			
			$delete = Campaign::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}