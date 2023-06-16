<?php

namespace Medians\Devices\Infrastructure;

use Medians\Devices\Domain\Device;
use Medians\Devices\Domain\DeviceGames;
use Medians\Devices\Domain\OrderDevice;
use Medians\Games\Domain\Game;
use Medians\Orders\Domain\Order;
use Medians\Products\Domain\Product;

use Medians\Prices\Domain\Prices;
use Medians\Devices\Domain\OrderDeviceItem;




class DevicesRepository  
{

	public $app ;

	function __construct()
	{
		$this->app = new \config\APP;
	}




	/**
	* Return Device Model  
	*/
	public function getModel()
	{
		return new Device;
	}

	/**
	* Find item by `id` 
	*/
	public function find($deviceId)
	{

		return Device::with('prices')->with('category')->find($deviceId);

	}


	/**
	* Find item by `branch` 
	*/
	public function getByBranch($branchId)
	{
		return Device::where('branch_id', $branchId)
		->with('prices')
		->with('currentOrder')
		->with('category')
		->get();
	}

	/**
	* Find all items 
	*/
	public function getAll()
	{
		return  Device::where('branch_id', $this->app->branch->id)
		->with('category')
		->with('prices')
		->with('games')
		->get();
	}

	/**
	* Find all items 
	*/
	public function get($limit = 20)
	{
		return  Device::where('branch_id', $this->app->branch->id)
		->with('prices')
		->with('games')
		->where('status', '!=', '0')
		->limit($limit)
		->get();
	}

	/**
	* Find all items with Category & Active Bookings
	*/
	public function getWithBookings($limit = 20)
	{
		return  Device::where('branch_id', $this->app->branch->id)
		->with('prices', 'active_booking', 'pending_bookings', 'category')
		->where('status', '!=', '0')
		->limit($limit)
		->get();
	}

	/**
	 * Get the most used devices
	 */ 
	public function mostPlayed($params, $limit = 5)
	{
		return Device::withCount(['bookings'=>function($q)use($params){
			$q->whereBetween('start_time' , [$params['start'] , $params['end']]);
		}])
		->whereHas('bookings', function($q) use ($params){
			$q->whereBetween('start_time' , [$params['start'] , $params['end']]);
		})		
		->where('branch_id', $this->app->branch->id)
		->orderBy('created_at', 'ASC')
		->limit($limit)
		->get();
	}



	/**
	* Find all items 
	*/
	public function getApi($limit = 20)
	{
		return  Device::where('branch_id', $this->app->branch->id)
		->get();
	}



	public function events($params,$limit = 10)
	{
		$query = OrderDevice::with('game')->with(['device'=>function($q){
			return $q->with('prices');
		}])->with('user')->with('products')->with('customer');
		// ->where('branch_id', $this->app->branch->id);

		$query->where('branch_id', isset($params['branch_id']) ? $params['branch_id'] : $this->app->branch->id);

		if (!empty($params['by']))
		{
			$query->where('created_by', $params['by']);
		}

		if (!empty($params['status']) && in_array($params['status'], ['active', 'completed', 'paid', 'canceled', 'new']) )
		{
			$query->where('status', $params['status']);
		}

		if (!empty($params['start']) && !empty($params['end']))
		{
			$start = date('Y-m-d 00:00:00', strtotime(date($params['start'])));
			$end = date('Y-m-d 00:00:00', strtotime(date($params['end'])));
			$query->whereBetween('start_time', [$start, $end]);
		}  else {
			$query->whereBetween('start_time', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')]);
		}


		return $query->limit($limit)->orderBy('id', 'DESC')->get();
	}


	public function device_orders($params,$limit = 10)
	{
		$query = OrderDevice::with('game')->with(['device'=>function($q){
			return $q->with('prices');
		}])->with('user')->with('products')->with('customer')
		->where('branch_id', isset($params['branch_id']) ? $params['branch_id'] : $this->app->branch->id);

		if (!empty($params['status']) && in_array($params['status'], ['active', 'completed', 'paid', 'canceled', 'new']) )
		{
			$query->where('status', $params['status']);
		}
		
		return $query->limit($limit)->orderBy('id', 'DESC')->get();
	}



	public function eventsByDate($params,$branchId = 0)
	{
		$query = OrderDevice::with('game','device','user','products')
		->where('branch_id', $branchId ? $branchId : $this->app->branch->id)
		->whereBetween('start_time', [$params['start'], $params['end']]);


		return $query;
	}



	public function getLatest($params)
	{
		return OrderDevice::with('game','device','user','products')
		->whereBetween('start_time', [$params['start'], $params['end']]);
	}


	public function orderProducts($params,$limit = 10)
	{
		$query = OrderDevice::with('products')->whereHas('products', function($q){
			})
		->where('branch_id', $this->app->branch->id);

		return $query->limit($limit)->orderBy('id', 'DESC');
	}


	public function getGames($type,$limit = 50)
	{
		return Game::where('category' , $type )->limit($limit)->get();
	}


	/**
	 * Get sum of field 
	 * with start & end range
	 */
	public function getSumByDate($sumField, $start, $end, $branchId = 0)
	{
		$check = Order::where('branch_id' , $branchId ? $branchId : $this->app->branch->id)
		->with(['order_device'=> function ($q)
		{
			return $q->with('device')->with('game')->where('status', 'paid');
		}])
		->with('cashier')
		->whereBetween('date' , [$start , $end]);

  		return $check->orderBy('id', 'DESC')->sum($sumField);
	} 



	/**
	 * Get sum of field 
	 * with start & end range
	 */
	public function getSumAllByDate($sumField, $start, $end)
	{
		$check = Order::with(['order_device'=> function ($q)
		{
			return $q->with('device')->with('game')->where('status', 'paid');
		}])
		->with('cashier')
		->whereBetween('date' , [$start , $end]);

  		return $check->orderBy('id', 'DESC')->sum($sumField);
	} 



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Device();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Device::firstOrCreate($dataArray);


    	if (isset($data['prices']))
    	{
    		$this->storePrices($data['prices'], $Object->id);
    	}

    	if (isset($data['selected_games']))
    	{
    		$this->storeGames($data['selected_games'], $Object->id);
    	}

    	return $Object;
    }
    	
    /**
     * Update Row
     */
    public function update($data)
    {

		$Object = Device::find($data['id']);
		
		// Return the Model object with the new data
    	$Object->update( (array) $data);

    	isset($data['prices']) ? $this->storePrices($data['prices'], $Object->id) : null;

		$this->storeGames(isset($data['selected_games']) ? $data['selected_games'] : null, $Object->id);

    	return $Object;

    } 


    /**
     * Destroy Row
     */
    public function destroy($data)
    {

		$Object = Device::find($data['id']);
		
		// Return the Model object with the new data
    	$Object->delete();

    	return $Object;

    } 



	/**
	* Save item to database
	*/
	public function storePrices($data, $id) 
	{
		Prices::where('model_type', Device::class)->where('model_id', $id)->delete();
		if ($data)
		{

			foreach ($data as $key => $value)
			{
				$fields = [
					'model_type' => Device::class,
					'model_id' => $id,
					'code' => $key,
					'value' => $value,
					'created_by' => $this->app->auth()->id
				];

				$Model = Prices::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}


	/**
	* Save item to database
	*/
	public function storeGames($data, $id) 
	{
		DeviceGames::where('device_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [
					'game_id' => $value,
					'device_id' => $id,
				];

				$Model = DeviceGames::firstOrCreate($fields);
			}
	
			return $Model;		
		}
	}



    /**
     * Store Order Device
     */
    public function storeOrder($data)
    {
    	// print_r($data);
    	// return null;
		$Device = Device::with('prices')->find($data['device_id']);
		$data['start_time'] = $this->getStartTime($data);
		$data['end_time'] = $this->getEndTime($data);
		$data['game_id'] = isset($data['game_id']) ? $data['game_id'] : 0;
		$data['branch_id'] = $this->app->branch->id;
		$data['device_id'] = $Device->id;
		$data['order_code'] = null;
		$data['break_time'] = 0;
		$data['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : 'single';
		$data['device_cost'] = empty($Device->price) ? 0 : (($data['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price);
		$data['break_time'] = 0;
		$data['last_check'] = 0;
		$data['customer_id'] = $data['customer_id'];
		$data['status'] = $data['status'];
		$data['created_by'] = $this->app->auth()->id;

		$Object = new OrderDevice;
		// Return the Model object with the new data
    	$Object = $Object->create( (array) $data);

    	return $Object;
    } 

    /**
     * Handle End Time for bookings
     */
    public function handleEndTime($item)
    {
    	if (isset($item['max_time']))
    		return date('Y-m-d H:i', strtotime('+'.$item['max_time'].' minutes', strtotime(date('Y-m-d H:i:s'))));

    	return 0;
    }  

    /**
     * Store Order Device
     */
    public function storeBooking($data)
    {


    	// print_r($data);
    	// return null;

		$Device = Device::with('prices')->find($data['id']);
		$data['start_time'] = date('Y-m-d H:i:s');
		$data['end_time'] = $this->handleEndTime($data);
		$data['game_id'] = isset($data['game_id']) ? $data['game_id'] : 0;
		$data['branch_id'] = $this->app->branch->id;
		$data['device_id'] = $Device->id;
		$data['order_code'] = null;
		$data['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : 'single';
		$data['device_cost'] = empty($Device->price) ? 0 : (($data['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price);
		$data['break_time'] = 0;
		$data['last_check'] = 0;
		$data['customer_id'] = 0;
		$data['status'] = 'active';
		$data['created_by'] = $this->app->auth()->id;

		$Object = new OrderDevice;
		// Return the Model object with the new data
    	$Object = $Object->create( (array) $data);

    	return $Object;
    } 


    /**
     * Update Order Device
     */
    public function updateOrder($data)
    {

		$Object = OrderDevice::find($data['id']);

		$Device = Device::with('prices')->find(isset($data['device_id']) ? $data['device_id']:$Object->device_id);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['start_time'] = $this->getStartTime($data);
		$newData['end_time'] = $this->getEndTime($data);
		$newData['game_id'] = isset($data['game_id']) ? $data['game_id'] : $Object->game_id;
		$newData['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : $Object->booking_type;
		$newData['device_cost'] = ($newData['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price;
		$newData['status'] = $data['status'];
		$newData['device_id'] = $data['device_id'];
		$newData['date'] = date('Y-m-d');
		$newData['customer_id'] = !empty($data['customer_id']) ? $data['customer_id'] : $Object->customer_id;

		// if ($data['status'] == 'completed' && $data['status'] != $Device->status )
		// {
		// 	$bookingDay = date('Ymd', strtotime($data['startStr']));
		// 	$newData['end_time'] = (date('Ymd') > $bookingDay) ? date('Y-m-d 23:59:59', strtotime($data['startStr'])) : ( date('Hi') > date('Hi', strtotime($data['to'])) ? $data['to'] : date('Y-m-d H:i:s') );
		// }


		// Return the Model object with the new data
    	$Object->update( (array) $newData);

    	return $Object;

    } 


    /**
     * Update Booking information
     */
    public function updateBooking($data)
    {

		$Object = OrderDevice::find($data['id']);

		$Device = Device::with('prices')->find(isset($data['device_id']) ? $data['device_id']:$Object->device_id);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['start_time'] = $data['start_time'];
		$newData['end_time'] = date('Y-m-d H:i:s');
		$newData['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : $Object->booking_type;
		$newData['device_cost'] = ($newData['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price;
		$newData['status'] = $data['status'];
		// $newData['game_id'] = isset($data['game_id']) ? $data['game_id'] : $Object->game_id;
		// $newData['device_id'] = $data['device_id'];
		// $newData['customer_id'] = !empty($data['customer_id']) ? $data['customer_id'] : $Object->customer_id;

		// Return the Model object with the new data
    	$Object->update( (array) $newData);

    	return $Object;

    } 


    /**
     * Cancel Order Device
     */
    public function cancelOrder($data)
    {
		$Object = OrderDevice::find($data['id']);

		$newData = [];
		if ($data['status'] != 'paid' )
		{
			$newData['status'] = 'canceled';

			// Return the Model object with the new data
	    	$Object->update( (array) $newData);
		}



    	return $Object;

    } 


    /** 
    * Start date
    */
    public function getStartTime($params)
    {
    	return isset($params['from'])
    	? $params['from']
    	: $params['date'].' '.$params['start'];

    } 


    /** 
    * End date
    */
    public function getEndTime($params)
    {
    	return isset($params['to'])
    	? $params['to']
    	: $params['date'].' '.$params['end'];

    } 


    /**
     * Add Order Device product
     */
    public function removeProduct($id)
    {
    	return OrderDeviceItem::where('id', $id)->delete();
    }

    /**
     * Add Order Device product
     */
    public function storeProduct($id, $data)
    {
		$Object = OrderDevice::find($id);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['order_device_id'] = isset($Object->id) ? $Object->id : 0;
		$newData['model_type'] = Product::class;
		$newData['model_id'] = $data['id'];
		$newData['qty'] = $data['qty'];
		$newData['price'] = $data['price'];
		$newData['created_by'] = $this->app->auth()->id;

		// Return the Model object with the new data
    	$Object = OrderDeviceItem::firstOrCreate($newData);

    	if ($Object->wasRecentlyCreated){
    		return $Object;
    	} else {
    		$Object->increment('qty');
    		return $Object;
    	} 


    } 




}
