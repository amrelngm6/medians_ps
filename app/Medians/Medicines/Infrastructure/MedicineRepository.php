<?php

namespace Medians\Medicines\Infrastructure;

use Medians\Medicines\Domain\Medicine;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Content\Domain\Content;


class MedicineRepository 
{

	protected $app ;

	function __construct()
	{
		$this->app = new \config\APP;
	}


	public static function getModel()
	{
		return new Medicine();
	}


	public function find($id)
	{
		return Medicine::with('content')->withSum('views', 'times')
		// ->where('status', 'on')
		->find($id);
	}
 
	public function get($limit = 100)
	{
		return Medicine::with('content','author')
		->limit($limit)
		->where('status', 'on')
		->get();
	}

	public function getAll($limit = 100)
	{
		return Medicine::with('content','author')
		->limit($limit)
		->get();
	}

	public function filterSearchTitle($title)
	{
		$title = str_replace([ 'أ','', 'ا',"ى","ة",'ه'], ' ', $title);
		return str_replace(' ', '%', trim($title));
	}
	public function search($request, $limit = 20)
	{	
		$title = $request->get('search') ? $this->filterSearchTitle($request->get('search')) : '';
		$return = Medicine::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%');
		})
		// ->where('status', 'on')
		->with('content','user')->limit($limit)->orderBy('updated_at', 'DESC')
		->get();

		return $return;
	}


	public function similar($item, $limit = 3)
	{

		if (empty($item->content->title))
			return null;
		
		$lang = translate('lang');
		$title = str_replace(' ', '%', $item->content->title);
		return Medicine::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%')->orWhere('content', 'LIKE', '%'.$title.'%');
		})
		->where('id', '!=', $item->id)
		->where('status', 'on')
		->with('content','user')->limit($limit)->orderBy($lang == 'en' ? 'sorting' : 'sorting_ar', 'DESC')->get();
	}

	public function get_root($limit = 100)
	{
		$lang = translate('lang');
		return Medicine::with('content','user')
		->where('id','!=','1')
		->where('status', 'on')
		->limit($limit)->orderBy($lang == 'en' ? 'sorting' : 'sorting_ar','DESC')->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Medicine();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		$dataArray['title'] = Content::generatePrefix($data['content']['en']['title']);
		$dataArray['status'] = 'on';

		// Return the FBUserInfo object with the new data
    	$Object = Medicine::create($dataArray);
    	$Object->update($dataArray);

    	$this->storeContent($data['content'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Medicine::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// Store languages content
    	!empty($data['content']) ? $this->storeContent($data['content'], $data['id']) : '';

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
	
			$deleteContent = Content::where('item_type', Medicine::class)->where('item_id', $id)->delete();

			
			$delete = Medicine::find($id)->delete();

			return true;

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}





	/**
	* Save related items to database
	*/
	public function storeContent($data, $id) 
	{
		Content::where('item_type', Medicine::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Medicine::class;	
				$fields['item_id'] = $id;	
				$fields['lang'] = $key;	
				$fields['prefix'] = isset($value['prefix']) ? $value['prefix'] : Content::generatePrefix($value['title']);	
				$fields['created_by'] = $this->app->auth()->id;

				$Model = Content::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}
	}


	
	/**
	 * Filter short codes for Hooks
	 */
	public function filterShortCode ($item)
	{
		$blogRepo = new BlogRepository;
		return $blogRepo->filterShortCode($item);
	}
	
 

 
}
