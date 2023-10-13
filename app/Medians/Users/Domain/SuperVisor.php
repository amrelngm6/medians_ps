<?php

namespace Medians\Users\Domain;

use Medians\Drivers\Domain\Driver;
use Medians\Routes\Domain\Route;
use Medians\Locations\Domain\PickupLocation;

class SuperVisor extends User
{

	/**
	 * Relation with Route 
	 */
	public function route() 
	{
		return $this->hasOne(Route::class, 'user_id', 'id');
	}

	/**
	 * Relation with PickupLocation 
	 */
	public function pickup_location() 
	{
		return $this->hasOne(PickupLocation::class, 'model_id', 'user_id')->where('model_type', SuperVisor::class);
	}

}
