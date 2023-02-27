<?php

namespace Medians\Application\Prices;

use Medians\Infrastructure\Prices as Repo;

use Medians\Domain\Prices\Prices;

class PricesController
{




	/*
	// @var Object
	*/
	protected $repo;


	function __construct()
	{

		$this->repo = new Repo\PricesRepository();
	}


	public function saveItem($params, $device) 
	{
		$check = $this->repo->getByDevice($device);
		if (isset($check->device))
		{
			$check->single_price = $params['single_price'];
			$check->multi_price = $params['multi_price'];
			return $this->repo->edit($check);
		}

		$check = [];
		$check['device'] = $device;
		$check['single_price'] = $params['single_price'];
		$check['multi_price'] = $params['multi_price'];

		return $this->repo->store($check);
	}


	public function deleteItem() 
	{
		return $this->repo->delete();
	}


	public function validate() 
	{

		if (empty($params['single_price']))
		{
			throw new \Exception("Empty Single price", 1);
		}

		if (empty($params['multi_price']))
		{
			throw new \Exception("Empty Multi price", 1);
		}

	}

}
