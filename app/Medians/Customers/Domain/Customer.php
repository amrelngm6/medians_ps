<?php

namespace Medians\Customers\Domain;

use Shared\dbaser\CustomModel;
use Medians\Locations\Domain\RouteLocation;


class Customer extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'customers';

	protected $primaryKey = 'customer_id';

	public $fillable = [
		'business_id',
		'name',
		'email',
		'mobile',
		'picture',
		'gender',
		'model',
		'birth_date',
		'generated_password',
		'password',
		'status'
	];



	public $appends = [ 'photo', 'not_removeable'];

	public function getNotRemoveableAttribute() 
	{
		return true;
	}

	public function getPhotoAttribute() : ?String
	{
		return !empty($this->picture) ? $this->picture : '/uploads/images/default_profile.png';
	}


	public function getFields()
	{
		return $this->fillable;
	}

    public function route_locations()
    {
        return $this->morphMany(RouteLocation::class, 'notifiable');
    }

}
