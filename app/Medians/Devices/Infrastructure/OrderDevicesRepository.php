<?php

namespace Medians\Devices\Infrastructure;

use Medians\Devices\Domain\OrderDevice;
use Medians\Devices\Domain\OrderDeviceItem;

class OrderDevicesRepository
{
 	


	public $app ;


	function __construct()
	{
		$this->app = new \config\APP;
	}


	/**
	* Find item by `id` 
	*/
	public function find($id)
	{

		return OrderDevice::with('products','game','user','customer')->with(['device'=>function($q){

			return $q->with('games')->with('products');

		}])->find($id)->toArray();

	}


	/**
	 * Load bookings
	 */
	public function loadBookings()
	{
		return OrderDevice::where('status', 'paid')->where('branch_id', $this->app->branch->id);
	}   


	/**
	* Find item by `id` 
	*/
	public function loadItems()
	{

		return OrderDeviceItem::with('product');

	}



	/**
	 * get Average sales in date range
	 * 
	 */
	public function getAVGBookings($params)
	{

		$check = OrderDevice::whereBetween('start_time' , [date('Y-m-d 00:00:00', strtotime($params['start'])) , date('Y-m-d 23:59:59', strtotime($params['end']))])->selectRaw('SUM(device_cost * TIMESTAMPDIFF(HOUR, start_time, end_time)) AS total_price')->first();

		return isset($check->total_price) ? round($check->total_price, 2) : 0;
	}  



	
	/**
	 * get Average sales in date range
	 * 
	 */
	public function getAVGBookingsCount($params)
	{

		$check = OrderDevice::where('branch_id', $this->app->branch->id)
		->whereBetween('start_time' , [date('Y-m-d 00:00:00', strtotime($params['start'])) , date('Y-m-d 23:59:59', strtotime($params['end']))])
		->selectRaw("count(*) as avg")
		->selectRaw('DATE(start_time) as date')
		->where('status', 'paid')
		->groupBy('date')
		->get();

		$data = !empty($check) ? array_column(json_decode($check), 'avg') : [];


		return !empty($data) ? round(array_sum($data) / count($data), 2) : 0;
	}  


	/**
	 * get Average sales in date range
	 * 
	 */
	public function getAVGProductsCount($params)
	{

		$branchId = $this->app->branch->id;

		$check = OrderDeviceItem::whereHas('branch', function($q) use ($branchId){
			$q->where('branch_id', $branchId);
		})
		->whereBetween('created_at' , [date('Y-m-d 00:00:00', strtotime($params['start'])) , date('Y-m-d 23:59:59', strtotime($params['end']))])
		->selectRaw("count(*) as avg")
		->selectRaw('DATE(created_at) as date')
		// ->where('status', 'paid')
		->groupBy('date')
		->get();

		$data = !empty($check) ? array_column(json_decode($check), 'avg') : [];


		return !empty($data) ? round(array_sum($data) / count($data), 2) : 0;
	}  

}
