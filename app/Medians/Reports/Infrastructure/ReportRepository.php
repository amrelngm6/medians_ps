<?php

namespace Medians\Reports\Infrastructure;

use Medians\Devices\Domain\Device;
use Medians\Reports\Domain\DailyReport;

class ReportRepository 
{


	protected $app;


	function __construct($app = null)
	{
		$this->app = $app;
	}


	public function store_daily_report($data)
	{
		return DailyReport::storeDailyReport($data);
	}

	public function orders_report($limit = 100)
	{
		return Device::withCount('bookings')->limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Report();

		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$Model = $Model->firstOrCreate($dataArray);

    	$Model->update($dataArray);
    	
		// Return the Model object with the new data
    	return $Model;

	}
	

	/**
	* Update item to database
	*/
	public function update($data) 
	{
		try {
			
			$Object = Report::find($data['id']);
			
			if (!$Object) {
				return translate('this user not found');	
			}


			// Return the Model object with the new data
	    	$Object->update( (array) $data);
	    	
    		return $Object;	

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}


}
