<?php

namespace Medians\Currencies\Infrastructure;

use Medians\Currencies\Domain\Currency;


/**
 * Currency class database queries
 */
class CurrencyRepository 
{

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return Currency::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Currency::groupBy('code')->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Currency();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Currency::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Currency::find($data['currency_id']);
		
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
			
			return Currency::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}