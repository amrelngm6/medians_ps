<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\CollectedCash;
use Medians\Wallets\Domain\Wallet;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Drivers\Domain\Driver;


class CollectedCashRepository
{


	public function find($id)
	{
		return CollectedCash::with('business')->find($id);
	}

	public function getCollectedCash($id)
	{
		return CollectedCash::with('business')->with(['wallet'=>function($q) {
            return $q->with('user');
        }])->where('business_id', $id)->first();
	}

	public function get($params, $limit = 1000)
	{
		$check = new CollectedCash;
        if (isset($params['start_date']))
        {
            $check = $check->whereBetween('date', [$params['start_date'], $params['end_date']]);
        }
        return $check->limit($limit)->get();
	}
	
	
	public function totalDebitBalance()
	{
		return CollectedCash::selectRaw('ROUND(SUM(debit_balance), 2) as amount')->first()->amount;
	}
	
	
	public function totalCreditBalance()
	{
		return CollectedCash::selectRaw('ROUND(SUM(credit_balance), 2) as amount')->first()->amount;
	}
	
	


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new CollectedCash();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['wallet_type'] = $this->handleType($data);
		
		// Return the  object with the new data
    	$Object = CollectedCash::firstOrCreate($dataArray);

        $updateBalance = isset($Object->collection_id) ? $this->updateBalance($Object) : null;

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		unset($data['user_type']);

		$Object = CollectedCash::find($data['collection_id']);
		
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
			
			$delete = CollectedCash::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

	public function handleType($data) 
	{
        return Wallet::class;
	}


	public function updateBalance($Object) 
	{
        $check = $Object->with('wallet')->find($Object->collection_id);

        $balance = $check->wallet->debit_balance ?? 0;

        $newBalance = $balance - $check->amount;

        $update = $check->wallet->update(['debit_balance'=>$newBalance]);

        return $update;
	}


 
}