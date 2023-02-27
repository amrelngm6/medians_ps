<?php

namespace Medians\Domain\FaceBook;

use Shared\dbaser\CustomController;


class FBPageInfo extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'facebook_rx_fb_page_info';


	protected $fillable = [
		'user_id' ,
		'facebook_rx_fb_user_info_id' ,
		'page_id' ,
		'page_cover' ,
		'page_profile' ,
		'page_name' ,
		'username' ,
		'page_access_token' ,
		'page_email' ,
		'add_date' ,
		'deleted' ,
		'auto_sync_lead' ,
		'last_lead_sync' ,
		'next_scan_url' ,
		'current_lead_count' ,
		'current_subscribed_lead_count' ,
		'current_unsubscribed_lead_count' ,
		'msg_manager' ,
		'bot_enabled' ,
		'started_button_enabled' ,
		'welcome_message' ,
		'chat_human_email' ,
		'no_match_found_reply' ,
		'persistent_enabled' ,
		'enable_mark_seen' ,
		'enbale_type_on' ,
		'estimated_reach' ,
		'last_estimaed_at' ,
		'review_status' ,
		'review_status_last_checked' ,
		'reply_delay_time' ,
		'mail_service_id' ,
		'sms_api_id' ,
		'sms_reply_message' ,
		'ice_breaker_status' ,
		'ice_breaker_questions' ,
		'email_api_id' ,
		'email_reply_message' ,
		'email_reply_subject' ,
		'sequence_sms_api_id' ,
		'sequence_sms_campaign_id' ,
		'sequence_email_api_id' ,
		'sequence_email_campaign_id' ,
		'has_instagram' ,
		'instagram_business_account_id' ,
		'insta_username' ,
		'insta_followers_count' ,
		'insta_media_count' ,
		'insta_website' ,
		'insta_biography' ,
		'insta_current_subscribed_lead_count' ,
		'insta_current_unsubscribed_lead_count' ,
		'insta_current_lead_count' ,
		'ig_ice_breaker_status' ,
		'ig_ice_breaker_questions' ,
		'ig_no_match_found_reply' ,
		'ig_chat_human_email'
	];

	public $timestamps = false;


	function __construct()
	{
		
	}


}
