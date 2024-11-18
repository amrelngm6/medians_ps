<?php

namespace Medians\Forum\Infrastructure;

use Medians\Forum\Domain\Forum;
use Medians\Forum\Domain\ForumComment;
use Medians\Hooks\Domain\Hook;
use Medians\Content\Domain\Content;
use Medians\CustomFields\Domain\CustomField;


class ForumRepository 
{


	/**
	 * Load app for Sessions and helpful
	 * methods for authentication and
	 * settings for branch
	 */ 
	protected $app ;


	function __construct()
	{

	}


	public static function getModel()
	{
		return new Forum();
	}


	public function find($id)
	{
		return Forum::with('category','doctor','category','comments')->withSum('views','times')->find($id);
	}

	public function get($limit = 500, $lang = null)
	{
		
		return Forum::with('doctor','category','comments')->withSum('views','times')->with(['category'=>function($q){
			return $q->with('content');
		}])->limit($limit)->orderBy('id', 'DESC')->get();
	}

	

	public function getByCategory($id, $limit = 100)
	{
		return Forum::with('content','author','user')
		->whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})
		->where('status', 'on')
		->where('category_id', $id)
		->limit($limit)
		->orderBy('id', 'DESC')->get();
	}

	public function countByCategory($id)
	{
		return Forum::whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})
		->with('author')
		->where('status', 'on')
		->where('category_id', $id)
		->count();
	}

	public function paginateByCategory($id, $limit = 100, $offset = 0)
	{
		return Forum::with('content','user', 'author')
		->whereHas('content', function($q){
			return $q->where('content', '!=', '');
		})
		->where('status', 'on')
		->where('category_id', $id)
		->limit($limit)
		->offset($offset)
		->orderBy('id', 'DESC')
		->get();
	}

	public function paginate($limit = 10, $offset = 0)
	{
		$items = Forum::with('category','doctor','category','comments')->withSum('views','times')
		->where('status', 'on');

		$count = $items->count();
		
		$items->limit($limit)
		->offset($offset)
		->orderBy('id', 'DESC');

		return ['count'=> $count, 'items'=> $items->get()];
		
	}

	public function getFeatured($limit = 1)
	{
		return Forum::with('category','docto')
		->where('status', 'on')
		->orderBy('updated_at', 'DESC')->first();
	}

	public function filterSearchTitle($title)
	{
		$title = str_replace(
			[  'أ', 'ا',"ى",'ي',"ة",'ه']
			,  '%'
			, $title);
		return str_replace(' ', '%', trim($title));
	}
 
	
	public function similar($model, $limit = 3)
	{
		$title = str_replace([' ','-'], '%', $model->subject);

		return Forum::where('subject', 'LIKE', '%'.$title.'%')
		->where('id', '!=', $model->id)
		->where('status', 'on')
		->with('category','doctor','comments')->limit($limit)->inRandomOrder()->get();
	}


	/**
	 * Load items with filters
	 */
	public function getWithFilter($params)
	{

			$model = Forum::where('status', 'on');

			if (!empty($params['title']))
			{
				$model = $model->where('subject', 'LIKE', '%'.$params['title'].'%');
			}

			if (!empty($params['sort_by']))
			{
				switch ($params['sort_by']) {
					case 'best':
						$model = $model->withSum('views','times')->orderBy('views_sum_times','DESC');
						break;
						
					case 'old':
						$model = $model->orderBy('id','ASC');
						break;
						
					case 'new':
						$model = $model->orderBy('id','DESC');
						break;
				}
			} else {
				$model = $model->orderBy('id','DESC');
			}

			if (!empty($params['date']))
			{
				switch (strtolower($params['date'])) {
					case 'day':
					case 'week':
					case 'month':
					case 'year':
						$model = $model->whereBetween('created_at', [ date('Y-m-d', strtotime("-1 ".$params['date'])) , date('Y-m-d')]);
						break;
						
					default:
						$model = $model->orderBy('id','DESC');
						break;
				}
			}

			$totalCount = $model->count();

			$offset = (($params['limit'] ?? 1) * (!empty($params['page']) ? floatval( $params['page'] - 1)  : 0));
			return ['count' => $totalCount, 'items'=>$model->offset($offset)->limit(floatval($params['limit'] ?? 4))->get()];
	}
 
	


	/**
	* Save model to database
	*/
	public function store($data) 
	{

		$Model = new Forum();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Forum::create($dataArray);
    	// $Object->update($dataArray);

    	// Store languages content
    	// $this->storeContent($data['content'], $Object->id);

    	// Store Custom fields
    	// $this->storeCustomFields($data['field'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Forum::find($data['id']);
		
		$data['updated_at'] = date('Y-m-d H:i:s');
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// // Store languages content
    	// !empty($data['content']) ? $this->storeContent($data['content'], $data['id']) : '';

    	// Store Custom fields
    	!empty($data['field']) ? $this->storeCustomFields($data['field'], $data['id']) : '';

    	return $Object;

    }


	/**
	* Delete model to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			$delete = Forum::find($id)->delete();

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
	* Save Comment from Admin / Agent
	*/
	public function storeUserComment($data) 
	{

		$Model = new ForumComment();

		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		
		
		// Return the  object with the new data
    	$Object = ForumComment::create($dataArray);
    	// $Object = ForumComment::firstOrCreate($dataArray);

    	return $Object;
    }
    	
	

	/**
	* Save Comment from Admin / Agent
	*/
	public function updateCommentStatus($data) 
	{

		$Object = ForumComment::find($data['id']);

		// Return the  object with the new data
    	$update = $Object->update($data);
    	// $Object = ForumComment::firstOrCreate($dataArray);

    	return $Object;
    }
    	

	/**
	* Save related models to database
	*/
	public function storeContent($data, $id) 
	{
		$this->app = new \config\APP;

		Content::where('item_type', Forum::class)->where('item_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = $value;
				$fields['item_type'] = Forum::class;	
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
	* Save related models to database
	*/
	public function storeCustomFields($data, $id) 
	{
		CustomField::where('model_type', Forum::class)->where('model_id', $id)->delete();
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				$fields = [];
				$fields['model_type'] = Forum::class;	
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
	 * Filter short codes for Hooks
	 */
	public function filterShortCode ($model)
	{
		$postContent = $model->content->content;

		$hooks = $this->_plugins_shortcode_filter($postContent);
		
		if (!empty($hooks[2][0])) {
			
			foreach ($hooks[2] as $key => $value) 
			{
				$codeToReplace = $hooks[0][$key];
				$id = $hooks[2][$key];

				$hook = Hook::find($id);
				$unserialize = unserialize($hook->content);
				$hookContent = $unserialize['content'] ?? $hook->field['content'];

				$postContent = str_replace($codeToReplace, $hookContent, $postContent);
				
			}
		}

		$output = str_replace("h=&amp;", '', $postContent);
		preg_match_all('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $output, $matches);
		if (isset($matches[1]))
		{
			foreach ($matches[1] as $k => $match) {

				$video = str_replace('https://www.youtube.com/embed/' , '', $match); 
				$videoContent = $this->videoContent($video, $model);
				$output = str_replace($matches[0][$k] , $videoContent, $output); 
			}

			
		}
		

		$model->content->content = $output;
		return $model;
	}
	
 
	public static function _plugins_shortcode_filter($val) {
		
		/** 
		 * Plugin shortcode 
		 * Usage:  [--@plugin= Plugin Name --@id= Plugin ID --]
		 * 
		*/
		
		$val ? preg_match_all("|\[--@plugin=(.*)\--@id=(.*)\--](.*)</[^>]+>|U", $val, $matches, PREG_PATTERN_ORDER) : null;	
		
		return $matches ?? $val;
		
	}
	
	

	public function videoContent($video_id, $model)
	{
		$img = $this->videoFrame($video_id);
		return '
		<div class="video-center show-modal-iframe relative" data-youtube-link="'.$video_id.'">
			<div class="iframe-container">
				<iframe  class="w-full lazy-iframe" title="Bedaya Youtube Video" height="460" data-src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>
			</div>
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