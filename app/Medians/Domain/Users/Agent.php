<?php

namespace Medians\Domain\Users;

use Medians\Domain\Properties\Property;

class Agent extends User
{



	public function properties()
	{
		return $this->HasMany(
			Property::class,  'agent_id', 'id'
		);
	}

	

}
