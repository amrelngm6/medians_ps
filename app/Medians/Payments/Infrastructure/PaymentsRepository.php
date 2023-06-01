<?php

namespace Medians\Payments\Infrastructure;

use Medians\Payments\Domain\Payment;


/**
 * Payment class database queries
 */
class PaymentsRepository 
{


	private $app;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	public function getModel()
	{
		return new Payment;
	}

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return Payment::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($limit = 500) 
	{

		return Payment::with('user')
		->orderBy('id', 'DESC')
		->limit($limit)
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Payment::where('branch_id' , $this->app->branch->id)
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
		$check = Payment::where('branch_id' , $this->app->branch->id)->with('user');
  		$check = $check->whereBetween('created_at' , [isset($start) ? $start : date('Y-m-d') , isset($end) ? $end : date('Y-m-d')]);
  		return $check->orderBy('id', 'DESC')->sum($sumField);
	} 



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Payment();
		$dataArray = ['branch_id'=>$this->app->branch->id];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Payment::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Payment::find($data['id']);
		
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
			
			return Payment::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}