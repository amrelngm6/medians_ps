<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\BusinessWallet;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Drivers\Domain\Driver;


class BusinessWalletRepository
{


	public function find($id)
	{
		return BusinessWallet::with('user')->find($id);
	}

	public function getBusinessWallet($id)
	{
		return BusinessWallet::with('business', 'user')->where('business_id', $id)->first();
	}

	public function get($limit = 100)
	{
		return BusinessWallet::with('user')->limit($limit)->get();
	}
	
	
	


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new BusinessWallet();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['user_type'] = $this->handleType($data);
		
		// Return the  object with the new data
    	$Object = BusinessWallet::firstOrCreate($dataArray);
    	$Object->update(['code'=>$this->generateCode()]);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		unset($data['user_type']);

		$Object = BusinessWallet::find($data['wallet_id']);
		
		if ($Object->date < date('Y-m-d'))
		{
			return __('Not allowed BusinessWallet date has passed');
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
			
			$delete = Route::find($id)->delete();

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
	
			case 'driver':
			case 'drivers':
				return Driver::class;
				break;
	
			default:
				return $data['user_type'];
				break;
		}
	}


	public function generateCode() 
	{
		$code = date('ym').rand(9999, 999999); 
		return BusinessWallet::where('code', $code)->first() ? $this->generateCode() : $code;
	}


 
}