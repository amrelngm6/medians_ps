<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\BusinessWithdrawal;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Drivers\Domain\Driver;


class BusinessWithdrawalRepository
{


	public function find($id)
	{
		return BusinessWithdrawal::with('business')->find($id);
	}
    
	public function get($limit = 100)
	{
		return BusinessWithdrawal::limit($limit)->get();
	}
	
	public function getBusinessWithdrawal($id)
	{
		return BusinessWithdrawal::with('business')->where('business_id', $id)->first();
	}

	public function getBusinessWithdrawals($id)
	{
		return BusinessWithdrawal::with('business')->where('business_id', $id)->get();
	}

	public function checkPending($id)
	{
		return BusinessWithdrawal::with('business')->where('status', 'pending')->where('business_id', $id)->first();
	}

	


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new BusinessWithdrawal();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['date'] = date('Y-m-d');
		$dataArray['status'] = 'pending';
		
		// Return the  object with the new data
    	$Object = BusinessWithdrawal::firstOrCreate($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		unset($data['user_type']);

		$Object = BusinessWithdrawal::find($data['withdrawal_id']);
		
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
			
			$check = BusinessWithdrawal::find($id);

            if ($check->status == 'pending')
            {
                return $check->delete();
            }

            return __("Not allowed to be deleted");

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
		return BusinessWithdrawal::where('code', $code)->first() ? $this->generateCode() : $code;
	}


 
}