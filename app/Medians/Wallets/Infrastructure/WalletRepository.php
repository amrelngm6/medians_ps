<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\Wallet;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Drivers\Domain\Driver;


class WalletRepository 
{


	public function find($id)
	{
		return Wallet::with('user')->find($id);
	}

	public function checkBalance($driverId)
	{
		return Wallet::where('user_type', Driver::class)->where('user_id', $driverId)->first();
	}

	public function get($limit = 100)
	{
		return Wallet::with('user')->limit($limit)->get();
	}
	
	public function driverWallet($id)
	{
		return Wallet::where('user_id', $id)->where('user_type', Driver::class)->with('user')->first();
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
    	$Object->update(['code'=>$this->generateCode()]);

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
			return translate('Not allowed Wallet date has passed');
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
		return Wallet::where('code', $code)->first() ? $this->generateCode() : $code;
	}


 
}