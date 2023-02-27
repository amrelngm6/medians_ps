<?php

namespace Medians\Application\FaceBook;


use Medians\Application as apps;
use Medians\Infrastructure as Repo;
use Medians\Infrastructure\Users\UserRepository;




class FBApp 
{


	/**
	* @var Instance
	*/
	private $repo;


	function __construct($repo)
	{

		$this->repo = $repo;

		$this->config = new FBConfig($repo);

	}



	/**
	 * FB Pages list
	 * 
	*/
	public function fb_pages_list($request, $app)
	{

	    if (isset($app->auth))
	    {
	        $app->auth = $app->auth->with('fb_pages')->with('fb_user')->find($app->auth->id);
	    }

		$list = (new Repo\FaceBook\FBPageInfoRepository())->getByUserId($app->auth->id);

	    return  render('views/admin/fb/pages.html.twig', [
	        'title' => 'Facebook pages list',
	        'app' => $app,
	    ]);
	}


	/**
	 * FB Pages list
	 * 
	*/
	public function fb_page($request, $app)
	{

	    if (isset($app->auth))
	    {
	        $app->auth = $app->auth->with('fb_pages')->with('fb_user')->find($app->auth->id);
	    }

	    return  render('views/admin/fb/pages.html.twig', [
	        'title' => 'Facebook pages list',
	        'app' => $app,
	        'fb_page' => (new Repo\FaceBook\FBPageInfoRepository())->getByPageId($request->get('id')),
	    ]);
	}



	/**
	 * FB Login back actions 
	 * 
	*/
	public function fb_login_back($app)
	{

	    try {

	        $user = (object) $this->login_back($app);

	    } catch (\Exception $e) {
	        return $e->getMessage();
	    }
	    

	    try {
	        
	        $userData = UserRepository::store(['email'=>$user->email, 'name'=>$user->name, 'publish'=>1]);
	        $userData->access_token = $user->access_token_set;
	        $userData->save();

	        $FBUserInfo = $this->insertUserInfo($user, $userData->id);

	        $pages = $this->fb_page_list($user->access_token_set);

	        foreach ($pages as $key => $value) {
	            $this->insertPageInfo($value, $userData->id, $FBUserInfo->id);
	        }

	    } catch (Exception $e) {
	        return $e->getMessage();
	    }


	    try{
	    
	        (new apps\Auth\AuthService(new UserRepository))->setSession($userData);


	    } catch (Exception $e) {
	        return $e->getMessage();
	    }


	    return $this->loginBtn($app);
	}



	public function create_long_lived_access_token($short_lived_user_token)
	{
		$config = $this->config->fbConfigQuery();

		$short_token = $short_lived_user_token;

		$url="https://graph.facebook.com/v10.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$config->api_id."&client_secret=".$config->api_secret."&fb_exchange_token=".$short_token;

		$headers = array("Content-type: application/json");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

		$st=curl_exec($ch); 
		$result=json_decode($st,TRUE);

		$access_token=isset($result["access_token"]) ? $result["access_token"] : "";

		return $access_token;

	}

	/**
	 *  FB Pages list
	 */
	public function fb_page_list($access_token="")
	{

		try {

			$request = $this->config->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);	
			return  $request->getGraphList()->asArray();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			$error=true;

		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$error=true;
		}


		try {

			$request = $this->config->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);
			
			return $request->getGraphList()->asArray();
		}

		catch(Facebook\Exceptions\FacebookResponseException $e) {
			$response['error']='1';
			$response['message']= $e->getMessage();
			return $response; 
		}

		catch(Facebook\Exceptions\FacebookSDKException $e) {
			$response['error']='1';
			$response['message']= $e->getMessage();
			return $response; 
		}


	}


	/**
	 * Create FB page 
	 */
	public function insertPageInfo($page, $user_id=0, $facebook_table_id=null)
	{

		$page_id = $page['id'];
        $page_cover = isset($page['cover']['source']) ?  $page['cover']['source'] : '';
        $page_profile = isset($page['picture']['url']) ? $page['picture']['url'] : '';
        $page_name = isset($page['name']) ? $page['name'] : '';
        $page_access_token = isset($page['access_token']) ? $page['access_token'] : '';
        $page_email = isset($page['emails'][0]) ? $page['emails'][0] : '';
        $page_username =  isset($page['username']) ? $page['username'] : '';

        $data = array(
            'user_id' => $user_id,
            'facebook_rx_fb_user_info_id' => $facebook_table_id,
            'page_id' => $page_id,
            'page_cover' => $page_cover,
            'page_profile' => $page_profile,
            'page_name' => $page_name,
            'username' => $page_username,
            'page_access_token' => $page_access_token,
            'page_email' => $page_email,
            'add_date' => date('Y-m-d'),
            'deleted' => '0'
        );	

        $create = (new Repo\FaceBook\FBPageInfoRepository)->store($data);

        try {
        	
	        $this->enable_bot($data['page_id'], $data['page_access_token']);
	        error_log('Saved');
        } catch (Exception $e) {
        	
	        error_log('Error Saving');
	        return $e->getMessage();
        }

        return $create;
	}

	/**
	 * Create FB user info 
	 */
	public function insertUserInfo($user, $userId = 0)
	{

		$config = $this->config->fbConfigQuery();

        $data = array(
            'user_id' => $userId,
            'facebook_rx_config_id' => $config->api_id,
            'access_token' => $user->access_token,
            'name' => $user->name,
            'email' => isset($user->email) ? $user->email : $user->id,
            'fb_id' => $user->id,
            'add_date' => date('Y-m-d'),
            'deleted' => '0'
        );

        return (new Repo\FaceBook\FBUserInfoRepository)->store($data);

	}	



	public function ice_breaker($page_id)
	{

	    try {

	        $ice_breaker_array = [];
	        $ice_breaker_array["ice_breakers"][]=[
	            "call_to_actions" => [
	                (object) [
	                    'question' => 'Hola',
	                    'payload' => 'New Hola',
	                ],
	                (object) [
	                    'question' => 'Hola 2',
	                    'payload' => 'New Hola 2',
	                ]
	            ]
	        ];

	        return $this->add_ice_breakers($page_id,json_encode($ice_breaker_array),'fb');
	        
	    } catch (Exception $e) {
	        return $e->getMessage();
	    }    

	    return 'Updated';

	}







	/**
	 * Login Back FB Func
	 */
	public function login_back($app)
	{

        $helper =  $this->config->fbConfigHelper(); 

        $fb =  $this->config->fbConfig(); 

        try {
        	
	        $accessToken = $helper->getAccessToken($app->CONF['url'].'facebook_login_back');

	        $response = $fb->get('/me?fields=id,name,email', $accessToken);

	        $user = $response->getGraphUser()->asArray();

        } catch (Exception $e) {
        	return $e->getMessage();	
        }

        $access_token   = (string) $accessToken;
        $access_token = $this->create_long_lived_access_token($access_token);

        $user["access_token_set"] = $access_token;

        $user["access_token"] = $access_token;

        return $user;
	} 


	/**
	 * Return login url
	*/
	public function loginBtn($app)
	{

	    $helper =  $this->config->fbConfigHelper(); 

	    $permissions = ['email','pages_manage_posts','pages_manage_engagement','pages_manage_metadata','pages_read_engagement','pages_show_list','pages_messaging','public_profile','read_insights','publish_to_groups', 'instagram_basic','instagram_manage_comments','instagram_manage_insights','instagram_content_publish','instagram_manage_messages'];

	    return  $helper->getLoginUrl($app->CONF['url'].'facebook_login_back', $permissions);
	}



	/* Add get Started Button */
	public function add_get_started_button($post_access_token='')
	{
	
		$url = "https://graph.facebook.com/v4.0/me/messenger_profile?access_token={$post_access_token}";
		$get_started_data='{"get_started":{"payload":"GET_STARTED_PAYLOAD"}}';
	
		$ch = curl_init();
	 	$headers = array("Content-type: application/json");
	 
	 	curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	 
	 	curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$get_started_data); 
	 
	 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
	 	$st=curl_exec($ch);	 
	 	$result=json_decode($st,TRUE);
	 	if(isset($result["result"])) 
		{
			$result["result"]=$this->CI->lang->line(trim($result["result"]));
			$result['success']=1;
		}
		if(isset($result["error"])) 
		{
			$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : $this->CI->lang->line("Something went wrong, please try again.");
			$result['success']=0;
		}
		return $result;
	}


	public function set_welcome_message($page_id='',$welcome_message='')
	{
	    
		try {
		    	
		    $page = (new Repo\FaceBook\FBPageInfoRepository)->getByPageId($page_id);

			if($welcome_message=='') return false;

			$url = "https://graph.facebook.com/v4.0/me/messenger_profile?access_token={$page->page_access_token}";
			$get_started_data=array
			(
				'greeting'=>array(0=>array("locale"=>"default","text"=>$welcome_message))
			);
			// $get_started_data='{"greeting":[{"locale":"default","text":"'.$welcome_message.'"}]}';
			$get_started_data=json_encode($get_started_data);

			$ch = curl_init();
		 	$headers = array("Content-type: application/json");
		 
		 	curl_setopt($ch, CURLOPT_URL, $url);
		 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		 
		 	curl_setopt($ch,CURLOPT_POST,1);
		 	curl_setopt($ch,CURLOPT_POSTFIELDS,$get_started_data); 
		 
		 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
		 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 	$st=curl_exec($ch);	 
		 	$result=json_decode($st,TRUE);
		 	if(isset($result["result"])) 
			{
				$result["result"]= trim($result["result"]);
				$result['success']=1;
			}
			if(isset($result["error"])) 
			{
				$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : "Something went wrong, please try again.";
				$result['success']=0;
			}

	        return 'Updated';


	    } catch (Exception $e) {
	    	return $e->getMessage();	
	    }

		return $result;
	}




	// ================== webhook enable disable ==============//
	// Array([success] => 1)
	public function enable_bot($page_id='',$post_access_token='')
	{
		if($page_id=='' || $post_access_token=='') 
		{
			return array('success'=>0,'error'=>"Something went wrong, please try again."); 
			exit();
		}
		try 
		{
			$params=array();			
			$params['subscribed_fields']= array("messages","messaging_optins","messaging_postbacks","messaging_referrals","feed");			
			$response = $this->config->fbConfig()->post("{$page_id}/subscribed_apps",$params,$post_access_token);			
			$response = $response->getGraphObject()->asArray();
			$response['error']='';
			return $response;			
		} 
		catch (Exception $e) 
		{
			return array('success'=>0,'error'=>$e->getMessage());
		}
	}

	// Array([success] => 1)
	public function disable_bot($page_id='',$post_access_token='')
	{
		if($page_id=='' || $post_access_token=='') 
		{
			return array('success'=>0,'error'=>$this->CI->lang->line("Something went wrong, please try again.")); 
			exit();
		}
		try 
		{
			$response = $this->fb->delete("{$page_id}/subscribed_apps",array(),$post_access_token);
			$response = $response->getGraphObject()->asArray();
			$response['error']='';
			return $response;			
		} 
		catch (Exception $e) 
		{
			return array('success'=>0,'error'=>$e->getMessage());
		}
	}





	/* Add Ice Breaker Questions */
	public function add_ice_breakers($page_id,$icebreakers_content_json='',$social_media_type='fb')
	{
		
	    $page = (new Repo\FaceBook\FBPageInfoRepository)->getByPageId($page_id);

		if($social_media_type=='ig'){
			$url = "https://graph.facebook.com/v5.0/me/messenger_profile?platform=instagram&access_token={$page->page_access_token}";
			$icebreakers_content_array=json_decode($icebreakers_content_json,true);
			$icebreakers_content_array['platform']="instagram";
			$icebreakers_content_json=json_encode($icebreakers_content_array);
		}
		else
			$url = "https://graph.facebook.com/v5.0/me/messenger_profile?access_token={$page->page_access_token}";


		$ice_breakers_data=$icebreakers_content_json;
	
		$ch = curl_init();
	 	$headers = array("Content-type: application/json");
	 
	 	curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	 
	 	curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$ice_breakers_data); 
	 
	 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
	 	$st=curl_exec($ch);	 
 	 	$result=json_decode($st,TRUE);
 	 	if(isset($result["result"])) 
 		{
 			$result["result"]=$this->CI->lang->line(trim($result["result"]));
 			$result['success']=1;
 		}
 		if(isset($result["error"])) 
 		{
 			$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : $this->CI->lang->line("Something went wrong, please try again.");
 			$result['success']=0;
 		}
 		return $result;
	}



	public function fb_page_chat($page_id, $request, $app)
	{
		
		$page = (new Repo\FaceBook\FBPageInfoRepository())->getByPageId($page_id);

		$list = $this->get_all_conversation_page($page->page_access_token, $page->page_id,100,100);

		print_r($list);
	}



	/**
	 * Gett all page convesations
	 * 
	*/
	public function get_all_conversation_page($post_access_token,$page_id,$auto_sync_limit=0,$scan_limit='',$folder='',$platform='fb')
	{

		$message_info=array();
		$i=0;

		$real_limit=$scan_limit;
		if($scan_limit!='') //per page scan grabs 499 lead in real
		{
			$how_many_page=$scan_limit/500;
			$real_limit=$scan_limit-$how_many_page;
		}

		//	$url = "https://graph.facebook.com/{$page_id}/conversations?access_token={$post_access_token}&limit=200&fields=participants,message_count,unread_count,senders,is_subscribed,snippet,id";	

		$url = "https://graph.facebook.com/{$page_id}/conversations?access_token={$post_access_token}&limit=500&fields=participants,PSID,user_id,id,updated_time";
		$url .= $platform=='fb' ? ",message_count,unread_count,is_subscribed,snippet,link&folder={$folder}" : "&platform=instagram";

		do
		{
			$results = $this->run_curl_for_fb($url);
			$results=json_decode($results,true);

			if(isset($results['error'])){
				$message_info['error']=1;
				$message_info['error_msg']= isset($results['error']['message']) ? $results['error']['message'] : json_encode($results);
				return $message_info; 
			}


			if(isset($results['data']))
			{
				print_r($results);

				foreach($results['data'] as $thread_info)
				{
					foreach($thread_info['participants']['data'] as $participant_info){
						$user_id= $participant_info['id'];
						if($user_id!=$page_id){
							if($platform=="ig")
								$message_info[$i]['name']=$participant_info['username'];
							else $message_info[$i]['name']=$participant_info['name'];
							$message_info[$i]['id']=$participant_info['id'];
						}
					}
					$message_info[$i]['is_subscribed'] = isset($thread_info['is_subscribed'])?$thread_info['is_subscribed']:0;
					$message_info[$i]['thead_id'] = $thread_info['id'];
					$message_info[$i]['message_count'] = isset($thread_info['message_count']) ? $thread_info['message_count']:0;
					$message_info[$i]['unread_count'] = isset($thread_info['unread_count']) ? $thread_info['unread_count']:0;
					$message_info[$i]['snippet'] = isset($thread_info['snippet']) ? $thread_info['snippet']:"";
					$message_info[$i]['updated_time'] = isset($thread_info['updated_time']) ? $thread_info['updated_time']:"";
					$message_info[$i]['link'] = isset($thread_info['link']) ? $thread_info['link']:"";
					// $message_info[$i]['business_link'] = 'https://business.facebook.com/latest/inbox/all?asset_id='.$thread_info['link']:"";
// 1671122466499731&selected_item_id=100006408965512

					$i++;
				}
			}

			$url= isset($results['paging']['next']) ? $results['paging']['next']: "" ;
			if($scan_limit!='' && $real_limit<=$i) break;
			if($auto_sync_limit!=0) break;

		}
		while($url!='');
		return $message_info;
	}
	

	/**
	 * CURL request for FB
	 * 
	*/	
	public function run_curl_for_fb($url)
	{
		$headers = array("Content-type: application/json"); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		$results=curl_exec($ch); 	   
		return  $results;   
	}

}
