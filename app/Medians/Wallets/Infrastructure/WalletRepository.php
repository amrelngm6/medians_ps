<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\Wallet;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;


class WalletRepository 
{

	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
	}



	public function find($id)
	{
		return Wallet::with('user')->find($id);
	}

	public function get($limit = 100)
	{
		return Wallet::where('business_id', $this->business_id)->with('user')->limit($limit)->get();
	}
	

	public function getWallet($studentId)
	{
		return Wallet::where('user_id', $studentId)->where('user_type', Student::class)->with('user')->orderBy('created_at', 'DESC')->first();
	}
	
	


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Wallet();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['user_type'] = $this->handleType($data);

		// Return the  object with the new data
    	$Object = Wallet::firstOrCreate($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		unset($data['user_type']);

		$Object = Wallet::find($data['vacation_id']);
		
		if ($Object->date < date('Y-m-d'))
		{
			return __('Not allowed Wallet date has passed');
		}

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
			
			$delete = Route::where('business_id', $this->business_id)->find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

	public function handleType($data) 
	{
		
		switch (strtolower($data['user_type']))
		{
			case 'student':
				return Student::class;
				break;

			case 'parent':
			case 'parents':
				return Parents::class;
				break;
	
			default:
				return $data['user_type'];
				break;
		}
	}


 
}