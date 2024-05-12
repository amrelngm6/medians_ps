<?php

namespace Medians\Cart\Application;

use Medians\Cart\Infrastructure\CartRepository;

use Shared\dbaser\CustomController;

class CartController extends CustomController
{

	/**
	* @var Object
	*/
	protected $repo;

	protected $app;
	

	

	function __construct()
	{
		$this->app = new \config\APP;

		$this->repo = new CartRepository();
	}

	



	public function store() 
	{

		$user = $this->app->auth();

		if (!$user)
		{
			return (new GuestCartController)->store();
		}

		$params = $this->app->request()->get('params');

        try {	

        	$this->validate($params);

            $returnData = (!empty($this->repo->store($params))) 
            ? array('success'=>1, 'result'=>translate('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>'Error', 'error'=>1);

        } catch (\Exception $e) {
        	return array('result'=>$e->getMessage(), 'error'=>1);
        }

		return $returnData;
	}



	public function update()
	{

		$user = $this->app->auth();

		if (!$user)
		{
			return (new GuestCartController)->update();
		}

		$params = $this->app->request()->get('params');

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }
        

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}


	public function delete() 
	{

		$user = $this->app->auth();

		if (!$user)
		{
			return (new GuestCartController)->delete();
		}

		$params = $this->app->request()->get('params');
		
        try {

            if ($this->repo->delete($params['cart_id']))
            {
                return array('success'=>1, 'result'=>translate('Deleted'), 'reload'=>1);
            }
            

        } catch (Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }

	}

	public function validate($params) 
	{
		if (empty($params['item_id']))
		{
        	throw new \Exception(translate('Product is requierd'), 1);
		}
		
		if (empty($params['qty']))
		{
        	throw new \Exception(translate('Qty is requierd'), 1);
		}
	}


	
	/**
	 * Customers index page
	 * 
	 */ 
	public function cart( ) 
	{
		$user = $this->app->auth();

		if (!$user)
		{
			return (new GuestCartController)->cart();
		}

		$items = $this->repo->guest_items($sessionId);
		$price = $this->repo->getPrices($items);
		$total = $price;

		try {
			return render('views/front/pages/cart.html.twig', [
		        'title' => translate('Cart'),
		        'items' => $items,
		        'discount' => '0',
		        'shipping' => '0',
		        'price' => $price,
		        'total' => $total,
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}
	

	
	/**
	 * Customers index page
	 * 
	 */ 
	public function checkout( ) 
	{
		$user = $this->app->auth();


		try {
			return render('views/front/pages/checkout.html.twig', [
		        'title' => translate('Cart'),
		        'items' => [],
		        'discount' => '0',
		        'shipping' => '0',
		        'price' => 0,
		        'total' => 0,
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}
	
	


}
