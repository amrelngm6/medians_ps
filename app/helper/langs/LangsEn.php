<?php

namespace helper\langs;

/**
 * 
 */
class LangsEn
{
	
	function __construct()
	{
		// code...
	}

	public static function get()
	{

		$LANG_ARRAY = array(

			'lang' => 'en'
			,'DIR' => 'ltr'
			,'HOMEPAGE' => 'Home'
			,'HOMEPAGE_TITLE' => 'Homepage'
			,'MAINPAGE' => 'Main page'
			,'ACCOUNT_PAGE' => 'Account page'
			,'LOGIN' => 'Login'
			,'REGISTER' => 'Register'
			,'CUR_CUSTOMERS' => 'Registered Customers'
			,'NAME' => 'Name'
			,'first_name' => 'First name'
			,'last_name' => 'Last name'
			,'ENTER_MAIL' => 'Email'
			,'ENTER_PASS' => 'Password'
			,'PASSWORD' => 'Password'
			,'PASSWORD_ERROR' => 'Password is not right'
			,'OLD_PASSWORD' => 'Old Password'
			,'NEW_PASSWORD' => 'New Password'
			,'ENTER_PASS_AG' => 'Password confirmation'
			,'NEW_CUSTOMERS' => 'New customers'
			,'CREATE_ACCOUNT' => 'Create your account'
			,'ENTER_FULLNAME' => 'Full name'
			,'USERNAME' => 'Username'
			,'EMAIL' => 'Email'
			,'NO_SPACE' => 'Without spaces'
			,'ENTER_GENDER' => 'Choose your gender'
			,'MALE' => 'Male'
			,'FEMALE' => 'Female'
			,'REMEMBER' => 'Remember me'
			,'PROFILE_INFO' => 'Profile information'
			,'YR_CART' => 'Your Cart'
			,'WISHLIST' => 'Your Wishlist'
			,'YR_ORDERS' => 'Your Orders'
			,'POST' => 'Post'
			,'COMMENT_HERE' => 'Comment here'
			,'COMMENTS_POSTED' => 'Comments posted'
			,'WRITE_COMMENT' => 'Write your comment'
			,'MY_ACCOUNT' => 'My account'
			,'MY_ORDERS' => 'My Orders '
			,'CART' => 'Cart '
			,'CHECKOUT' => 'Checkout '
			,'MY_WISHLIST' => 'My Wishlist'
			,'SHOP_CART' => 'Shopping cart'
			,'NO_CART' => 'You have no items in your shopping cart'
			,'TOTAL' => 'Total'
			,'SUB_TOTAL' => 'Subtotal'
			,'PRODUCT' => 'Product'
			,'PRODUCTS' => 'Products'
			,'PLACE_ORDER' => 'Place Order'
			,'UR_ORDER' => 'Your Order'
			,'BILL_INFO' => 'Billing details'
			,'PROCEED_CHECKOUT' => 'Proceed to checkout'
			,'PAYMENT' => 'Payment'
			,'PRICE' => 'Price'
			,'OPTIONS' => 'Options'
			,'ADD_CART' => 'Add to cart'
			,'SAVE_LATER' => 'Save for later'
			,'ADD_REVIEW' => 'Add a Review'
			,'UR_RATING' => 'Your Rating'
			,'UR_REVIEW' => 'Your Review'
			,'LOADMORE' => 'Load more'
			,'MORE' => 'More'

			,'MUSIC' => 'Music'
			,'VIDEOS' => 'Videos'
			,'PHOTOS' => 'Photos'
			,'USERS' => 'Users'
			,'POSTS' => 'Posts'
			,'PLAYLISTS' => 'Playlists'
			,'ALBUMS' => 'Albums'
			,'SEARCH_FOR' => 'Search for'
			,'DISCOVER' => 'Discover'
			,'WHATS_NEW' => "What's new"
			,'STREAM' => 'Stream'
			,'EXTRA_PAGES' => 'Extra pages'
			,'PAGES' => 'Pages'
			,'ADD_TO_PLAYLIST' => 'Add to playlist'
			,'ADD_NEW_PLAYLIST' => 'Add new playlist'
			,'CREATE_PLAYLIST' => 'Create Playlist'
			,'DONE' => 'Done'
			,'CONFIRMATION' => 'Confirmation'
			,'CANCEL' => 'Cancel'
			,'SAVE' => 'Save'
			,'DEL' => 'Delete'
			,'YES' => 'Yes'
			,'NO' => 'No'
			,'NO_HERE' => 'Non'
			,'YET' => 'Yet'
			,'MESSAGES_LIST' => 'Messages list'
			,'SEND' => 'Send'
			,'UPDATE' => 'Update'
			,'UPDATED' => 'Updated successfully'
			,'EDIT' => 'Edit'
			,'EDIT_MEDIA' => 'Edit media'
			,'PR_VISITS' => 'Profile visits'
			,'FOLLOWERS' => 'Followers'
			,'FOLLOWING' => 'Following'
			,'FOLLOW' => 'Follow'
			,'UNFOLLOW' => 'Unfollow'
			,'ABOUT_ME' => 'About me'
			,'INFO' => 'Info'
			,'CONNECTION' => 'connection'
			,'SAY_SOMETHING' => 'Say something'
			,'BUY_NOW' => 'Buy now'
			,'BUY' => 'Buy'
			,'LIKE' => 'Like'
			,'THANKS_FOR_LIKE' => 'Thanks for Like'
			,'DISLIKED' => 'Removed from favourites'
			,'LIKEED' => 'Already liked'
			,'PAYMENT_METHODS' => 'Payment Methods'
			,'DEPOSITE_METHODS' => 'Choose payment method to deposite'
			,'DOWNLOAD' => 'Download'
			,'DOWNLOADS' => 'Downloads/Purchases'
			,'PROGRESS' => 'Progress'
			,'ITEMS' => 'Items'
			,'ITEM' => 'Item'
			,'TITLE' => 'Title'
			,'DESC' => 'Description'
			,'LENGTH' => 'Length'
			,'PLAY' => 'Play'
			,'PLAYS' => 'Views'
			,'VIEWS' => 'Views'
			,'U_MY_LIKE' => 'May also like'
			,'MORE_FROM' => 'More from'
			,'PICTURE' => 'Picture'
			,'CREATE_ALBUM' => 'Create new album'
			,'ADD_ALBUM' => 'Add new album'
			,'ALBUM_COVER' => 'Album cover'
			,'ALBUM_TITLE' => 'Album title'
			,'GRAB_LNK' => 'Grab by link'
			,'GRAB_NAME' => 'Search by name'
			,'GRAB_VIDEO' => 'Grab single Video'
			,'VI_PROFILE' => 'View profile'
			,'GRAB_CH' => 'Grab channel'
			,'GRAB_PLAYLIST' => 'Grab playlist'
			,'GRAB_VIDEO_MSG' => 'Grab single Video from YouTube'
			,'GRAB_CH_MSG' => 'Grab channel Videos from YouTube'
			,'GRAB_SINGLE_MSG' => 'Grab single track OR User tracks OR Playlist tracks from SoundCloud'
			,'SEARCH_SINGLE_MSG' => 'Search for tracks to grab from SoundCloud'
			,'GRAB_ID_NAME' => 'Grab by ID / Username'
			,'GET_CH_USER' => 'Get by Channel Username'
			,'GET_CH_ID' => 'Get by Channel ID'
			,'CH_ID' => 'Channel Username / ID'
			,'GRAB_PLAYLIST_MSG' => 'Grab playlist from YouTube'
			,'FULL_URL' => 'Enter full URL'
			,'CATEGORY' => 'Category'
			,'SHARE_SM' => 'Share on social media'
			,'BLOG' => 'Blog'
			,'CHOOSE_CAT' => 'Please choose category'
			,'PUBLIC_MEDIA' => 'This is public media ?'
			,'MEDIA_NUMBERS' => 'Media numbers'
			,'MEDIA_COUNT' => 'Media count'
			,'SET_PUBLIC_MEDIA' => 'Set as public Media'
			,'PLAYLIST_ID' => 'Playlist ID'
			,'VIDEO_ID' => 'Video ID'
			,'TRACK_TITLE' => 'Enter track title'
			,'LIKES' => 'Likes'
			,'COMMENTS' => 'Comments'
			,'SEARCH' => 'Search'
			,'TAGS' => 'Tags'
			,'MEDIA_COVER' => 'Media Cover'
			,'MAIN_FILE' => 'Main File'
			,'DEMO_FILE' => 'Demo File'
			,'SELL_MEDIA' => 'Sell Media'
			,'UP_MEDIA' => 'Upload Media'
			,'ASSIGN_ALBUM' => 'Assign to album'
			,'CHOOSE_ALBUM' => 'Choose one of your albums'
			,'NO_ALBUMS' => 'No albums for this media'
			,'ASSIGN_STATION' => 'Assign to station'
			,'CHOOSE_STATION' => 'Choose one of your stations'
			,'NO_STATION' => 'No station for this media'
			,'DOWNLOADABLE' => 'Downloadable'
			,'WITHDRAWAL' => 'Withdrawal'
			,'MK_WITHDRAWAL' => 'Make a withdrawal'
			,'SUBSCRIPTION' => 'Subscription'
			,'OLD_SUBSCRIPTION' => 'Old Subscriptions'
			,'MK_DEPOSITE' => 'Make a deposit'
			,'CUR_CREDIT' => 'Current credit'
			,'ENOUGH_CREDIT' => 'You should have enough credit to process'
			,'PY_METHODS' => 'Choose payment method to receive your money'
			,'AMOUNT' => 'Amount'
			,'ACC' => 'Account'
			,'METHOD' => 'Method'
			,'STATUS' => 'Status'
			,'DATE' => 'Date'
			,'OLD_WITHDRWAL' => 'Old withdrawals'
			,'ID' => 'ID'
			,'CATS_PAGE' => 'Categories page'
			,'CATS_LIST' => 'Categories list'
			,'ITEMS_LIST' => 'Items list'
			,'ABT_AUTHOR' => 'About Author'
			,'ARTIST' => 'Artist'
			,'MED' => 'Media'
			,'MED_ITEM' => 'Media item'
			,'MED_ITEMS' => 'Media items'
			,'SIGNUP_MSG' => 'Sign up to meet your friends'
			,'SIGNIN_MSG' => 'Sign in to meet your friends'
			,'SIGNUP' => 'Sign up'
			,'CUR_MEMBER' => 'Already have account ?'
			,'NEW_MEMBER' => 'Not a member ?'
			,'USE_SM' => 'Use your social media account'
			,'SIGNUP_WITH' => 'Sign in with'
			,'PERS_INFO' => 'Personal information'
			,'SM_PROFILES' => 'Social profiles'
			,'ABOUT_U' => 'About you'
			,'CHA_PIC' => 'Profile picture'
			,'FB_PROF' => 'Facebook profile'
			,'GO_PROF' => 'Google+ profile'
			,'TW_PROF' => 'Twitter profile'
			,'YT_PROF' => 'YouTube profile'
			,'IN_PROF' => 'Instagram profile'
			,'CONNECTED' => 'Connected'
			,'SELL_MU' => 'Sell Music'
			,'SELL_VI' => 'Sell Video'
			,'SELL_PH' => 'Sell Photo'
			,'FREE_MU' => 'Free beats'
			,'FREE_VI' => 'Upload free Video'
			,'FREE_PH' => 'Upload free Photo'
			,'BASED_FOL_PEOPLE' => ' based on people you follow'
			,'DISABLED_MEDIA' => ' This item has beed disabled by admin'
			,'NO_MORE' => ' No items here'
			,'CHAT' => 'Chat'
			,'CH_PLAYLIST' => 'Select one of your playlists'
			,'ADD_TO_PLAYLIST' => 'Add to playlist'
			,'ADD_PLAYLIST_MSG' => 'You have not any playlists yet. Create new one'
			,'FAIL_PAY' => 'Payment failed'
			,'NO_CREDIT' => 'You have no enough credit to pay for this items.'
			,'THNKS_PURCHASE' => 'Thanks for your purchase'
			,'CANCL_PAY' => 'Your transaction has been canceled'
			,'SUCC_PURCHASE' => 'You have successfully confirmed the booking, and the transaction is successfully proceed.'
			,'NO_ITEM_DOWNLOAD' => 'You have no items to download.'
			,'LOG_FIRST' => 'Please login First'
			,'LOG_AS_USER_FIRST' => 'Please login First as <a href="/login">Member</a>'
			,'LOG_AS_PROVIDER_FIRST' => 'Please login First as Branch'
			,'NO_LIKES' => "No Likes here yet"
			,'NO_COMMENTS' => "No comments here"
			,'DIS_COMMENTS' => "Comments disabled by administrator"
			,'NO_PLAYLIST' => "User have no playlist"
			,'AT_CART' => "You have this item at your cart"
			,'BOUGHT_BEFORE' => "You have bought this item before"
			,'404' => "We are sorry we can not find that page"
			,'404_TITLE' => "You're Lost in the 404 World!"
			,'404_SUBTITLE' => "the page you are looking for doesn't exist"
			,'404_PARAGRAPH' => "You may have miss typed the address of the page has been moved"
			,'U_HAVE' => "You have "
			,'MSGS' => "All messages"
			,'NOTIFICATIONS' => "Notifications"
			,'ALL_NOTIFICATIONS' => "All Notifications"
			,'PROFILE' => "Profile"
			,'UPLOAD' => "Upload"
			,'GRAB_YT' => 'Grab from YouTube'
			,'GRAB_SC' => 'Grab from SoundCloud'
			,'SETTINGS' => 'Settings'
			,'LOGOUT' => 'Logout'
			,'JOIN' => 'Join'
			,'RENEW' => 'Renew'
			,'SUBSCRIBE' => 'Subscribe'
			,'UPGRADE_PRODUCER' => 'Upgrade to producer'
			,'PLAN' => 'Plan'
			,'JOIN_PLAN' => 'Choose your plan'
			,'TIME' => 'Time'
			,'EX_DATE' => 'Expiration date'
			,'SUBSCRIPTION_MSG' => 'Make sure you have enough credit to subscribe to any plan'
			,'FORGOT_PASS' => 'Forgot your password'
			,'ENTER_COUNTRY' => 'Your country'
			,'ENTER_CITY' => 'Your city'
			,'CITY' => 'City'
			,'UPGRADE_MSG' => 'Enjoy with your new plan features.'
			,'SPONSOR_MSG' => 'More listeners more sales.'
			,'BEATS' => 'Beats'
			,'TOP_BEATS' => 'Top Beats'

			,'COMPANY' => 'Company'
			,'USERPOSITION' => 'User position'
			,'FAMILY' => 'Family'
			,'AWARDS' => 'Awards'
			,'WEBSITE' => 'Website'
			,'BUSINESS_EMAIL' => 'Business email'

			,'PRIVATE_ACOUNT_DETAILS' => 'Private account details'
			,'PUBLIC_PROFILE_DETAILS' => 'Public profile details'

			,'ORDER_BY' => 'Order by'
			,'USER_TYPE' => 'User type'
			,'PRODUCER' => 'Producer'
			,'MOODS' => 'Moods'
			,'MOOD' => 'Mood'
			,'STATION' => 'Station'
			,'STATIONS' => 'Stations'
			,'MY_STATIONS' => 'My Stations'
			,'CREATE_STATION' => 'Create new station'
			,'ADD_STATION' => 'Add new station'
			,'STATION_COVER' => 'Station cover'
			,'STATION_TITLE' => 'Station title'
			,'BROWSE' => 'Browse'
			,'BROWSE_FILTER' => 'Browse filters'
			,'SELECT' => '-- Select --'
			,'SELECT_CATS' => 'Category'
			,'SELECT_MOODS' => 'Mood'
			,'MOST_POP' => 'Most Popular'
			,'MOST_PLY' => 'Most Plays'
			,'MOST_SELL' => 'Top sellers'
			,'ADD_WITHIN' => 'Added within'
			,'BPM' => 'BPM'
			,'TODAY' => 'Today'
			,'THIS_WEEK' => 'This week'
			,'THIS_MONTH' => 'This month'
			,'THIS_YEAR' => 'This year'
			,'ALL_TIME' => 'All time'
			,'BPM_DESC' => 'Beats per minute'
			,'MY_BEATS' => 'My beats'
			,'SELL_BEATS' => 'Sell beats'
			,'LEASES' => 'Leases'
			,'STATS' => 'Stats'
			,'DISCOUNT_CODE' => 'Discount code'
			,'DISCOUNT' => 'Discount'
			,'DISCOUNTS' => 'Discounts'
			,'NEW_DISCOUNT' => 'New Discount'
			,'PERCENTAGE' => 'Percentage'
			,'CODE' => 'Code'
			,'SINGLE_UPLOAD' => 'Single upload'
			,'MULTI_UPLOAD' => 'Multi upload'
			,'RELEASE_DATE' => 'Release date'
			,'MP3_FILE' => 'MP3 File'
			,'MP3_PRICE' => 'MP3 Price'
			,'WAV_FILE' => 'WAV File'
			,'WAV_PRICE' => 'WAV Price'
			,'TRACKOUT_FILE' => 'Trackout File'
			,'TRACKOUT_PRICE' => 'Trackout Price'
			,'EXCLUSIVE_FILE' => 'Exclusive File'
			,'EXCLUSIVE_PRICE' => 'Exclusive Price'
			,'SPONSOR' => 'Sponsor'
			,'COVER' => 'Cover'
			,'UPLOADED_BEATS' => 'Uploaded beats'
			,'LICENSE' => 'License'
			,'FREE_DOWNLOAD' => 'Free download'
			,'RELEASE_TIME' => 'Release time'
			,'TIMEZONE' => 'Timezone'
			,'YOUTUBE_URL' => 'YouTube ID / Link'
			,'YOUTUBE_URL_DESC' => 'YouTube ID or full link of this beat'
			,'BEATTAGS' => 'Beat Tags'
			,'BEATTAG_FILE' => 'Beat Tag file'
			,'BEATTAGS_METHODS' => 'Choose your beat tag method'
			,'DEL_BEATTAG' => 'Delete current beat tag'

			,'ADMIN_LOGIN' => 'Administration panel login'
			,'LOGIN_FAIL' => 'Credentials not valid, Please try again.'
			,'LOGIN_ACVTIVATED' => 'Your account is activated. Please login '
			,'LOGIN_DISACVTIVATE' => 'Your account is not activated yet'
			,'VALID_INPUT' => 'Please enter valid data.'
			,'LOGGEDIN' => 'Thanks for login'
			,'SETTING_PAGE' => 'Setting page'
			,'SETTING_DETAILS' => 'Setting details'
			,'ADMINISTRATORS' => 'Administrators'
			,'SITENAME' => 'Site name'
			,'DENY_ACCESS' => 'Access denied.'
			,'SAVED' => 'Done.'
			,'FAILED' => 'Failed.'
			,'Dashboard' => 'Dashboard'
			,'SETTING' => 'Setting'
			,'SETTINGS' => 'Settings'
			,'ADD_NEW' => 'Add new'
			,'FULLNAME_EMPTY' => 'Name field is required'
			,'EMAIL_FOUND' => 'Email address already found'
			,'EMAIL_NOT_FOUND' => 'This Email address not found'
			,'EMAIL_NOT_VALID' => 'This Email address not valid'
			,'EMAIL_EMPTY' => 'Email field is required'
			,'NAME_FOUND' => 'Name field already found'
			,'NAME_EMPTY' => 'Name field is required'
			,'PASSWORD_SHORT' => 'Password is too short, Min characters '
			,'PASSWORD_EMPTY' => 'Password missed, Min characters '
			,'TITLE_EMPTY' => 'Title field is required '
			,'URL_EMPTY' => 'URL field is required '
			,'PUBLISH' => 'Publish'
			,'ACTION' => 'Action'
			,'TEACHERS' => 'Teachers'
			,'TEACHER' => 'Teacher'
			,'BIRTHDAY' => 'Birthday'
			,'BIRTHDAY_DATE' => 'Date of birth'
			,'ADRS' => 'Address'
			,'PHONE' => 'Phone'
			,'ROLE' => 'Role'
			,'CLASSES' => 'Classes'
			,'NUMBER' => 'Number'
			,'GENDER' => 'Gender'
			,'PROVIDER' => 'Branch'
			,'PROVIDERS' => 'Branches'
			,'OUR_PROVIDERS' => 'Our Branches'
			,'START_DATE' => 'Start date'
			,'MOBILE' => 'Mobile'
			,'PLUGINS' => 'Plugins'
			,'CHECK' => 'Check'
			,'HOOKS' => 'Hooks'
			,'SUBMIT' => 'Submit'
			,'CHOOSE' => 'Choose'
			,'POSITION' => 'Position'
			,'NEWS' => 'News'
			,'VIEW' => 'View'
			,'WORKING' => 'Working'
			,'WORKING_HOURS' => 'Working hours'
			,'WORKING_DAYS' => 'Working days'
			,'CATS' => 'Categories'
			,'PREFIX' => 'Prefix'
			,'STATE' => 'State'
			,'APT' => 'Apt'
			,'NEXT' => 'Next'
			,'PREV' => 'Prev'
			,'NEXTPAGE' => 'Next page'
			,'PREVPAGE' => 'Prev page'
			,'GOLDEN' => 'Golden !'
			,'JOINUS' => 'Join us'
			,'LOGIN_MSG' => 'Welcome, Use your information to login or create new account.'
			,'FORMS_MSGS' => 'Forms messages'
			,'THNKS_MSG' => 'Thanks for your message we will get in contact with you.'
			,'MSG' => 'Message'
			,'MSGS' => 'Messages'
			,'OUR' => 'OUR'
			,'RQST_FOR' => 'Request for'
			,'READMORE' => 'Read more'
			,'LATEST_POSTS' => 'Latest posts'
			,'REL_POSTS' => 'Related posts'
			,'REL_ITEMS' => 'Related items'
			,'RELATED_ARTICLES' => 'Related articles'

			,'BRANCH' => 'Branch'
			,'BRANCHES' => 'Branches'
			,'BRANCHES_LIST' => 'Branches LIST'
			,'BRANCHES_AND_LOCATIONS' => 'Branches & Locations'
			,'BRANCH' => 'Branch'
			,'COMMENTS_ALLOW' => 'Allow Comments'
			,'COMMENTS_COUNT' => 'Comments count'
			,'TEMPLATE' => 'Template'
			,'LAYOUT' => 'Layout'
			,'LANGS' => 'Languages'
			,'CON_TRANS' => 'Content translation'
			,'TAG_TITLE' => 'Tag title'
			,'TAG_DESC' => 'Tag describtion'
			,'TAG_KEYWORDS' => 'Tag keywords'
			,'CONTENT' => 'Content'
			,'SHORT' => 'Short brief'
			,'SPECIALS' => 'Specials'
			,'GO_BACK' => 'Go Back'
			,'ERR_INPUT_TITLE' => 'Please add title first.'
			,'ERR_INPUT_PAGES' => 'Please select page first.'
			,'ERR_INPUT_LANGS' => 'Please select language first.'
			
			,'SIGNUP_DONE_MSG' => 'You can login after reviewing your profile.'
			,'ABOUT' => 'About'
			,'CONTACT' => 'Contact'
			,'AR' => 'Arabic'
			,'EN' => 'English'
			,'CHANGE_LANG' => 'Change Language'
				
			,'AGENT' => 'Company'
			,'AGENTS' => 'Companies'
			,'FOODMENU' => 'Food menu'
			,'CUSTOMERS' => 'Customers'
			,'CUSTOMER' => 'Customer'
			,'NOTES' => 'Notes'
			,'STOCK' => 'Stock'
			,'START_STOCK' => 'Start Stock'
			,'EMPLOYEE' => 'Employee'
			,'AV_QTY' => 'Avaialbe quantity'
			,'QTY' => 'Quantity'
			,'START_QTY' => 'Start quantity'
			,'LEVEL' => 'Level'
			,'TYPE' => 'Type'
			,'PENDING' => 'Pending'
			,'INVOICE' => 'Invoice'
			,'TERMS_CONDS' => 'Terms & Conditions'
			,'CUSTOMER_INFO' => 'Customer info'
			,'ORDERS' => 'Orders'
			,'ORDER' => 'Order'
			,'COST' => 'Cost'
			,'OFFICE' => 'Office number'
			,'MOBILE_API' => 'API management'
			,'STOCK_OUT_ALL' => 'Out of stock with this quantity'
			,'STOCK_OUT' => 'Out of stock with this quantity'
			,'VOUCHERS' => 'Vouchers'
			,'BRANCH_EMPTY' => 'Branch field is required'
			,'AGENT_EMPTY' => 'Company field is required'
			,'DESK_EMPTY' => 'Desk location field is required'
			,'PASSWORD_MATCHING_ERROR' => 'Password not matched'
			,'WRONG_INFO' => 'Invalid information'
			,'ERR' => 'Error'
			,'ERR_EXT' => 'Error file extension not allowed'
			,'CARDNUM_ERR' => 'Card number is invalid'
			,'CARDNUM_EMPTY' => 'Card number is empty'
			,'CCV_ERROR' => 'CCV code is invalid'
			,'YEAR_ERROR' => 'Year value is invalid'
			,'MONTH_ERROR' => 'Month value is invalid'
			,'NO_CARD' => 'You must add your Credit Card.'
			,'DEF_LANG' => 'Default language'
			,'WEB_CONTENT' => 'CMS'

			,'ROLES' => 'Roles'
			,'CHECKED_TIME' => 'Checked time'
			,'OOPS' => 'Oops, Something is wrong...'
			,'FILTER' => 'Filter'
			,'DAY' => 'Day'
			,'MONTH' => 'Month'
			,'ORDERS_HIST' => 'Orders history'
			,'ROLES' => 'Roles management'
			,'ALL' => 'All'
			,'SELECT_ALL' => 'Select All'		
			,'ERR_FILES' => 'Error: Some files are unreadable '		
			,'DETAILS' => 'Details'
			,'DEF_VAL' => 'Default value'
			,'SPECS' => 'Specifications'
			,'TYPES' => 'Types'
			,'PARENT' => 'Parent'
			,'AUTHOR' => 'Author'
			,'AUTHORS' => 'Authors'
			,'SOURCE' => 'Source'
			,'DESTINATION' => 'Destination'
			,'SEO_DESC' => 'SEO Desc'
			,'SEO_TITLE' => 'SEO Title'
			,'EXT' => 'Extension'
			,'EXTS' => 'Extensions'
			,'TRACKS' => 'Tracks'
			,'ARTICLES' => 'Articles'
			,'URL_PATH' => 'Access url'
			,'LOGO' => 'Logo'
			,'GENRES' => 'Media categories'
			,'CUSTOM_FIELDS' => 'Custom fields'
			,'REGISTRATION_STEP2' => 'Complete Registration'
			,'REGISTRATION' => 'Registration'
			,'AGREE_TERMS' => 'I accept the Terms and Conditions of the website'
			,'MENU' => 'Menu'
			,'CUSTOMER_MENU' => 'Customer Menu'
			,'PROFILE_SETTING' => 'Profile setting'
			,'FIELD_TYPE' => 'Field type'
			,'ARTISTS' => 'Artists'
			,'COL_MENU' => 'Collapse Menu'
			,'TURN_ON_NOTES' => 'Turn on notifications'
			,'TURN_OFF_NOTES' => 'Turn off notifications'
			,'MALTIMEDIA' => 'Multimedia'
			,'BLOG_POST' => 'Blog Post'
			,'UPLOAD_PHOTO' => 'Upload photo'
			,'BROWSE_COM' => 'Browse your computer'
			,'CHOOSE_MY_PHOTOS' => 'Choose from My Photos'
			,'CHOOSE_PHOTOS_DESC' => 'Choose from your uploaded photos'
			,'USERMEDIA' => 'User media'
			,'USERMEDIA_EXT' => 'User media allowed extensions'
			,'NO_DATA' => 'No more data'
			,'TAGGED_PPL' => 'Tagged people'
			,'NAME_NOT_ALLOWED' => 'This username is not allowed'
			,'REQUEST_SENT' => 'Request sent'
			,'FRIENDS_REQUEST' => 'Friends request'
			,'VIEW_ALL' => 'View all'
			,'MARK_READ_ALL' => 'Mark all as read'
			,'SOCIAL' => 'Social network'
			,'CLOSE' => 'Close'
			,'FRIENDS' => 'Friends'
			,'FRIENDS_LIST' => 'Friends list'
			,'BLOCK' => 'Block'
			,'SUBMIT_ENTER' => 'Press enter to post'
			,'DELETED_POST' => 'Post has been deleted.'
			,'CREATE_PAGE' => 'Create an Page'
			,'PAGE_TITLE' => 'Title of the page'
			,'COMPLETE_ACC' => 'Complete account'
			,'COM_DELETED' => 'Comment deleted'
			,'ADD_UR_COMMENT' => 'Add your comment...'
			,'REPLY' => 'Reply'
			,'COMMENTED_UR' => ' commented on your '
			,'LIKED_UR' => ' liked your '
			,'MENTIONED_UR' => ' mentioned you at '
			,'TAGGED_UR' => ' tagged you at '
			,'SHARED_UR' => ' shared your '
			,'WANT_JOIN_UR' => ' want to join your '
			,'REPORT' => 'Report'
			,'ADD_PHOTO' => 'ADD PHOTO'
			,'ADD_PHOTOS' => 'ADD PHOTOS'
			,'ADD_VIDEO' => 'ADD VIDEO'
			,'ADD_VIDEOS' => 'ADD VIDEOS'
			,'CHAT_NOW' => 'Chat now'
			,'CONFIRM' => 'Confirm'
			,'ADD' => 'Add'
			,'POST_STATU' => 'Post Status'
			,'CREATE_EVENTS' => 'Create event'
			,'CREATE_PAGES' => 'Create page'
			,'CREATE_ITEMS' => 'Create items'

			,'EDIT_PAGE' => 'Edit page'
			,'TOTAL_LIKES' => 'Total likes'
			,'MYSOCIAL_PAGES' => 'My social pages'
			,'MYSOCIAL_PAGES_LIST' => 'My social pages list'
			,'REC' => 'rec'
			,'HOTEL' => 'hotel'
			,'ROLL' => 'roll'
			
			,'MAP_VIEW_NOTE' => 'Find by location'
			,'LIST_VIEW' => 'List view'
			,'GRID_VIEW' => 'Grid view'
			,'MAP_VIEW' => 'Map view'
			,'SORTBY_CITY' => 'Sort by city'
			,'SORTBY_SPECIAL' => 'Sort by special'
			,'GOOGLE_ANALYTICS' => 'Google Analytics'
			,'ECOMMERCE' => 'Ecommerce'
			,'TYPE_INSERT' => 'Insert type'
			,'SHOP' => 'Shop'
			,'SHOP_NOW' => 'Shop now'
			,'SHIPPING_INFO' => 'Shipping details'
			,'SHIPPING' => 'Shipping'
			,'SHIPPING_FEES' => 'Shipping Fees'
			,'SHIPPING_COST_TYPE' => 'Shipping cost type'
			,'CURRENCY_TAG' => 'Default Currency symbol'
			,'OPTIONS_TYPE' => 'Options type'
			,'OPTION_TYPE' => 'Option type'

			,'COUPONS' => 'Coupons'
			,'COUPON' => 'Coupon'
			,'COUPON_DUPLICATED' => 'This code already found'
			,'MIN_ORDER_COST' => 'Order minimum cost'
			,'ERR_MIN_ORDER' => 'Error! Order minimum cost is '
			,'ERR_EXPIRED' => 'Error! not avaialbe anymore '
			,'VALUE' => 'Value'
			,'CUSTOMER_USAGE_LIMIT' => 'Usage limit (Per User)'
			,'USAGE_LIMIT' => 'Usage limit (Orders max number)'
			,'COMMISSION' => 'Commission'
			,'END_DATE' => 'End date'
			,'START_DATE' => 'Start date'
			,'ITEMS_PER_CAT' => 'Items per category page'

			,'UNIT_WHOLESALE_PRICE' => 'Unit Wholesale Price'
			,'CUR_STOCK' => 'Current stock'
			,'SENDER_EMAIL' => 'Default send email'
			,'FORGOT_PASS_MSG' => 'Enter your email and follow the steps at the sent message'
			,'RESET_PASS' => 'Reset your password'
			,'RESET_PASS_MSG' => 'Enter your password and confirm it. Please make sure you have choosed strong and rememberable one.'
			,'RESET_PASS_SENT' => 'Check your email to recover your password'
			,'RESET_PASS_SUCCESS' => 'Your password has been reset successfully.'
			,'SEARCH_MSG' => 'what are<br>you looking for ?'
			,'SHOWING' => 'Showing '
			,'WELCOME_PROFILE' => 'You can manage your profile through this page and check the menu links'
			,'GROUP' => 'Group '
			,'GROUPS' => 'Groups '
			,'SORT' => 'Sort '
			,'WELCOME' => 'Welcome '
			,'BUSS_INFO' => 'Business info'


			,'DIRECTION' => 'Direction'
			,'DIRECTIONS' => 'Directions'
			,'BOOK' => 'Book'
			,'BOOKING' => 'Booking'
			,'BOOK_NOW' => 'Book Now'
			,'BOOKING_ID' => 'Booking ID '
			,'BOOKING_INFO' => 'Booking information'
			,'BOOKING_THANKS' => 'Thanks for booking offer from '
			,'BOOKING_DATE' => 'Booking date'
			,'CHANGE_PICTURE' => 'Change picture'
			,'LOCATION' => 'Location'
			,'LOCATIONS' => 'Locations'
			,'SHARE' => 'Share'
			,'LOOK_FOR' => 'Look for'
			,'LOOKING_FOR' => 'Looking for'
			,'PROVIDER_ACCOUNT' => 'branch account'
			,'FIELD_REQUIRED' => 'Fields is required'
			,'REVIEWS' => 'Reviews'
			,'REVIEWS_LIST' => 'Reviews list'
			,'ENABLED' => 'Enabled'
			,'DISABLED' => 'Disabled'
			,'SIGNUP_STATUS' => 'Auto activate after signup'
			,'REVIEWS_STATUS' => 'Reviews for customers'
			,'TIP' => 'Tip'
			,'TIPS' => 'Tips'
			,'NOTE' => 'Note'
			,'LAYOUT' => 'Layout'
			,'GMAP_API' => 'Google Map API'
			,'BRANCHES_NOTES_INSERT' => 'Zoom-in the Map and click on location to confirm to add the branch'
			,'BRANCHES_NOTES_DELETE' => 'Right click on the current location to delete.'
			,'VIEW_ON_MAP' => 'View on Map'
			,'VIEW_ON_MAP' => 'View on Map'
			,'LOGIN_DISABLED' => 'Customers login is disabled this time.'
			,'PROVIDERS_LOGIN_DISABLED' => 'Branches login is disabled this time.'


			,'ADD_TO_WISHLIST' => 'Add to wishlist'
			,'QUICK_VIEW' => 'Quick view'
			,'APPLY_COUPON' => 'Apply Coupon'
			,'COUPON_FORM_TITLE' => 'Enter your coupon code if you have one'
			,'NEW' => 'New'

			,'WRITTEN_BY' => 'Written by'
			,'SPECIALIZATIONS' => 'Services'
			,'SPECIALIZATION' => 'Service'
			,'SPECIALITY' => 'Speciality'
			,'CLONE' => 'Clone'
			,'SUCCESS_STORIES' => 'Success Stories'
			,'WATCH_VIDEO' => 'Watch video'
			,'MEDIA' => 'Media'
			,'MEDIA_PRESS' => 'Media & Press'
			,'DOCTORS' => 'Doctors'
			,'DOCTOR' => 'Doctor'
			,'INTRO' => 'Intro'
			,'HEADING' => 'Heading'
			,'FULL_BIO' => 'Full biography'
			,'COUNT' => 'Count'
			,'ALL_CASES' => 'All cases'
			,'BACK' => 'Back'
			,'APPOINTMENTS' => 'Appointments'
			,'ONLINE_CONSULTATION' => 'Online consultation'
			,'ONLINE_CONSULTING' => 'Online Consulting'
			,'TEST_RESULT' => 'Test result'
			,'TEST_RESULTS' => 'Test results'
			,'MEDICAL_DOCS' => 'Medical docs'
			,'BOOKING_DATE' => 'Booking date'
			,'FILES_EXTENSIONS' => 'Files extensions'
			,'ADD_NEW_DOCUMENT' => 'Add new document'
			,'BOOKING_NOTE' => "Thanks for booking with us, we'll contact you ASAP." 
			,'WITH' => 'with'
			,'OF' => 'of'
			,'FOR' => 'for'
			,'AT' => 'at'
			,'APPOINTMENT_INFO' => 'Appointment Info'
			,'FEES' => 'Fees'
			,'COLOR' => 'Color'
			,'RECENT_ARTICLES' => 'Recent articles'
			,'HOT_TOPICS' => 'Hot topics'
			,'POSTED' => 'Posted'
			,'SELECT_PLATFORM' => 'Select one or more platforms to reach you out'
			,'PLATFORM_ID' => 'Platform ID'
			,'PLATFORM' => 'Platform'
			,'DEFAULT_PLATFORM' => 'Default communication platform'
			,'SELECT_SESSION' => 'Select one available slot for each session'
			,'SESSION_INFO' => 'Sessions Info'
			,'SESSIONS_COUNT' => 'Sessions'
			,'SESSIONS' => 'Sessions'
			,'SESSION' => 'Session'
			,'HUSBAND_NAME' => 'Husband name'
			,'WIFE_NAME' => 'Wife name'
			,'WIFE_AGE' => 'Wife age'
			,'MARRIAGE_DURATION' => 'Marriage duration'
			,'PREG_RANGE' => 'Birth date range'
			,'OLD_PREGNANCY' => 'Was pregnant before ?'
			,'PREGNANCIES_NUMBER' => 'pregnancies number'
			,'LAST_PREGNANCY_DATE' => 'Last pregnancy date '
			,'YOUNG_CHILD_AGE' => 'Youngest child age'		
			,'OTHER' => 'Other'
			,'OTHER_REASONS' => 'Other reason'
			,'RPEATED_FAILURE' => 'Repeated failure of assisted fertilization treatment'
			,'RECURRENT_MISCARRIAGE' => 'Recurrent miscarriage'
			,'LOW_AMOUNT_QUALITY_SPERMS' => 'Low amount or quality of sperms'
			,'LACK_SPERMS' => 'Lack of sperms'
			,'PROBLEMS_FAILPIAN_TUBES' => 'problems with fallopian tubes'
			,'ENDOMETRIOSIS' => 'endometriosis'
			,'POLYCYSTIC_OVERIES' => 'polycystic ovaries'
			,'WEAK_OVULATION' => 'Weak ovulation'
			,'ICSI' => 'ICSI'
			,'IVF' => 'IVF'
			,'IUI' => 'IUI'
			,'GENDER_SELECTION' => 'gender selection'
			,'ICSI_PGD' => 'ICSI with PGD'
			,'ICSI_PGS' => 'ICSI with PGS'
			,'ICSI_SIGNLE_GEN' => 'ICSI with single gen examination'
			,'ICSI_TESTICULAR_BIOPSY' => 'ICSI with testicular biopsy'
			,'SEMEN_ANALYSIS' => 'semen analysis'
			,'UR_MSG' => 'Your message'

			,'WANTED_SERVICE' => 'Service type'
			,'DELAY_REASON' => 'The reason for delaying childbearing if known'
			,'BOOKING_OFFER_NOTE' => 'We will get in contact with you ASAP'
			,'THANKS_FOR_SENDING' => 'Thanks for choosing our services'
			,'VIEW_ALL_STORIES' => 'View all success stories'
			,'HOSPITAL' => 'Hospital'
			,'HOSPITALS' => 'Hospitals'
			,'MAKE_APPOINTMENT' => 'Make an appointment'
			,'NEW_TOPICS' => 'New topics'
			,'LOOKING_FOR_SOMETHING' => 'Looking for something'
			,'EMPTY_RESULT' => 'No data here'
			,'SEARCH_RESULT' => 'Search result'
			,'SEARCH_RESULTS' => 'Search results'
			,'EMPTY_TXT_BEFORE' => 'We couldn’t find any results for your search word'
			,'EMPTY_TXT_AFTER' => 'Please try type another word or check word spelling'
			,'SEARCH_PLACEHOLDER' => 'Type a key word, fertility, period problems, etc.'
			,'NATIONALITY' => 'Nationality'
			,'LONGITUDE' => 'Longitude'
			,'LATITUDE' => 'Latitude'
			,'OFFERS' => 'Offers'
			,'TALK_TO_EXPERTS_INTRO' => 'Have a question? talk to our experts now and we will answer all your questions'
			,'CHAT_WITH_US' => 'Chat with us'
			,'VIEW_ALL_DOCTORS' => 'View all doctors'
			,'VIEWW_ALL_DOCTORS' => 'View all doctors'
			,'LIBRARY' => 'Library'
			,'WIDTH' => 'Width'
			,'HEIGHT' => 'Height'
			,'HEAD_CODE' => 'Head custom code'
			,'BOOKING_MEDICAL_PART' => 'Let us know more about your medical state. Upload any previous medical docs'
			,'BOOK_LATER' => 'Book later'
			,'SKIP_STEP' => 'Skip this step'
			,'STEP' => 'step'
			,'VIEW_MAP' => 'View location in maps'
			,'SELECT_NEAR_BRANCH' => 'Please select your nearest branch'
			,'SELECT_SPECIALITY' => 'Please select your speciality'
			,'SELECT_DOCTOR' => 'Please select speciality doctor'
			,'SELECT_SLOT' => 'Select one of the available slots'
			,'SELECT_PAYMENT' => 'Select a payment method'
			,'AFTERNOON' => 'Afternoon'
			,'EVENING' => 'Evening'
			,'TIMES_AUTO_SET' => 'All times are set automatically upon current location'
			,'CUR_ZONE' => 'Current time zone'
			,'APPLY_DISCOUNT_CODE' => 'Apply a coupon to get discount'
			,'NEW_ARTICLES' => 'New articles'
			,'HISTORY' => 'Log History'
			,'UPCOMING_APPOINTMENTS' => 'Upcoming appointments'
			,'HOSTPITAL_STORY' => 'Hospital story'
			,'OUR_DOCTORS' => 'Our doctors'
			,'INTERNATIONAL_PATIENTS' => 'International patients'
			,'MEDIA_PRESS' => 'Media and press'
			,'UPCOMING_EVENTS' => 'Upcoming events'
			,'MORE_NEW' => 'More of our news…'
			,'PAGE_URL' => 'Page URL'
			,'SIMILAR_ITEMS' => 'Similar to what you read'
			,'FIRST_DAY_PERIOD' => 'First day of your last period ?'
			,'PERIOD_LAST' => 'How long does the period last ?'
			,'CYCLE_LONG' => 'How long is your cycle ?'
			,'CALCULATE' => 'Calculate'
			,'DAYS' => 'Days'
			,'OVULATION_CALCULATOR' => 'Ovulation Calculator'
			,'OVULATION_CALCULATOR_MSG' => 'Wondering, `when will i get my ovulation date ?` Our easy tracking tool helps map out your cycle.'
			,'CUSTOMIZE_OFFERS_MSG' => 'Customize your own? Fill the form below to get a customize package for you'
			,'PREGNANCY_CALCULATOR' => 'Pregnancy Calculator'
			,'CUSTOMIZE_PACKAGE' => 'Customize package now'
			,'CALCULATOR_MSG' => 'Wondering, `when will i get my period ?` Our easy tracking tool helps map out your cycle.'
			,'GO_HOME' => 'Go to homepage'
			,'BACK_HOME' => 'Back home'
			,'ALL_TIMES_SET' => 'All times are set automatically upon current location'
			,'PAYMENT_METHOD' => 'Payment method'
			,'CURRENT_ZONE' => 'Current time zone'
			,'ORDER_UNPAID' => 'This booking not paid yet'
			,'PAY_NOW' => 'Pay now'
			,'PLEASE_WAIT' => 'Please wait'
			,'PHONE_CALL' => 'I prefer an audio call'
			,'PAYMENT_MADE_SECCUESS' => 'Payment made successfully'
			,'TO_GET_PRICES' => 'to get prices'
			,'CONTINUE' => 'Continue'
			,'CONTINUE_PAYMENT' => 'Continue to payment'
			,'FILD_ID' => 'File number'
			,'MAIN_ADDRESS' => '2 Ahmed Elmlihy St. from Venny Square, Dokki, Giza, Egypt'
			,'SUBSCRIBED_OFFER_NOTE' => 'You have booked one of our offers: '
			,'CONSULTATION_NOTES1' => 'Please make sure you are logged in on your account at'
			,'CONSULTATION_NOTES2' => '5 mins before the session starts to test the connection.'
			,'TABLE_CONTENTS' => 'Table of contents'
			,'PREG_MONTH' => 'Pregnancy month is '
			,'FERTILITY_TIME' => 'Fertility time'
			,'MIN_SES' => 'min/session'
			,'RESULTS' => 'Results'
			,'BOOKING_DAYS' => 'Booking days'
			,'SOON' => 'Soon'
			,'CONTACT_INFO' => 'Please add your information to communicate with you'
			,'HELIOPLIS_ADDRESS' => '39 Cleopatra St, Salah Eldin Square, Heliopolis, Cairo, Egypt ( Cleopatra Hospitals )'
			,'TESEEN_ADDRESS' => 'Teseen St, 5th settlement, ( Cleopatra Polyclinics ) '
			,'ZAYED_ADDRESS' => '26th of July Corridor, Majarrah Al Sheikh Zayed, Giza Governorate '
			,'BADRAWY_ADDRESS' => 'Nile bdrawy hospital, corniche El-maadi, Cairo'
			,'ASHMON_ADDRESS' => 'Ashmoun Branch - Menoufia Al-Mashreq Hospital - Al-Kwadi Station - Ashmoun'
			,'BOOKING_WITH' => 'Booking with '
			,'NOT_VALID' => 'Not valid'
			
			,'MOBILE_ERR' => 'Mobile number not valid'
			,'FIELD' => 'Field'
			,'EMPTY' => 'Empty'
			,'ORDER_PAID' => 'This booking has been paid successfully'
			,'ORDER_FAILED' => 'This booking payment is failed '
			,'THANKS' => 'Thanks '
			,'CHOOSE_DATE_LABEL' => 'Please choose the booking date from this calendar '
			,'SELECT_TIME_AND_DATE' => 'Please select day and time for the booking.'
			,'SELECT_DATE' => 'Please select day of the booking.'
			,'SERVICE' => 'Service'
			,'show_invoice' => 'Show invoice'
			,'paid' => 'Paid'
			,'unpaid' => 'UnPaid'
			,'completed' => 'Completed'
			,'active' => 'Active'
			,'Stock alert products' => 'Stock alert products'
			,'Stock out products' => 'Stock out products'
			,'invoice_id' => 'Invoice id'
			,'confirm_delete' => 'Please confirm to delete this item'
			,'active_bookings' => 'Active bookings'
			,'TODAY_REVENUE' => 'Today revenue'
			,'Today orders' => 'Today orders'
			,'TODAY_BOOKINGS' => 'Today Bookings'
			,'TODAY_SOLD_PRODUCTS' => 'Today sold products'
			,'TODAY_INCOME' => 'Today income'
			,'today_payments' => 'Today payments'
			,'Latest unpaid Bookings' => 'Latest unpaid Bookings'
			,'Latest paid Bookings' => 'Latest paid Bookings'
			,'Latest sold products' => 'Latest sold products'
			,'connected_devices' => 'Connected devices'
			,'ADD_NEW_category' => 'Add new category'
			,'ADD_NEW_game' => 'Add new game'
			,'ADD_device' => 'Add device'
			,'Purchase_amount' => 'Purchase amount'
			,'Last_week_orders' => 'Last week orders'
			,'Last_30_Days' => 'Last 30 days'
			,'Invoice_Number' => 'Invoice number'
			,'Basic_Details' => 'Basic Details'
			,'Address_Details' => 'Address Details'
			,'invoice_info' => 'Invoice info'
			,'Invoice_terms___conditions' => 'Invoice terms & conditions'
			,'Invoice_notes' => 'Invoice notes'
			,'third_step' => 'Third step'
			,'please_add_your_devices_first' => 'Please add your devices first'
			,'editor_help' => 'At the top left of each section click on EDIT button and after editing click on SAVE'
			,'editor notes' => 'To edit Links or Images ( <a> / <img> ) tags use right-click at your mouse'
			,'Pickup locations description' => 'This list includes all pickup locations'
			,'Routes description' => 'List of routes with its pickup locations'
			,'RouteLocations' => 'Pickup Locations'
			,'Remaining Plan Days' => 'Days remaining until your plan requires update'
			,'Trips description' => 'List of the active Trips list.'
			,'Before Create driver note' => 'When you create new driver you should make sure that you have the right <b>Email</b>. <br />Because the generated password will be sent to him'
			,'Drivers applicants note' => 'You can enable or disable your business from receiving <b>applcants as drivers</b>. <br />You can manage it from Business Setting'
			,'upgrade_notification_note' => 'We will send you a notification upon Subscription expiration '
			,'users applicants note' => 'This list of the users who requested to join our routes. Once you review their info and approve the request, they would be able to pay for the subscribed package'
			,'RESET_PASSWORD_MSG' => 'Type your email, and we will send you confirmation code'
			,'SETTING_COMMISSION_NOTE' => 'Comission at online payment when consumer pay to business for Private trips and subscriptions'
			,'empty_data' => 'There is no data available to display'


			,'COPYRIGHTS' => 'Copyrights are reserved'
		);
	


		return array_column(array_map(function($q, $key){
			$key = strtoupper(str_replace([' ', '/', '&', '?','؟' , '@', '#', '$', '%', '(', ')', '-', '='], '_', $key)) ;
			return ['key'=>$key ,'value'=>$q];
		}, $LANG_ARRAY, array_keys($LANG_ARRAY)), 'value', 'key');
	}


	public static function translate($langkey)
	{
		$LANG_ARRAY = array_change_key_case(LangsEn::get(), CASE_LOWER);

	    $key = strtolower(str_replace([' ', '/', '&', '?','؟' , '@', '#', '$', '%', '(', ')', '-', '='], '_', $langkey)) ;
		
	    return isset($LANG_ARRAY[$key]) ? $LANG_ARRAY[$key] : (ucfirst(str_replace('_', ' ', $langkey)));
	} 

	public static function vueLang()
	{

		return array_change_key_case(LangsEn::get(), CASE_LOWER);

		return $data;
	}
}

