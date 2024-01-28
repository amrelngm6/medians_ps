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

class Driver extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'drivers';

    protected $primaryKey = 'driver_id';
	
	public $fillable = [
		'business_id',
		'first_name',
		'last_name',
		'email',
		'picture',
		'mobile',
		'vehicle_id',
		'birth_date',
		'driver_license_number',
		'password',
		'generated_password',
		'status',
		'created_by'
	];


	public $appends = ['name', 'photo','password'];

	
	public function getPasswordAttribute()
	{
		return '';
	}

	public function getNameAttribute()
	{
		return $this->first_name. ' '.$this->last_name;
	}
	
	public function getPhotoAttribute()
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}

	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}

	public function vehicle() 
	{
		return $this->hasOne(Vehicle::class, 'vehicle_id', 'vehicle_id');	
	}

	public function route() 
	{
		return $this->hasOne(Route::class, 'driver_id', 'driver_id');	
	}

	public function trip() 
	{
		return $this->hasOne(Trip::class, 'driver_id', 'driver_id')->withCount('waiting_locations','moving_locations')->with('route_locations')->where('trip_status', '!=', 'Completed')->where('trip_date', date('Y-m-d'));	
	}

	public function help_messages() 
	{
		return $this->morphMany(HelpMessage::class, 'user')->orderBy('message_id', 'DESC');	
	}

	public function last_trips() 
	{
		return $this->hasMany(Trip::class, 'driver_id', 'driver_id')->with('route_locations')->orderBy('trip_id', 'DESC');	
	}

	public function total_pickups() 
	{
		return $this->hasManyThrough(TripPickup::class, Trip::class, 'driver_id', 'trip_id', 'driver_id', 'trip_id');
	}


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


	/**
	 * Create Custom filed for Session of driver
	 */
	public function insertCustomField($code, $value)
	{

		$delete = CustomField::where('code', $code)
		->where('model_type', Driver::class)
		->where('model_id', $this->customer_id)
		->delete();

    	// Insert activation code 
		$fillable = [
			'code'=>$code,
			'model_type'=>Driver::class, 
			'model_id'=>$this->driver_id, 
			'value'=>$value
		];

		return CustomField::firstOrCreate($fillable);

	}  



}
