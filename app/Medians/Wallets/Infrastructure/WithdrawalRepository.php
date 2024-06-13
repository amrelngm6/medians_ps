<?php

namespace Medians\Wallets\Infrastructure;

use Medians\Wallets\Domain\Withdrawal;
use Medians\Wallets\Domain\Wallet;
use Medians\CustomFields\Domain\CustomField;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Drivers\Domain\Driver;


class WithdrawalRepository
{


	 
	
	
	function __construct()
	{
	}

	public function find($id)
	{
		return Withdrawal::with( 'user','wallet')->find($id);
	}
    
	public function get($params, $limit = 1000)
	{
		$query = isset($params['start_date']) ? $this->eventsByDate($params) : new Withdrawal;

		return $query->with( 'user','wallet')->limit($limit)->get();
	}
	
	public function getWithdrawal($id)
	{
		return Withdrawal::with( 'user','wallet')->where('user_type', Driver::class)->where('user_id', $id)->first();
	}

	public function getWithdrawals($id)
	{
		return Withdrawal::with( 'user', 'wallet')->where('user_type', Driver::class)->where('user_id', $id)->get();
	}

	public function getDriverWithdrawals($id)
	{
		return Withdrawal::with( 'user', 'wallet')->where('user_type', Driver::class)->where('user_id', $id)->get();
	}

	public function checkPending($id)
	{
		return Withdrawal::with( 'user')->where('user_type', Driver::class)->where('status', 'pending')->where('user_id', $id)->first();
	}

	public function eventsByDate($params)
	{
		return Withdrawal::whereBetween('date', [$params['start_date'], $params['end_date']]);
	}
	
	public function totalPendingAmount($params)
	{
		$query = isset($params['start_date']) ? $this->eventsByDate($params) : new Withdrawal;

		return $query->whereIn('status',['pending', 'approved'])->sum('amount');
	}
	
	
	public function totalCompletedAmount($params)
	{
		$query = isset($params['start_date']) ? $this->eventsByDate($params) : new Withdrawal;

		return $query->whereIn('status',['done'])->sum('amount');
	}
	
	
	public function pendingGroupedByPaymentMethod($params)
	{
		$query = isset($params['start_date']) ? $this->eventsByDate($params) : new Withdrawal;

		return $query->whereIn('status',['pending', 'approved'])->selectRaw('*, ROUND(SUM(amount), 2) as total_amount')->groupBy('payment_method')->get();
	}
	
	public function completedGroupedByPaymentMethod($params)
	{
		$query = isset($params['start_date']) ? $this->eventsByDate($params) : new Withdrawal;

		return $query->whereIn('status',['done'])->selectRaw('*,  ROUND(SUM(amount), 2) as total_amount')->groupBy('payment_method')->get();
	}
	
	


	/**
	* Save item to database
	*/
	public function store($data) 
	{
		$Model = new Withdrawal();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['date'] = date('Y-m-d');
		$dataArray['status'] = 'pending';
		$dataArray['user_type'] = $this->handleType($dataArray);
		$dataArray['wallet_id'] = $this->handleWallet($dataArray);
		
		// Return the  object with the new data
    	$Object = Withdrawal::firstOrCreate($dataArray);

        isset($data['field']) ? $this->storeCustomFields($data['field'], $Object->withdrawal_id) : '';

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Withdrawal::find($data['withdrawal_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

        (isset( $data['status']) && $data['status'] == 'done') ? $this->updateBalance($Object) : '';

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
			
			$check = Withdrawal::find($id);

            if ($check->status == 'pending')
            {
                return $check->delete();
            }

            return translate("Not allowed to be deleted");

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


	public function handleWallet($params) 
	{
		return Wallet::where('user_type', $params['user_type'])
		->where('user_id', $params['user_id'])
		->first()->wallet_id ;
	}


	public function updateBalance($Object) 
	{
        $check = $Object->with('wallet')->find($Object->withdrawal_id);

        $balance = $check->wallet->credit_balance ?? 0;

        $newBalance = $balance - $check->amount;

        $update = $check->wallet->update(['credit_balance'=>$newBalance]);

        return $update;
	}


    
	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Withdrawal::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Withdrawal::class;	
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