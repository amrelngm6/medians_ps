<?php

namespace Medians\Domain\Discounts;

use Shared\dbaser\CustomController;


/**
 * Discounts class database queries
 */
class Discount extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'discounts';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'code',
    	'branchId',
    	'useCount',
    	'orderMinCost',
    	'maxDiscount',
    	'value',
    	'endTime',
    	'publish',
    	'insertedBy',
	];

	/**
	* @var bool
	*/
	public $timestamps = false;



	function __construct()
	{

	}

	

	public function id() : ?int
	{
		return $this->id;
	}

	public function code() : ?String
	{
		return $this->code;
	}

	public function useCount() : ?Int
	{
		return $this->useCount;
	}

	public function value() : ?Int
	{
		return $this->value;
	}

	public function maxDiscount() : ?Float
	{
		return $this->maxDiscount;
	}

	public function orderMinCost() : ?Int
	{
		return $this->orderMinCost;
	}


	public function endTime() : ?String 
	{
		return $this->endTime;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}

	public function insertedBy() : ?Int
	{
		return $this->insertedBy;
	}




	public function setId($id) : void
	{
		$this->id = $id;
	}


	public function setCode($code) : void
	{
		$this->code = $code;
	}


	public function setUseCount($useCount) : void
	{
		$this->useCount = $useCount;
	}


	public function setValue($value) : void
	{
		$this->value = $value;
	}

	public function setMaxDiscount($maxDiscount = 0) : void
	{
		$this->maxDiscount = $maxDiscount;
	}

	public function setOrderMinCost($orderMinCost) : void
	{
		$this->orderMinCost = $orderMinCost;
	}

	public function setInsertedBy($insertedBy) : void
	{
		$this->insertedBy = $insertedBy;
	}


	public function setPublish($publish = 0) : void
	{
		$this->publish = $publish;
	}

	public function setEndTime($endTime) : void
	{
		$this->endTime = $endTime;
	}


}
