<?php

namespace Medians\Branches\Infrastructure;

use Medians\Branches\Domain\Branch;


class BranchRepository   
{




	public function get()
	{

		return Branch::with('owner')->get();

	}


	public function find($id)
	{

		return Branch::find($id);

	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Branch();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Branch::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Branch::find($data['id']);
		
		// Return the FBUserInfo object with the new data
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
			
			return Branch::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}
