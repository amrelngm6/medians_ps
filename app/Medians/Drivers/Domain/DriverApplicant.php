<?php

namespace Medians\Drivers\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;
use Medians\Businesses\Domain\Business;

class DriverApplicant extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'drivers_applicants';

    protected $primaryKey = 'applicant_id';
	
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

	public function driver() 
	{
		return $this->hasOne(Driver::class, 'driver_id', 'driver_id');	
	}


    public function receiverAsDriver()
    {
		$model =  $this->with('driver')->find($this->applicant_id);
		return  $model->driver;
    }
	
    public function receiverAsUser()
    {
		$model =  $this->with('business')->find($this->applicant_id);
		return isset($model->business->owner) ?  $model->business->owner : null;
    }
}
