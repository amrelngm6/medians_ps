<?php

namespace Medians\Products\Infrastructure;

use Medians\Products\Domain\Product;
use Medians\Products\Domain\Stock;
use Medians\Payments\Domain\Payment;

/**
 * Stock class database queries
 */
class StockRepository 
{


	public $app;



	function __construct()
	{
		$this->app = new \config\APP;
	}
	
	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{
		return  Stock::with('user', 'product')->find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		$query =  Stock::with('user', 'product')

		->where('branch_id', $this->app->branch->id);

		if (!empty($params['product']))
		{
			$query = $query->where('product_id', $params['product']);
		}

		if (!empty($params['by']))
		{
			$query = $query->where('created_by', $params['by']);
		}

		if (!empty($params['created_by']))
		{
			$query = $query->where('created_by', $params['created_by']);
		}

		if (!empty($params['type']) && in_array($params['type'], ['add', 'pull']) )
		{
			$query = $query->where('type', $params['type']);
		}

		if (!empty($params['start']) && !empty($params['end']))
		{
			$query = $query->whereBetween('date', [$params['start'], $params['end']]);
		}

	  	return $query->orderBy('id', 'DESC')->get();
	}

	/*
	// Find available stock 
	*/
	public function getStockObject($product, $qty = 1) 
	{
		return  Stock::where(
			'stock',  '>=' , $qty
		)
		->where(
			'product' , $product
		)
		->with('Products')
		->first();
	}


	/**
	* Find available stock 
	*/
	public function getStock($product, $qty = 1) : ?Int
	{
		$return =  $this->getStockObject($product, $qty);

		return isset($return->stock) ? $return->stock : 0;
	}


	
	/*
	// Find count by month
	*/
	public function getByMonth($month, $nextmonth )
	{

		$query = array( 
  					date('Y-m-d H:i:s', strtotime(date($month))),  
  					date('Y-m-d H:i:s', strtotime(date($nextmonth))) 
				);

	  	return Stock::whereBetween('time', $query)->get();
	  	
	}
	
	
	/*
	// Find count by month
	*/
	public function getLatest($limit ) 
	{
	  	return Stock::where('branch_id', $this->app->branch->id)
	  	->where('type', 'pull')
	  	->with('product','user')
	  	->limit($limit)
	  	->orderBy('id', 'DESC');
	}
	



	/**
	* Save item to Payments
	* 
	* @param Array $data
	* @return Object 
	*/
	public function savePayment($Object, $data) 
	{	

		$Payment = new Payment;

		$data =  [
			'name' => 'Purchase for products Stock',
			'created_by' => $this->app->auth()->id,
			'branch_id' => $this->app->branch->id,
			'invoice_id' => $data['invoice_id'],
			'amount' => $data['amount'],
		];

		return $Payment->addPayment($data);
	}	


	public function updateProductStock($Object)
	{
		return Product::find($Object->product_id)->addStock($Object->stock);
	}


	/**
	* Save item to database
	* 
	* @param Array $data
	* @return Object 
	*/
	public function store($data) 
	{	

		$Model = new Stock();
		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$dataArray['created_by'] = $this->app->auth()->id;
		$dataArray['branch_id'] = $this->app->branch->id;

		// Return the FBUserInfo object with the new data
    	$Object = Stock::create($dataArray);
    	$Object->update($dataArray);

		$this->savePayment($Object, $data['payment']);

		$this->updateProductStock($Object);

		return $Object;
	}


	
	/**
	* Update item at database
	* 
	* @param Object $object
	* @return Object 
	*/
	public function edit($object) 
	{

		
	}



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{

		try {

			$model = Stock::where('branch_id', $this->app->branch->id)->where('id', $id)->first();	

			return $model->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



}