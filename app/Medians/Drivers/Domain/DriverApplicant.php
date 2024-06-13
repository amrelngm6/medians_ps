<?php

namespace Medians\Drivers\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;


class DriverApplicant extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'drivers_applicants';

    protected $primaryKey = 'applicant_id';
	
	public $fillable = [

		'driver_id',
		'message',
		'status',
	];


	public function getFields()
	{
		return $this->fillable;
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
    }
}
