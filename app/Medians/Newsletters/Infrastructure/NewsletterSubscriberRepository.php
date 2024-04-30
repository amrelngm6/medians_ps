<?php

namespace Medians\NewsletterSubscribers\Infrastructure;

use Medians\Newsletters\Domain\NewsletterSubscriber;

class NewsletterSubscriberRepository 
{


	public function find($id)
	{
		return NewsletterSubscriber::find($id);
	}

	public function get($limit = 100)
	{
		return NewsletterSubscriber::limit($limit)->orderBy('name','DESC')->get();
	}

	public function getActive()
	{
		return NewsletterSubscriber::where('status', 'on')->orderBy('subscriber_code','DESC')->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new NewsletterSubscriber();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the  object with the new data
    	$Object = NewsletterSubscriber::create($dataArray);


    	return $Object;
    }
    	

    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = NewsletterSubscriber::find($data['subscriber_id']);
		
		// Return the  object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    }


	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			$delete = NewsletterSubscriber::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

 
}