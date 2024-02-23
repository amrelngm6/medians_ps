<?php

namespace Medians\Drivers\Domain;

use Shared\dbaser\CustomModel;

use Medians\Routes\Domain\Route;
use Medians\Vehicles\Domain\Vehicle;
use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\TripPickup;
use Medians\Help\Domain\HelpMessage;
use Medians\CustomFields\Domain\CustomField;
use Medians\Businesses\Domain\Business;

class DriverApplicantion extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'drivers_applications';

    protected $primaryKey = 'application_id';
	
	public $fillable = [
		'business_id',
		'driver_id',
		'message',
		'status',
	];


	public function getFields()
	{
		return $this->fillable;
	}

	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


	/**
	 * Create Custom filed for Session of DriverApplication
	 */
	public function insertCustomField($code, $value)
	{

		$delete = CustomField::where('code', $code)
		->where('model_type', DriverApplication::class)
		->where('model_id', $this->customer_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>DriverApplication::class, 
			'model_id'=>$this->application_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  



}
