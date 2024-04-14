<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;
use Medians\Businesses\Domain\Business;

class BusinessApplicant extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'business_applicants';

    protected $primaryKey = 'applicant_id';
	
	public $fillable = [
		'business_id',
		'subscription_id',
		'model_id',
		'model_type',
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
	
	
    public function model()
    {
        return $this->morphTo()->with('route_location');
    }


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


	/**
	 * Create Custom filed for Session of DriverApplicant
	 */
	public function insertCustomField($code, $value)
	{

		$delete = CustomField::where('code', $code)
		->where('model_type', DriverApplicant::class)
		->where('model_id', $this->customer_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>DriverApplicant::class, 
			'model_id'=>$this->application_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  



}
