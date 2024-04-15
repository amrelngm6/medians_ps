<?php

namespace Medians\Transactions\Infrastructure;

use Medians\Transactions\Domain\Transaction;
use Medians\CustomFields\Domain\CustomField;


/**
 * Transaction class database queries
 */
class TransactionRepository 
{


	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business ;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}


	/**
	* Find item by `transaction_id` 
	*/
	public function find($transaction_id) 
	{
		return Transaction::find($transaction_id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($limit = 500) 
	{
		return Transaction::with('model', 'item')
		->where('business_id', $this->business_id)
		->limit($limit)
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Transaction::with('model', 'item')->where('business_id', $this->business_id);

	  	if (!empty($params["start_date"]))
	  	{
	  		$check = $check->whereBetween('date' , [$params['start_date'] , $params['end_date']]);
	  	}

  		return $check->orderBy('created_at', 'DESC')->get();
	}




	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return Transaction::whereBetween('created_at' , [$params['start'] , $params['end']])
		->where('business_id', $this->business_id)
	  	->limit($limit)
	  	->orderBy('created_at', 'DESC');
	}
	

	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Transaction();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Transaction::create($dataArray);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $Object->transaction_id) : '';

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Transaction::find($data['transaction_id']);
		
		// Return the Model object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $Object->transaction_id) : '';

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($transaction_id) 
	{
		try {
			
			return Transaction::find($transaction_id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Transaction::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Transaction::class;	
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