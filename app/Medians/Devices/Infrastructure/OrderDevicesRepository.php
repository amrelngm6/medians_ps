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
	public function loadBookingsIncome($params)
	{

		$check = OrderDevice::where('branch_id' , $this->app->branch->id)
		->where('status', 'paid')
		->whereBetween('start_time' ,  [$params['start'] , $params['end']])
		->get();

		$total = 0;
		foreach($check as $row)
		{
			$total += round($row->subtotal, 2);
		}
		return $total;
	}   


	/**
	* Find item by `id` 
	*/
	public function loadProductsIncome($params)
	{

		return OrderDeviceItem::whereHas('Branch')
		->whereBetween('created_at' , [$params['start'] , $params['end']])

		->sum('price');

	}



	/**
	 * get Average sales in date range
	 * 
	 */
	public function getAVGBookings($params)
	{

		$check = OrderDevice::where('branch_id', $this->app->branch->id)
		->whereBetween('start_time' , [$params['start'] , $params['end']])
		->get();

		$data = !empty($check) ? array_column(json_decode($check), 'subtotal') : [];

		return !empty($data) ? round((array_sum($data) / count($data)), 2) : 0;
	}  



	
	/**
	 * get Average sales in date range
	 * 
	 */
	public function getAVGBookingsCount($params)
	{

		$check = OrderDevice::where('branch_id', $this->app->branch->id)
		->whereBetween('start_time' , [date('Y-m-d 00:00:00', strtotime($params['start'])) , date('Y-m-d 23:59:59', strtotime($params['end']))])
		->selectRaw("count(*) as avg_count")
		->selectRaw('DATE(start_time) as date')
		->where('status', 'paid')
		->groupBy('date')
		->get();

		$data = !empty($check) ? array_column(json_decode($check), 'avg_count') : [];


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
