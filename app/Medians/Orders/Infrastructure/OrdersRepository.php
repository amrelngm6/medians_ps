<?php

namespace Medians\Orders\Infrastructure;

use Medians\Orders\Domain\Order;
use Medians\Products\Domain\Stock;
use Medians\Devices\Domain\OrderDevice;
use Medians\Devices\Domain\OrderDeviceItem;

class OrdersRepository
{


	public $app;


	function __construct ()
	{
		$this->app = new \config\APP;
	}

	/**
	 * Generate code for Branch
	 * 
	 */ 
	public function generateCode($branchId)
	{
		$check = Order::where('branch_id', $branchId)->get()->last();
		$number = isset($check->id) ? (round($check->id) + 1) : 1;
		return ($number > 100)  ? ('I-000'. $number) : ('I-0000'. $number) ;
	} 

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{
		return Order::with('order_devices')
		->find($id);
	}

	/**
	 * Find by code
	 */  
	public function code($code, $branchId = 0)
	{
		return Order::with('cashier','customer')
		->with(['order_device'=> function ($q)
		{
			return $q->with('device')->with('game');
		}])
		->where('branch_id', $branchId)
		->where('code', $code)
		->first();
	} 
	

	/**
	 * Find by codeOnly
	 */  
	public function codeOnly($code)
	{
		return Order::with(['order_device'=> function ($q)
		{
			return $q->with('device')->with('game');
		}])
		->where('code', $code)
		->first();
	} 
	
	/*
	// Find items by `deviceId` 
	*/
	public function getByDevice($deviceId) 
	{

		return  Order::where('deviceId', $deviceId)
		->with('device')
		->orderedBy('updated_at','DESC')
		->get();

	}


	

	/*
	// Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Order::where('branch_id' , $this->app->branch->id)->with(['order_device'=> function ($q)
		{
			return $q->with('device')->with('game');
		}])
		->with('cashier');

	  	if (!empty($params["created_by"]))
	  	{
	  		$check = $check->where('created_by', $params['created_by']);
	  	}

	  	if (!empty($params["status"]))
	  	{
	  		$check = $check->where('status', $params['status']);
	  	}
	  	if (!empty($params["start"]))
	  	{
	  		$check = $check->whereBetween('date' , [$params['start'] , $params['end']]);
	  	}
  		

  		return $check->orderBy('id', 'DESC');
	}

	/*
	// Find all items between two days
	*/
	public function getTotalByDate($date1, $date2 )
	{

	  	return  Order::with('DeviceModel')
	  		->whereDate('endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($date1)))) 
			->whereDate('endTime' , '<', date('Y-m-d H:i:s', strtotime(date($date2)))) 
			->get();
	}

	


	/**
	* Save item to database
	*/
	public function store($data, $items) 
	{
		try {
			
			$Model = new Order();
			
			foreach ($data as $key => $value) 
			{
				if (in_array($key, $Model->getFields()))
				{
					$dataArray[$key] = $value;
				}
			}	

			// Return the FBUserInfo object with the new data
	    	$Object = Order::create($dataArray);
	    	$Object->update($dataArray);
	 	
	    	$this->updateOrderDevice($Object, $items);

	    	$this->updateOrderProducts($Object, $items);

	    	return $Object;

		} catch (Exception $e) {
			return $e->getMessage();
		}
    }
    

    public function updateOrderDevice($Object, $items)
    {

    	foreach ($items as $key => $value) 
    	{
    		$update = OrderDevice::find($value->id)->update(['order_code' => $Object->code, 'status' => 'paid']);
    	}


    }


    public function updateOrderProducts($Object, $items)
    {

    	foreach ($items as $key => $value) 
    	{
    		foreach ($value->products as $product) {
	    		$item = OrderDeviceItem::with('product')->find($product->id);
	    		$item->update(['order_code' => $Object->code, 'status' => 'paid']);
	    		$updateStock = $item->product->pullStock($item->qty)->save();
	    		$updateStock = $this->pullStock($item, $Object);
    		}
    	}
    }


    public function pullStock($item, $Object)
    {

		$stocklog = [
	    	'product_id' => $item->product->id,
	    	'branch_id' => $item->product->branch_id,
	    	'stock' => $item->qty,
	    	'type' =>'pull',
	    	'date' => date('Y-m-d'),
			'model_type' => Order::class,	
			'model_id' => $Object->id,	
	    	'created_by' => $Object->created_by,
		];

		$updateStock = Stock::create($stocklog)->update($stocklog);

		return $updateStock;
    }


}
