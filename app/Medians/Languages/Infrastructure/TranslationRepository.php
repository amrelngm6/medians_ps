<?php

namespace Medians\Languages\Infrastructure;

use Medians\Languages\Domain\Translation;

class TranslationRepository 
{


	public function find($id)
	{
		return Translation::find($id);
	}

	public function findByCode($code)
	{
		return Translation::where('code', $code)->first();
	}

	public function get($limit = 100)
	{
		return Translation::with('items','language')->limit($limit)->groupBy('code')->orderBy('updated_at','DESC')->get();
	}

	/**
	* Save multi Items to database
	*/
	public function storeItems($data) 
	{
		$row = [];

		foreach ($data['translation'] as $key => $value) 
		{
			$row['language_code'] = $key;
			$row['code'] = $data['code'];
			$row['value'] = $value;
			$save = $this->store($row);
		}

		return $save;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Translation();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		


		// Return the  object with the new data
    	$Object = Translation::create($dataArray);
		

    	return $Object;
    }
    	

    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Translation::find($data['translation_id']);
		
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
			
			$delete = Translation::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

 
}