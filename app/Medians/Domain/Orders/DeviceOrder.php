<?php

namespace Medians\Domain\Orders;


use Shared\dbaser\CustomController;

use Medians\Domain\Devices\Device;

class DeviceOrder extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'order_devices';

	/**
	* @var Array
	*/
	public $fillable = [
		'branch_id',	
		'device_id',	
		'device_cost',	
		'order_code',	
		'booking_type',	
		'start_time',	
		'break_time',	
		'end_time',	
		'last_check',	
		'created_by'	
		'status'
	];


	public $appends = ['from', 'to', 'date'];


	public function getDateAttribute()
	{
		return substr($this->created_at, 0, 10);
	}

	public function getFromAttribute()
	{
		return $this->start_time;
	}

	public function getNameAttribute()
	{
		return $this->title;
	}


	/**
	* @var Boolen
	*/
	// public $timestamps = null;

	public function id() : ?int
	{
		return $this->id;
	}


	public function deviceId() 
	{
		return $this->deviceId;
	}

	public function orderCode() : ?String
	{
		return $this->orderCode;
	}

	public function branchId() : ?Int
	{
		return $this->branchId;
	}


	public function bookingType() : String
	{
		return $this->bookingType;
	}


	public function startTime() : ?String
	{
		return $this->startTime;
	}

	public function endTime() : ?String
	{
		return $this->endTime;
	}

	public function lastCheck() : ?String
	{
		return $this->lastCheck;
	}

	public function deviceCost() : ?Float
	{
		return $this->deviceCost;
	}

	public function status() : ?String
	{
		return $this->status;
	}


	public function insertedBy() : ?int
	{
		return $this->insertedBy;
	}

	public function orderedBy() : ?int
	{
		return $this->orderedBy;
	}



	public function spend_time() 
	{
		$interval = (new \DateTime($this->startTime ))->diff(new \DateTime($this->endTime));
		$hours   = $interval->format('%h : %i'); 
		return $hours;
	}




	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setDevice($device) : void
	{
		$this->device = $device;
	}

	public function setBranchId($branchId) : void
	{
		$this->branchId = $branchId;
	}

	public function setOrderCode($orderCode) : void
	{
		$this->orderCode = $orderCode;
	}

	public function setBookingType($bookingType) : void
	{
		$this->bookingType = $bookingType;
	}

	public function setStartTime($startTime) : void
	{
		$this->startTime = $startTime;
	}

	public function setEndTime($endTime) : void
	{
		$this->endTime = $endTime;
	}

	public function setLastCheck($lastCheck) : void
	{
		$this->lastCheck = $lastCheck;
	}

	public function setDeviceCost($deviceCost) : void
	{
		$this->deviceCost = $deviceCost;
	}

	public function setInsertedBy($insertedBy) : void
	{
		$this->insertedBy = $insertedBy;
	}


	public function setOrderedBy($orderedBy) : void
	{
		$this->orderedBy = $orderedBy;
	}


	public function setStatus($status) : void
	{
		$this->status = $status;
	}


	/**
	 * Relations
	 */
	public function device()
	{
		return $this->hasOne(Device::class, 'id', 'deviceId');
	}



}
