<?php

namespace Medians\Customers\Domain;

class SuperVisor extends Customer
{

	public $appends = ['supervisor_name','supervisor_id'];

	public function getSupervisorNameAttribute() : String
	{
		return $this->name;
	}

	public function getSupervisorIdAttribute() 
	{
		return $this->customer_id;
	}

	
}
