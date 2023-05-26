<?php

namespace Medians\Expenses\Infrastructure;

use Medians\Expenses\Domain\Expense;


/**
 * Expense class database queries
 */
class ExpensesRepository 
{


	private $app;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	public function getModel()
	{
		return new Expense;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Expense::find($id);
	}

	/*
	// Find items by `params` 
	*/
	public function get($limit = 100) 
	{

		return Expense::with('user')
		->where('branch_id', $this->app->branch->id)
		->orderBy('id', 'DESC')
		->limit($limit)
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Expense::where('branch_id' , $this->app->branch->id)
		->with('user');

	  	if (!empty($params["created_by"]))
	  	{
	  		$check = $check->where('created_by', $params['created_by']);
	  	}

	  	if (!empty($params["start"]))
	  	{
	  		$check = $check->whereDate('created_at' , [$params['start'] , $params['end']]);
	  	}
  		

  		return $check->orderBy('id', 'DESC');
	}


	/**
	 * Get sum of field 
	 * with start & end range
	 */
	public function getSumByDate($sumField, $start, $end)
	{
		$check = Expense::where('branch_id' , $this->app->branch->id)->with('user');
  		$check = $check->whereBetween('created_at' , [isset($start) ? $start : date('Y-m-d') , isset($end) ? $end : date('Y-m-d')]);
  		return $check->orderBy('id', 'DESC')->sum($sumField);
	} 



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Expense();
		$dataArray = ['branch_id'=>$this->app->branch->id];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Expense::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Expense::find($data['id']);
		
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
			
			return Expense::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}