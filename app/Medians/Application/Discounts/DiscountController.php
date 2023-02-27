<?php

namespace Medians\Application\Discounts;

use Medians\Infrastructure\Discounts as Repo;

class DiscountController
{


	function __construct($app)
	{
		$this->app = $app;
		$this->repo = new Repo\DiscountsRepository($app);
	}


	public function index($request)
	{
	    return render('views/admin/discounts/discounts.html.twig', [
	        'title' => 'Discounts list',
	        'app' => $this->app,
	        'discounts' => $this->repo->get(),
	    ]);
	} 


	public function generateCode()
	{
		return 'D-'.rand(999, 9999);
	} 



	public function validateCodeWithOrder($code, $OrderModel) 
	{
		
		$codeObject = $this->repo->getByCode($code);

		if (empty($codeObject->publish))
		{
			throw new \Exception("Error: code not valid", 1);
		}

		// Set the Discount data
		$this->setModel($this->createModel($codeObject));


		// Check if order minimum cost is valid 
		if ($codeObject->orderMinCost > $OrderModel->cost)
		{
			throw new \Exception("Error: Minimum cost is " . $codeObject->orderMinCost, 1);
		}

		// Check if code endTime is passed
		if (date("Y-m-d H:i:s") > $codeObject->endTime)
		{
			throw new \Exception("Error: Code is expired" , 1);
		}

		return $codeObject;

	}


}
