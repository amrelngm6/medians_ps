<?php

namespace Medians\Vehicles\Infrastructure;

use Medians\Vehicles\Domain\VehicleType;
use Medians\CustomFields\Domain\CustomField;


class VehicleTypeRepository 
{

	 
	



	function __construct()
	{
		

		
	}




	public function find($id)
	{
		return VehicleType::find($id);
	}

	public function get($limit = 100)
	{
		return VehicleType::limit($limit)->get();
	}

	public function getActive($limit = 100)
	{
		return VehicleType::where('status', 'on')->limit($limit)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new VehicleType();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = VehicleType::create($dataArray);
    	$Object->update($dataArray);

    	// Store Custom fields
		if (isset($data['field']))
	    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = VehicleType::find($data['type_id']);
		
		// Return the  object with the new data
    	$update = $Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['type_id']) : '';

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
			
			$delete = VehicleType::find($id)->delete();

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
		CustomField::where('model_type', VehicleType::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = VehicleType::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}


 
}