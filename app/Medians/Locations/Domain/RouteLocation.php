<?php

namespace Medians\Locations\Domain;

use Shared\dbaser\CustomModel;
use Medians\Students\Domain\Student;
use Medians\Customers\Domain\Parents;
use Medians\Routes\Domain\Route;
use Medians\Businesses\Domain\Business;
use Medians\Customers\Domain\Employee;
use Medians\Vacations\Domain\Vacation;


class RouteLocation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'route_locations';

    protected $primaryKey = 'location_id';
	
	public $fillable = [
		'business_id',
		'model_type',
		'model_id',
		'route_id',
		'start_latitude',
		'start_longitude',
		'start_address',
		'end_latitude',
		'end_longitude',
		'end_address',
		'saturday',
		'sunday',
		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
		'status',
	];

	public $appends = ['contact_number', 'usertype', 'picture', 'status_text','saturdays','sundays','mondays','tuesdays','wednesdays','thursdays','fridays'];

	public function getUsertypeAttribute() {
		$parts = explode('\\', $this->model_type);
		return strtolower(end($parts));
	}

	public function getSaturdaysAttribute() {
		return !empty($this->saturday) ? true : false;
	}

	public function getSundaysAttribute() {
		return !empty($this->sunday) ? true : false;
	}

	public function getMondaysAttribute() {
		return !empty($this->monday) ? true : false;
	}

	public function getTuesdaysAttribute() {
		return !empty($this->tuesday) ? true : false;
	}

	public function getWednesdaysAttribute() {
		return !empty($this->wednesday) ? true : false;
	}

	public function  getThursdaysAttribute() {
		return !empty($this->thursday) ? true : false;
	}

	public function getFridaysAttribute() {
		return !empty($this->friday) ? true : false;
	}

	public function getStatusTextAttribute() {
		return $this->status == 'on' ? 'on' : '';
	}

	public function getContactNumberAttribute() {
		return isset($this->model->contact_number) ? $this->model->contact_number : '0';
	}


	public function photo() : String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}

	public function getPictureAttribute() : String
	{
		return !empty($this->student->picture) ? $this->student->picture : '/uploads/images/default_profile.png';
	}


	public function thumbnail() 
	{
    	return str_replace('/images/', '/thumbnails/', str_replace(['.png','.jpg','.jpeg'],'.webp', $this->picture));
	}

	
	/**
	 * Relations with onother Models
	 */
	public function business() 
	{
		return $this->hasOne(Business::class, 'business_id', 'business_id');	
	}

	public function parent() 
	{
		return $this->hasOneThrough(Parents::class, Student::class, 'student_id', 'customer_id', 'model_id', 'parent_id');	
	}
	
	public function route() 
	{
    	return $this->hasOne(Route::class, 'route_id', 'route_id')->with('driver');
	}
	
	
	public function vacation() 
	{
    	return $this->hasOne(Vacation::class, 'user_id', 'model_id')->where('date', date('Y-m-d'));
	}
	
	
    public function model()
    {
        return $this->morphTo();
    }
	
    public function receiverAsCustomer()
    {
		$Object = $this->where('model_type', Student::class)->with('parent')->find($this->location_id);
        return $Object->parent;
    }
	
    public function receiverAsDriver()
    {
		$Object = $this->with('route')->find($this->location_id);
        return isset($Object->route->driver) ? $Object->route->driver : null;
    }


}
