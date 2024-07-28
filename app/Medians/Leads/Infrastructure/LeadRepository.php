<?php

namespace Medians\Leads\Infrastructure;

use Medians\CustomFields\Domain\CustomField;
use Medians\Mail\Application\MailService;
use Medians\Leads\Domain\Lead;

class LeadRepository 
{

	 
	

	function __construct()
	{
		
	}

	public function get($limit = 100)
	{
		return Lead::limit($limit)->get();
	}

	public function findByMobile($mobile)
	{
		return Lead::where('mobile', $mobile)->find();
	}


	public function getByAgent($agentId , $campaignId)
	{
		return Lead::whereHas('campaignLead', function($q) use ($agentId, $campaignId) {
			return $q->where('agent_id', $agentId)->where('campaign_id', $campaignId);
		})
		->with(['campaignLead'=> function ($q) use ($agentId, $campaignId) {
			return $q->where('agent_id', $agentId)->where('campaign_id', $campaignId);
		}])
		->get();
	}


	public function find($lead_id)
	{
		return Lead::find($lead_id);
	}



	

	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Lead();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		

		// Return the  object with the new data
    	$Object = Lead::firstOrCreate($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->lead_id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Lead::find($data['lead_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->lead_id);

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
			
			$delete = Lead::find($id)->delete();

			if ($delete){
				$this->storeCustomFields(null, $id);
			}

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
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
				$fields['model_type'] = Lead::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	

				if (is_array($value))
				{
					CustomField::where('model_type', Lead::class)->where('code',$key)->where('model_id', $id)->delete();
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