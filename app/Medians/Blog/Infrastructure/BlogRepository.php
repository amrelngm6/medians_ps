<?php

namespace Medians\Blog\Infrastructure;

use Medians\Blog\Domain\Blog;
use Medians\Hooks\Domain\Hook;
use Medians\Blog\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


class BlogRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{
		$this->app = new \config\APP;
		foreach ($this->get(100) as $key => $value) 
		{
			// (new \Medians\Media\Infrastructure\MediaRepository)->resize($value->picture, 270, 224);
		}

	}


	public static function getModel()
	{
		return new Blog();
	}


	public function find($id)
	{
		return Blog::with('content')->find($id);
	}

	public function get($limit = 500, $lang = null)
	{
		
		return Blog::with('user','content')->with(['category'=>function($q){
			return $q->with('content');
		}])->limit($limit)->orderBy('id', 'DESC')->get();
	}

	
	public function getFront($limit = 100, $lang = null)
	{
		return Blog::with('user','content')->whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})
		->with(['category'=>function($q){
			return $q->with('content');
		}])->limit($limit)
		->orderBy('id', 'DESC')->get();
	}


	public function getByCategory($id, $limit = 100)
	{
		return Blog::with('content','user')->whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})
		->where('category_id', $id)->limit($limit)->orderBy('id', 'DESC')->get();
	}

	public function getFeatured($limit = 1)
	{
		return Blog::with('content','user')
		->whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})->orderBy('updated_at', 'DESC')->first();
	}

	public function filterSearchTitle($title)
	{
		$title = str_replace(
			[ 'اسباب' ,'اسماعيل','افراز','مجهرى','تاخر','اهم','المجهرى','','','','','','','','','','','']
			, ['أسباب',"إسماعيل",'إفراز','مجهري','تأخر','أهم','المجهري','','','','','','','','','','','']
			, $title);
		return str_replace(' ', '%', trim($title));
	}
	public function search($request, $limit = 20)
	{
		$title = $request->get('search') ? $this->filterSearchTitle($request->get('search')) : '';
		$return = Blog::whereHas('content', function($q) use ($title){
			$q->where('title', 'LIKE', '%'.$title.'%');
		})
		->where('status', '!=', '0')
		->with('content','user')
		->limit($limit)->orderBy('updated_at', 'DESC')
		->get();

		return $return;
	}

	public function similar($item, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $item->content->title);

		return Blog::whereHas('content', function($q) use ($title){
			foreach (explode('%', $title) as $i) {
				$q->where('title', 'LIKE', '%'.$i.'%')->orWhere('content', 'LIKE', '%'.$i.'%');
			}
		})
		->where('id', '!=', $item->id)
		->with('category', 'content','user')->limit($limit)->orderBy('updated_at', 'DESC')->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Blog();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Blog::create($dataArray);
    	$Object->update($dataArray);

    	// Store languages content
    	$this->storeContent($data['content'], $Object->id);

    	// Store Custom fields
    	$this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Blog::find($data['id']);
		
		$data['updated_at'] = date('Y-m-d H:i:s');
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// Store languages content
    	!empty($data['content']) ? $this->storeContent($data['content'], $data['id']) : '';

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['id']) : '';

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
			
			$delete = Blog::find($id)->delete();

			if ($delete){
				$this->storeContent(null, $id);
				$this->storeCustomFields(null, $id);
			}

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
		Content::where('item_type', Blog::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Blog::class;	
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
	* Save related items to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('item_type', Blog::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['item_type'] = Blog::class;	
				$fields['item_id'] = $id;	
				$fields['code'] = $key;	
				$fields['value'] = $value;

				$Model = CustomField::create($fields);
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
		$postContent = $item->content->content;

		$hooks = $this->_plugins_shortcode_filter($postContent);
		
		if (!empty($hooks[2][0])) {
			
			foreach ($hooks[2] as $key => $value) 
			{
				$codeToReplace = $hooks[0][$key];
				$id = $hooks[2][$key];

				$hook = Hook::find($id);
				$hookContent = unserialize($hook->content)['content'];

				$postContent = str_replace($codeToReplace, $hookContent, $postContent);
				
			}
		}

		$output = str_replace("h=&amp;", '', $postContent);
		preg_match_all('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $output, $matches);
		if (isset($matches[1]))
		{
			foreach ($matches[1] as $k => $match) {
				$video = str_replace('https://www.youtube.com/embed/' , '', $match); 
				$videoContent = $this->videoContent($video);
				$output = str_replace($matches[0][$k] , $videoContent, $output); 
			}
		}
		
		$item->content->content = $output;
		return $item;
	}
	
 
	public static function _plugins_shortcode_filter($val) {
		
		/** 
		 * Plugin shortcode 
		 * Usage:  [--@plugin= Plugin Name --@id= Plugin ID --]
		 * 
		*/
		
		preg_match_all("|\[--@plugin=(.*)\--@id=(.*)\--](.*)</[^>]+>|U", $val, $matches, PREG_PATTERN_ORDER);	
		
		return $matches;
		
	}
	
	

	public function videoContent($video_id)
	{
		$img = $this->videoFrame($video_id);
		return '
		<div class="video-center show-modal-iframe relative" data-youtube-link="'.$video_id.'">
			<img alt="Bedaya" width="800" height="570" class="mx-auto  lazy" src="'.$img.'">
			<img loading="lazy" alt="Bedaya" class="cursor-pointer w-16 lg:w-24 bg-white rounded-full p-1 lg:p-3 mx-auto absolute my-auto left-0 right-0 top-0 bottom-0 lazy" src="/stream?image=/uploads/img/play-button_en.webp">
		</div>
		';
	}

	public function storeFrame($remoteFile, $video_id)
	{
		$filepath =  '/uploads/youtube/'.$video_id.'.jpg';
		file_put_contents($_SERVER['DOCUMENT_ROOT'].$filepath, file_get_contents($remoteFile));
		return $filepath;
	}

	public function videoFrame($video_id)
	{

		if (is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/youtube/'.$video_id.'.jpg'))
			return '/uploads/youtube/'.$video_id.'.jpg';

		$yt = new \helper\YTChannel('AIzaSyAX2RDygDexQhJ2QXhBUvY4LPlNZdlzXb8');

		$output = $yt->video_info($video_id);

		if (!empty($output['thumbnails']['hd']))
			return $this->storeFrame($output['thumbnails']['hd'], $video_id);
		
			if (!empty($output['thumbnails']['high']))
			return $this->storeFrame($output['thumbnails']['high'], $video_id);
		
		if (!empty($output['thumbnails']['default']))
			return $this->storeFrame($output['thumbnails']['default'], $video_id);
		
		return '/stream?image=/uploads/thumbnails/video.webp';
	}
}