<?php

namespace Medians\Branches\Infrastructure;

use Medians\Branches\Domain\Branch;


class BranchRepository   
{


	protected $app;


	public function get()
	{
		return Branch::with('owner')->get();
	}

	public function branches($owner_id)
	{
		return Branch::with('owner')->where('owner_id', $owner_id)->get();
	}

	public function getIds()
	{
		return Branch::select('id')->get();
	}


	public function find($id)
	{
		return Branch::find($id);
	}



	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return Branch::whereBetween('created_at' , [$params['start'] , $params['end']])
	  	->limit($limit)
	  	->orderBy('id', 'DESC');
	}
	

	/**
	* Find all items between two days By BranchId
	*/
	public function getByDateCharts($params )
	{

	  	$check = Branch::selectRaw('count(*) as y, DATE(created_at) as label')
		->whereBetween('created_at' , [$params['start'] , $params['end']]);

  		return $check->groupBy('label')->orderBy('label', 'ASC')->get();
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

		// Return the Model object with the new data
    	$Object = Branch::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Branch::find($data['id']);
		
		// Return the Model object with the new data
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
