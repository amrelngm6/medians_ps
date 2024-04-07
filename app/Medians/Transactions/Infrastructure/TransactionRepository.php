<?php

namespace Medians\Transactions\Infrastructure;

use Medians\Transactions\Domain\Transaction;


/**
 * Transaction class database queries
 */
class TransactionRepository 
{



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
		->limit($limit)
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Transaction::with('model', 'item');

	  	if (!empty($params["date"]))
	  	{
	  		$check = $check->whereDate('date' , [$params['start'] , $params['end']]);
	  	}
  		

  		return $check->orderBy('created_at', 'DESC');
	}




	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return Transaction::whereBetween('created_at' , [$params['start'] , $params['end']])
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
    	$Object = Transaction::firstOrCreate($dataArray);

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


}