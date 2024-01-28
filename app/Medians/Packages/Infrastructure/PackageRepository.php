<?php

namespace Medians\Packages\Infrastructure;

use Medians\Packages\Domain\Package;


/**
 * Package class database queries
 */
class PackageRepository 
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
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return Package::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Package::where('business_id', $this->business_id)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Package();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Package::firstOrCreate($dataArray);

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Package::where('business_id', $this->business_id)->find($data['package_id']);
		
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
			
			return Package::where('business_id', $this->business_id)->find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}