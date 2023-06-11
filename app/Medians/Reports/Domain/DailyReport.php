<?php

namespace Medians\Reports\Domain;

use Shared\dbaser\CustomModel;

use Medians\Users\Domain\User;
use Medians\Branches\Domain\Branch;


/**
 * DailyReport class database queries
 */
class DailyReport extends CustomModel
{

	/**
	* @var String
	*/
	protected $table = 'daily_reports';

	protected $fillable = [
		'date',
		'branch_id',
		'products_count',
		'products_sales',
		'bookings_count',
		'bookings_sales',
		'expenses',
		'tax',
		'discounts',
		'revenue'
	];



	public function getFields()
	{
		return $this->fillable;
	}


	public function user()
	{
		return $this->hasOne(User::class, 'id', 'receiver_id');
	}

	public function branch()
	{
		return $this->hasOne(Branch::class, 'id', 'receiver_id');
	}


	/**
	 * Store DailyReport from Event
	 * 
	 * @param $branch_id int 
	 * @param $subject String 
	 * @param $receiver Object Receiver of the Notification 
	 */
	public static function storeDailyReport(Array $filled)
	{

		$check = DailyReport::where('date',$filled['date'])->where('branch_id',$filled['branch_id'])->first();

    	// Update if exist
		if (isset($check->id))
			return $check->update($filled);

    	// Store DailyReport
    	return DailyReport::firstOrCreate($filled);
	}  
}
