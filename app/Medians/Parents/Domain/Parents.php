<?php

namespace Medians\Parents\Domain;

use Shared\dbaser\CustomModel;

use Medians\Locations\Domain\PickupLocation;
use Medians\Trips\Domain\TripPickup;
use Medians\Students\Domain\Student;
use Medians\CustomFields\Domain\CustomField;

class Parents extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'parents';

    protected $primaryKey = 'parent_id';
	
	public $fillable = [
		'first_name',
		'last_name',
		'picture',
		'contact_number',
		'email',
		'generated_password',
		'password',
		'status',
	];


	public $appends = ['parent_name'];


	public function getParentNameAttribute() : String
	{
		return $this->first_name .' '.$this->last_name;
	}

	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.jpg';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}

	public function students() 
	{
    	return $this->hasMany(Student::class, 'parent_id', 'parent_id');
	}

	public function pending_student() 
	{
		return $this->hasOne(Student::class, 'parent_id', 'parent_id')->where('transfer_status', 'Pending')->with('pickup_location','destination');
	}

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


	

	/**
	 * Create Custom filed for Session of Parent
	 */
	public function insertCustomField($code, $value)
	{

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Parents::class, 
			'model_id'=>$this->parent_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  


}
