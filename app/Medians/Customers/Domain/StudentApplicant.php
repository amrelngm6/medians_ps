<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;

use Medians\CustomFields\Domain\CustomField;
use Medians\Packages\Domain\PackageSubscription;

class StudentApplicant extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'student_applicants';

    protected $primaryKey = 'applicant_id';
	
	public $fillable = [
		'subscription_id',
		'route_id',
		'model_id',
		'model_type',
		'message',
		'status',
	];


	public function getFields()
	{
		return $this->fillable;
	}

	public function subscription() 
	{
		return $this->hasOne(PackageSubscription::class, 'subscription_id', 'subscription_id')->with('package');	
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
