<?php

namespace Medians\Invoices\Infrastructure;

use Medians\Invoices\Domain\Invoice;
use Medians\CustomFields\Domain\CustomField;
use Medians\Packages\Domain\PackageSubscription;


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
		$this->business_id = isset($business->business_id) ? $business->business_id : null;
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
		return Invoice::with('user', 'items','business')
		->where('business_id', $this->business_id)
		->limit($limit)
		->get();
	}


	/**
	* Find all items between two days By BranchId
	*/
	public function getByDate($params )
	{

	  	$check = Invoice::with('user', 'items')->where('business_id', $this->business_id);

	  	if (!empty($params["date"]))
	  	{
	  		$check = $check->whereDate('date' , [$params['start'] , $params['end']]);
	  	}
  		

  		return $check->orderBy('created_at', 'DESC');
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
    	!empty($data['items']) ? $this->storeItems((array) $data['items'], $Object->invoice_id) : '';

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
	public function storeItems($data, $id) 
	{
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['item_type'] = PackageSubscription::class;	
				$fields['item_id'] = $id;
				$fields['code'] = $key;
				$fields['value'] = $value;

				$Model = InvoiceItem::create($fields);
				$Model->update($fields);
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