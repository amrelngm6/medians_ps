<?php

namespace Medians\Invoices\Infrastructure;

use Medians\Invoices\Domain\Invoice;
use Medians\Invoices\Domain\InvoiceItem;
use Medians\CustomFields\Domain\CustomField;
use Medians\Packages\Domain\PackageSubscription;
use Medians\Trips\Domain\PrivateTrip;
use Medians\Plans\Domain\Plan;
use Medians\Users\Domain\User;
use Medians\Plans\Domain\PlanSubscription;


/**
 * Invoice class database queries
 */
class InvoiceRepository 
{


	/**
	 * Business id
	 */ 
	protected $business_id ;

	protected $business ;

	function __construct($business)
	{
		$this->business = $business;
		$this->business_id = isset($business->business_id) ? $business->business_id : 0;
	}


	/**
	* Find item by `invoice_id` 
	*/
	public function find($invoice_id) 
	{
		return Invoice::with('user', 'items')->find($invoice_id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($limit = 500) 
	{
		return Invoice::with('user', 'items','business', 'transaction')
		->where('business_id', $this->business_id)
		->limit($limit)
		->orderBy('invoice_id', 'DESC')
		->get();
	}

	/**
	* Find items by `params` 
	*/
	public function getUserInvoices($userId) 
	{
		return Invoice::with('user', 'items', 'item' ,'business', 'transaction')
		->where('user_id', $userId)
		->where('user_type', User::class)
		->limit(10)
		->orderBy('invoice_id', 'DESC')
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{
	  	$check = Invoice::with('user', 'items','business', 'transaction')
		->where('business_id', $this->business_id);

	  	if (!empty($params["start_date"]))
	  	{
	  		$check = $check->whereBetween('date' , [$params['start_date'] , $params['end_date']]);
	  	}

  		return $check->orderBy('created_at', 'DESC')->get();
	}




	/**
	* Find latest items
	*/
	public function getLatest($params, $limit = 10 ) 
	{
	  	return Invoice::whereBetween('created_at' , [$params['start'] , $params['end']])
		->where('business_id', $this->business_id)
	  	->limit($limit)
	  	->orderBy('created_at', 'DESC');
	}
	

	
	public function eventsByDate($params)
	{
		$query = Invoice::where('business_id', $this->business_id)
		->whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}
	
	public function allEventsByDate($params)
	{
		$query = Invoice::whereBetween('date', [$params['start'], $params['end']]);
		return $query;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Invoice();
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the Model object with the new data
    	$Object = Invoice::firstOrCreate($dataArray);

    	// Store invoice items
    	!empty($data['items']) ? $this->storeItems((array) $data['items'], $Object) : '';

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields((array) $data['field'], $Object->invoice_id) : '';

    	return $Object;
	}


	/**
	* Update item to database
	*/
    public function update($data)
    {

		$Object = Invoice::find($data['invoice_id']);
		
		// Return the Model object with the new data
    	$Object->update( (array) $data);

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields((array) $data['field'], $Object->invoice_id) : '';

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($invoice_id) 
	{
		try {
			
			return Invoice::find($invoice_id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	/**
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Invoice::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Invoice::class;	
				$fields['model_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}

	
	/**
	* Save related items to database
	*/
	public function handleClass($value)
	{
		switch ($value) 
		{
			case 'PackageSubscription':
				return PackageSubscription::class;
				break;

			case 'PrivateTrip':
				return PrivateTrip::class;
				break;

			case 'PlanSubscription':
				return PlanSubscription::class;
				break;

			case 'Plan':
				return Plan::class;
				break;
		}
	}

	
	/**
	* Save related items to database
	*/
	public function storeItems($data, $invoice) 
	{
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$value = (object) $value;
				$fields = array();
				$fields['business_id'] = $invoice->business_id;
				$fields['invoice_id'] = $invoice->invoice_id;
				$fields['subtotal'] = $value->subtotal;
				$fields['discount_amount'] = 0;
				$fields['total_amount'] = $value->total_amount;
				$fields['item_id'] = $value->item_id;
				$fields['item_type'] = $this->handleClass($value->item_type);	
				$fields['date'] = date('Y-m-d');
				$fields['status'] = $value->status;
				$Model = InvoiceItem::create($fields);
			}
	
			return $Model;		
		}
	}


	/**
	 * Generate invoice code
	 */
	public function generateCode()
	{
		$count = Invoice::where('business_id', $this->business_id)->count();
		$prefix = "I-".$this->business_id."-";
		return $prefix.($count + 1);
	}
}