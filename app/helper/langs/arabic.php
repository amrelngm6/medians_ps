<?php



class Langs
{
	
	function __construct()
	{
		// code...
	}

	public static function get()
	{

				
		$LANG_ARRAY = array(

		'DIR' => 'rtl'
		,'HOMEPAGE' => 'الرئيسية'
		,'HOMEPAGE_TITLE' => 'الصفحة الرئيسية'
		,'MAINPAGE' => 'الرئيسية'
		,'ACCOUNT_PAGE' => 'الصفحة الشخصية'
		,'LOGIN' => 'دخول'
		,'REGISTER' => 'تسجيل'
		,'CUR_CUSTOMERS' => 'الاعضاء المسجلين'
		,'NAME' => 'الاسم'
		,'ENTER_MAIL' => 'البريد الالكتروني'
		,'ENTER_PASS' => 'كلمة المرور'
		,'PASSWORD' => 'كلمة المرور'
		,'PASSWORD_ERROR' => 'Password is not right'
		,'OLD_PASSWORD' => 'كلمة المرور الحالية'
		,'NEW_PASSWORD' => 'كلمة المرور الجديدة'
		,'ENTER_PASS_AG' => 'كلمة المرور مرة اخرى'
		,'NEW_CUSTOMERS' => 'الاعضاء الجدد'
		,'CREATE_ACCOUNT' => 'انشاء حساب'
		,'ENTER_FULLNAME' => 'الاسم بالكامل'
		,'USERNAME' => 'اسم المستخدم'
		,'EMAIL' => 'البريد الالكتروني'
		,'NO_SPACE' => 'بدون مسافات'
		,'ENTER_GENDER' => 'النوع'
		,'MALE' => 'ذكر'
		,'FEMALE' => 'انثي'
		,'REMEMBER' => 'تذكرني'
		,'PROFILE_INFO' => 'الصفحة الشخصية'
		,'CART' => 'السلة'
		,'WISHLIST' => 'Your Wishlist'
		,'ORDERS' => 'الفواتير'
		,'POST' => 'Post'
		,'COMMENT_HERE' => 'اترك تعليقك هنا'
		,'COMMENTS_POSTED' => 'تم إرسال التعليق'
		,'WRITE_COMMENT' => 'اكتب تعليقك'
		,'MY_ACCOUNT' => 'حسابي'
		,'MY_ORDERS' => 'فواتيري '
		,'CART' => 'السلة'
		,'CHECKOUT' => 'إرسال الطلب'
		,'MY_WISHLIST' => 'My Wishlist'
		,'SHOP_CART' => 'سلة التسوق'
		,'NO_CART' => 'لا يوجد عناصر فى سلة التسوق'
		,'TOTAL' => 'الاجمالى'
		,'SUB_TOTAL' => 'المبلغ الإجالمي'
		,'PRODUCT' => 'المنتج'
		,'PRODUCTS' => 'المنتجات'
		,'PLACE_ORDER' => 'إرسال الطلب'
		,'UR_ORDER' => 'طلبك'
		,'BILL_INFO' => 'بيانات الدفع'
		,'PROCEED_CHECKOUT' => 'الانتقال الى الدفع'
		,'PAYMENT' => 'الدفع'
		,'PRICE' => 'السعر'
		,'OPTIONS' => 'Options'
		,'ADD_CART' => 'اضف الى السلة'
		,'SAVE_LATER' => 'Save for later'
		,'ADD_REVIEW' => 'Add a Review'
		,'UR_RATING' => 'Your Rating'
		,'UR_REVIEW' => 'Your Review'
		,'MORE' => 'المزيد'

		,'MUSIC' => 'Music'
		,'VIDEOS' => 'Videos'
		,'PHOTOS' => 'Photos'
		,'USERS' => 'المستخدمين'
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
		,'DONE' => 'All Done'
		,'CONFIRMATION' => 'يرجى التأكد'
		,'CANCEL' => 'إلغاء'
		,'SAVE' => 'حفظ'
		,'DEL' => 'حذف'
		,'YES' => 'نعم'
		,'NO' => 'لا'
		,'NO_HERE' => 'Non'
		,'YET' => 'بعد'
		,'MESSAGES_LIST' => 'قائمة الرسائل'
		,'SEND' => 'Send'
		,'UPDATE' => 'تعديل'
		,'EDIT' => 'تعديل'
		,'EDIT_MEDIA' => 'Edit media'
		,'PR_VISITS' => 'Profile visits'
		,'FOLLOWERS' => 'Followers'
		,'FOLLOWING' => 'Following'
		,'FOLLOW' => 'Follow'
		,'UNFOLLOW' => 'Unfollow'
		,'ABOUT_ME' => 'About me'
		,'INFO' => 'البيانات'
		,'CONNECTION' => 'connection'
		,'SAY_SOMETHING' => 'Say something'
		,'BUY_NOW' => 'Buy now'
		,'BUY' => 'Buy'
		,'LIKE' => 'Like'
		,'LIKEED' => 'Already liked'
		,'PAYMENT_METHOD' => 'طريقة الدفع'
		,'DEPOSITE_METHODS' => 'Choose payment method to deposite'
		,'DOWNLOAD' => 'Download'
		,'DOWNLOADS' => 'Downloads/Purchases'
		,'PROGRESS' => 'Progress'
		,'ITEMS' => 'Items'
		,'ITEM' => 'Item'
		,'TITLE' => 'العنوان'
		,'DESC' => 'الوصف'
		,'LENGTH' => 'Length'
		,'PLAY' => 'Play'
		,'PLAYS' => 'Views'
		,'VIEWS' => 'المشاهدات'
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
		,'CATEGORY' => 'القسم'
		,'SHARE_SM' => 'نشر على مواقع التواصل '
		,'BLOG' => 'المقالات'
		,'CHOOSE_CAT' => 'Please choose category'
		,'PUBLIC_MEDIA' => 'This is public media ?'
		,'MEDIA_NUMBERS' => 'Media numbers'
		,'MEDIA_COUNT' => 'Media count'
		,'SET_PUBLIC_MEDIA' => 'Set as public Media'
		,'PLAYLIST_ID' => 'Playlist ID'
		,'VIDEO_ID' => 'Video ID'
		,'TRACK_TITLE' => 'Enter track title'
		,'LIKES' => 'Likes'
		,'COMMENTS' => 'التعليقات'
		,'SEARCH' => 'بحث'
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
		,'AMOUNT' => 'القيمة'
		,'ACC' => 'Account'
		,'METHOD' => 'طريقة'
		,'STATUS' => 'الحالة'
		,'DATE' => 'التاريخ'
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
		,'SIGNUP' => 'تسجيل'
		,'CUR_MEMBER' => 'Already have account ?'
		,'NEW_MEMBER' => 'Not a member ?'
		,'USE_SM' => 'Use your social media account'
		,'SIGNUP_WITH' => 'Sign in with'
		,'PERS_INFO' => 'البيانات الشخصية'
		,'BUSS_INFO' => 'Business information'
		,'information' => 'المعلومات'
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
		,'NO_MORE' => ' لا يوجد محتوى'
		,'CHAT' => 'محادثة'
		,'CH_PLAYLIST' => 'Select one of your playlists'
		,'ADD_TO_PLAYLIST' => 'Add to playlist'
		,'ADD_PLAYLIST_MSG' => 'You have not any playlists yet. Create new one'
		,'FAIL_PAY' => 'Payment failed'
		,'NO_CREDIT' => 'You have no enough credit to pay for this items.'
		,'THNKS_PURCHASE' => 'Thanks for your purchase'
		,'CANCL_PAY' => 'Your transaction has been canceled'
		,'SUCC_PURCHASE' => 'تم الدفع بنجاح. تم التاكيد على طلبك.'
		,'NO_ITEM_DOWNLOAD' => 'You have no items to download.'
		,'LOG_FIRST' => 'يرجى تسجيل الدخول اولا'
		,'LOG_AS_USER_FIRST' => 'يرجى  <a href="/login">تسجيل الدخول</a> اولا'
		,'LOG_AS_PROVIDER_FIRST' => 'Please login First as Branch'
		,'NO_LIKES' => "No Likes here yet"
		,'NO_COMMENTS' => "No comments here"
		,'DIS_COMMENTS' => "Comments disabled by administrator"
		,'NO_PLAYLIST' => "User have no playlist"
		,'AT_CART' => "You have this item at your cart"
		,'BOUGHT_BEFORE' => "You have bought this item before"
		,'404' => "We are sorry we can not find that page"
		,'404_TITLE' => "الصفحة غير موجودة"
		,'404_SUBTITLE' => "الصفحة التى تحاول الوصول اليها حاليا تم او نقلها او تم حذفها "
		,'404_PARAGRAPH' => "من الممكن  ان تكون وصلت هنا عن طريق الخطا "
		,'U_HAVE' => "You have "
		,'MSGS' => "All messages"
		,'NOTIFICATIONS' => "Notifications"
		,'ALL_NOTIFICATIONS' => "All Notifications"
		,'PROFILE' => "الملف الشخصي"
		,'UPLOAD' => "Upload"
		,'GRAB_YT' => 'Grab from YouTube'
		,'GRAB_SC' => 'Grab from SoundCloud'
		,'SETTINGS' => 'الاعدادات'
		,'LOGOUT' => 'تسجيل الخروج'
		,'JOIN' => 'الانضمام'
		,'RENEW' => 'Renew'
		,'SUBSCRIBE' => 'Subscribe'
		,'UPGRADE_PRODUCER' => 'Upgrade to producer'
		,'PLAN' => 'Plan'
		,'JOIN_PLAN' => 'Choose your plan'
		,'TIME' => 'Time'
		,'EX_DATE' => 'Expiration date'
		,'SUBSCRIPTION_MSG' => 'Make sure you have enough credit to subscribe to any plan'
		,'FORGOT_PASS' => 'نسيت كلمة المرور'
		,'ENTER_COUNTRY' => 'ادخل الدولة'
		,'ENTER_CITY' => 'ادخل المدينة'
		,'CITY' => 'المدينة'
		,'UPGRADE_MSG' => 'Enjoy with your new plan features.'
		,'SPONSOR_MSG' => 'More listeners more sales.'
		,'BEATS' => 'Beats'
		,'TOP_BEATS' => 'Top Beats'

		,'COMPANY' => 'الشركة'
		,'USERPOSITION' => 'User position'
		,'FAMILY' => 'Family'
		,'AWARDS' => 'Awards'
		,'WEBSITE' => 'الموقع الالكتروني'
		,'BUSINESS_EMAIL' => 'Business email'

		,'PRIVATE_ACOUNT_DETAILS' => 'Private account details'
		,'PUBLIC_PROFILE_DETAILS' => 'Public profile details'

		,'ORDER_BY' => 'عرض حسب '
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
		,'BROWSE' => 'تصفح'
		,'BROWSE_FILTER' => 'Browse filters'
		,'SELECT' => '-- إختر --'
		,'SELECT_CATS' => 'القسم'
		,'SELECT_MOODS' => 'Mood'
		,'MOST_POP' => 'Most Popular'
		,'MOST_PLY' => 'Most Plays'
		,'MOST_SELL' => 'Top sellers'
		,'ADD_WITHIN' => 'Added within'
		,'BPM' => 'BPM'
		,'TODAY' => 'اليوم'
		,'THIS_WEEK' => 'هذا الإسبوع'
		,'THIS_MONTH' => 'هذا الشهر'
		,'THIS_YEAR' => 'هذا العام'
		,'ALL_TIME' => 'كل الأوقات'
		,'BPM_DESC' => 'Beats per minute'
		,'MY_BEATS' => 'My beats'
		,'SELL_BEATS' => 'Sell beats'
		,'LEASES' => 'Leases'
		,'STATS' => 'Stats'
		,'DISCOUNT_CODE' => 'كود الخصم'
		,'discount_amount' => 'قيمة الخصم'
		,'DISCOUNT' => 'الخصم'
		,'DISCOUNTS' => 'الخصومات'
		,'NEW_DISCOUNT' => 'خصم جديد'
		,'PERCENTAGE' => 'النسبة'
		,'CODE' => 'الكود'
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

		,'login page' => 'الدخول للوحة الادارة'
		,'LOGIN_FAIL' => 'البيانات غير صحيحة يرجى المحاولة مرة اخري.'
		,'VALID_INPUT' => 'Please enter valid data.'
		,'LOGGEDIN' => 'تم تسجيل الدخول'
		,'SETTING_PAGE' => 'صفحة الاعدادات'
		,'SETTING_DETAILS' => 'Setting details'
		,'ADMINISTRATORS' => 'المديرين'
		,'SITENAME' => 'اسم الموقع'
		,'DENY_ACCESS' => 'ممنوع الوصول'
		,'SAVED' => 'تم'
		,'FAILED' => 'فشلت العملية'
		,'DASHBOARD' => 'لوحة الإدارة'
		,'SETTING' => 'الاعدادات'
		,'ADD_NEW' => 'إضافة جديد'
		,'ADD_NEW_category' => 'إضافة قسم جديد'
		,'ADD_NEW_game' => 'إضافة  لعبة  جديد'
		,'FULLNAME_EMPTY' => 'يرجى ادخال الاسم'
		,'EMAIL_FOUND' => 'هذا البريد موجود بالفعل '
		,'EMAIL_EMPTY' => 'البريد الالكتروني مطلوب'
		,'NAME_FOUND' => 'الإسم موجود بالفعل'
		,'NAME_EMPTY' => 'الإسم مطلوب'
		,'PASSWORD_SHORT' => 'كلمة المرور قصيرة, الحد الأدني  '
		,'PASSWORD_EMPTY' => 'Password missed, Min characters '
		,'PUBLISH' => 'نشط'
		,'ACTION' => 'Action'
		,'TEACHERS' => 'Teachers'
		,'TEACHER' => 'Teacher'
		,'BIRTHDAY' => 'Birthday'
		,'BIRTHDAY_DATE' => 'تاريخ الميلاد'
		,'ADRS' => 'العنوان'
		,'PHONE' => 'الهاتف'
		,'ROLE' => 'Role'
		,'CLASSES' => 'Classes'
		,'NUMBER' => 'رقم'
		,'GENDER' => 'النوع'
		,'PROVIDER' => 'مزود الخدمة'
		,'PROVIDERS' => 'مزودي الخدمة'
		,'OUR_PROVIDERS' => 'مزودي الخدمة '
		,'MOBILE' => 'الموبايل'
		,'PLUGINS' => 'Plugins'
		,'CHECK' => 'مراجعة'
		,'HOOKS' => 'Hooks'
		,'SUBMIT' => 'تنفيذ'
		,'CHOOSE' => 'اختر'
		,'POSITION' => 'Position'
		,'NEWS' => 'الأخبار'
		,'VIEW' => 'View'
		,'WORKING' => 'Working'
		,'WORKING_HOURS' => 'ساعات العمل'
		,'WORKING_DAYS' => 'ايام العمل'
		,'CATS' => 'Categories'
		,'PREFIX' => 'Prefix'
		,'STATE' => 'State'
		,'APT' => 'Apt'
		,'NEXT' => 'التالى'
		,'PREV' => 'السابق'
		,'NEXTPAGE' => 'الصفحة التالية'
		,'PREVPAGE' => 'الصفحة السابقة'
		,'GOLDEN' => 'Golden !'
		,'JOINUS' => 'انضم الينا'
		,'WELCOME' => 'اهلا'
		,'LOGIN_MSG' => 'اهلا بك, يرجى استخدام البيانات الخاصة بك للدخول الى  الى هذه الصفحة'
		,'FORMS_MSGS' => 'Forms messages'
		,'THNKS_MSG' => 'شكرا على رسالتك. سيتم التواصل معك فى اقرب وقت ممكن'
		,'MSG' => 'الرسالة'
		,'MSGS' => 'الرسائل'
		,'OUR' => 'OUR'
		,'RQST_FOR' => 'Request for'
		,'READMORE' => 'المزيد'
		,'LATEST_POSTS' => 'Latest posts'
		,'REL_POSTS' => 'Related posts'
		,'REL_ITEMS' => 'العناصر المرتبطة'

		,'BRANCH' => 'الفرع '
		,'BRANCHES' => 'الفروع'
		,'BRANCHES_LIST' => 'Branches LIST'
		,'BRANCHES_AND_LOCATIONS' => 'Branches & Locations'
		,'COMMENTS_ALLOW' => 'السماح بالتعليقات'
		,'COMMENTS_COUNT' => 'عدد التعليقات'
		,'TEMPLATE' => 'Template'
		,'LAYOUT' => 'Layout'
		,'LANGS' => 'اللغات'
		,'CON_TRANS' => 'Content translation'
		,'TAG_TITLE' => 'Tag title'
		,'TAG_DESC' => 'Tag describtion'
		,'TAG_KEYWORDS' => 'Tag keywords'
		,'CONTENT' => 'المحتوى'
		,'SHORT' => 'الملخص'
		,'SPECIALS' => 'Specials'
		,'GO_BACK' => 'العودة'
		,'ERR_INPUT_TITLE' => 'يرجى اضافة العنوان اولا.'
		,'ERR_INPUT_PAGES' => 'يرجى اختيار الصفحة.'
		,'ERR_INPUT_LANGS' => 'يرجى اختيار اللغة.'

		,'SIGNUP_DONE_MSG' => 'يمكنك الدخول بعد مراجعة حسابك.'
		,'ABOUT' => 'من نحن'
		,'CONTACT' => 'اتصل بنا'
		,'AR' => 'عربي'
		,'EN' => 'English'
		,'CHANGE_LANG' => 'English'
		,'CUSTOM_FIELDS' => 'Custom fields'
		,'CUSTOMERS' => 'العملاء'
			
		

		,'AGENT' => 'Company'
		,'AGENTS' => 'Companies'
		,'FOODMENU' => 'Food menu'
		,'CUSTOMERS' => 'العملاء'
		,'CUSTOMER' => 'العميل'
		,'NOTES' => 'ملاحظات'
		,'STOCK' => 'المخزون'
		,'START_STOCK' => 'Start Stock'
		,'EMPLOYEE' => 'Employee'
		,'AV_QTY' => 'Avaialbe quantity'
		,'QTY' => 'الكمية'
		,'START_QTY' => 'Start quantity'
		,'LEVEL' => 'Level'
		,'TYPE' => 'النوع'
		,'PENDING' => 'Pending'
		,'INVOICE' => 'فاتورة'
		,'TERMS_CONDS' => 'شروط الإستخدام'
		,'CUSTOMER_INFO' => 'Customer info'
		,'ORDERS' => 'الفواتير'
		,'ORDER' => 'الفاتورة'
		,'COST' => 'التكلفة'
		,'TOTAL_COST' => 'التكلفة الاجمالية'
		,'OFFICE' => 'Office number'
		,'MOBILE_API' => 'API management'
		,'STOCK_OUT_ALL' => 'Out of stock with this quantity'
		,'STOCK_OUT' => 'Out of stock with this quantity'
		,'VOUCHERS' => 'Vouchers'
		,'BRANCH_EMPTY' => 'Branch field is required'
		,'AGENT_EMPTY' => 'Company field is required'
		,'DESK_EMPTY' => 'Desk location field is required'
		,'PASSWORD_MATCHING_ERROR' => 'Password not matched'
		,'WRONG_INFO' => 'البيانات غير سليمة'
		,'ERR' => 'خطأ'
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
		,'FILTER' => 'ترتيب حسب'
		,'DAY' => 'اليوم'
		,'MONTH' => 'التاريخ'
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
		,'ARTICLES' => 'مقالات'
		,'URL_PATH' => 'Access url'
		,'LOGO' => 'Logo'
		,'GENRES' => 'Media categories'
		,'CUSTOM_FIELDS' => 'Custom fields'
		,'REGISTRATION' => 'التسجيل'
		,'REGISTRATION_STEP2' => 'Complete Registration'
		,'AGREE_TERMS' => 'تمت القراءة والموافقة على الشروط لاستخدام هذه الخدمة'
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
		,'NO_MORE' => 'لا يوجد اى محتوى'
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
		,'deleted' => 'تم الحذف بنجاح'
		,'ADD_UR_COMMENT' => 'أضف تعليقك...'
		,'ADD_USER' => 'إضافة مستخدم '
		,'REPLY' => 'رد'
		,'COMMENTED_UR' => ' commented on your '
		,'LIKED_UR' => ' liked your '
		,'MENTIONED_UR' => ' mentioned you at '
		,'TAGGED_UR' => ' tagged you at '
		,'SHARED_UR' => ' shared your '
		,'WANT_JOIN_UR' => ' want to join your '
		,'REPORT' => 'تقرير'
		,'ADD_PHOTO' => 'ADD PHOTO'
		,'ADD_PHOTOS' => 'ADD PHOTOS'
		,'ADD_VIDEO' => 'ADD VIDEO'
		,'ADD_VIDEOS' => 'ADD VIDEOS'
		,'CHAT_NOW' => 'Chat now'
		,'CONFIRM' => 'تأكيد الحجز'
		,'ADD' => 'إضافة'
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
		,'VIEW_ON_MAP' => 'عرض على الخريطة'
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
		,'COUPONS' => 'كوبونات الخصم'
		,'COUPON' => 'الكوبون'
		,'COUPON_DUPLICATED' => 'هذا الكود موجود من قبل'
		,'MIN_ORDER_COST' => 'الحد الأدني لتطبيق الخصم'
		,'ERR_MIN_ORDER' => 'حطأ! الحد الأدني لتطبيق الخصم هو  '
		,'ERR_EXPIRED' => 'خطأ! لم يعد متاح '
		,'VALUE' => 'القيمة'
		,'CUSTOMER_USAGE_LIMIT' => 'Usage limit (Per User)'
		,'USAGE_LIMIT' => 'Usage limit (Orders max number)'
		,'COMMISSION' => 'نسبة الخصم'
		,'END_DATE' => 'تاريخ الإنتهاء'
		,'START_DATE' => 'تاريخ البدء'
		,'END_TIME' => 'وقت الإنتهاء'
		,'END' => 'وقت الإنتهاء'
		,'START_TIME' => 'وقت   البدء'
		,'START' => 'وقت   البدء'
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
		,'WELCOME_PROFILE' => 'يمكنك مراجعة بياناتك الشخصية والتحكم بصفحتك الشخصية من خلال  القائمة'
		,'GROUP' => 'Group '
		,'GROUPS' => 'Groups '
		,'SORT' => 'Sort '
		,'BUSS_INFO' => 'بيانات العمل'


		,'DIRECTION' => 'Direction'
		,'DIRECTIONS' => 'Directions'
		,'BOOK' => 'حجز'
		,'BOOKING_ID' => 'رقم الحجز '
		,'BOOKING_INFO' => 'بيانات الحجز'
		,'BOOKING_THANKS' => 'شكرا لاختيارك احد عروض  '
		,'BOOKINGS' => 'الحجوزات'
		,'BOOKING_PAGE' => 'صفحة الحجز'
		,'BOOKING_DATE' => 'موعد الحجز'
		,'BOOK_NOW' => 'احجز الان'
		,'CHANGE_PICTURE' => 'تغيير الصورة الشخصية'
		,'LOCATION' => 'Location'
		,'LOCATIONS' => 'Locations'
		,'SHARE' => 'نشر'
		,'LOOK_FOR' => 'البحث عن'
		,'LOOKING_FOR' => 'البحث عن '
		,'FIELD_REQUIRED' => 'هذا الحقل مطلوب'
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
		,'LOGIN_DISABLED' => 'Customers login is disabled this time.'
		,'PROVIDERS_LOGIN_DISABLED' => 'Branches login is disabled this time.'



		,'ADD_TO_WISHLIST' => 'Add to wishlist'
		,'QUICK_VIEW' => 'Quick view'
		,'APPLY_COUPON' => 'تطبيق الخصم'
		,'COUPON_FORM_TITLE' => 'يرجى ادخال كود الخصم'
		,'NEW' => 'جديد'

		,'SPECIALIZATIONS' => 'الخدمات'
		,'SPECIALIZATION' => 'الخدمة'
		,'SPECIALITY' => 'التخصص'
		,'CLONE' => 'نسخ'
		,'SUCCESS_STORIES' => 'قصص النجاح'
		,'WATCH_VIDEO' => 'مشاهدة  الفيديو'
		,'MEDIA_PRESS' => 'الوسائط'
		,'DOCTORS' => 'الاطباء'
		,'DOCTOR' => 'الطبيب'
		,'INTRO' => 'Intro'
		,'HEADING' => 'Heading'
		,'FULL_BIO' => 'السيرة الذاتية'
		,'COUNT' => 'العدد'
		,'ALL_CASES' => 'جميع الحالات'
		,'BACK' => 'عودة'
		,'APPOINTMENTS' => 'مواعيد الحجز'
		,'ONLINE_CONSULTATION' => 'الاستشارة عبر الانترنت'
		,'ONLINE_CONSULTING' => 'الاستشارة عبر الانترنت'
		,'TEST_RESULT' => 'النتائج '
		,'TEST_RESULTS' => 'النتائج '
		,'MEDICAL_DOCS' => 'الملفات الطبية'
		,'FILES_EXTENSIONS' => 'Files extensions'
		,'ADD_NEW_DOCUMENT' => 'اضافة ملف  جديد '
		,'BOOKING_NOTE' => 'تم الحجز بنجاح, وسيتم التواصل معكم فى اقرب وقت'
		,'WITH' => 'مع'
		,'FOR' => 'من اجل'
		,'OF' => 'من'
		,'AT' => 'فى'
		,'APPOINTMENT_INFO' => 'معلومات الحجز'
		,'FEES' => 'التكلفة'
		,'COLOR' => 'اللون'
		,'RECENT_ARTICLES' => 'احدث المقالات'
		,'RELATED_ARTICLES' => 'صفحات ذات صلة'
		,'HOT_TOPICS' => 'مواضيع هامة'
		,'POSTED' => 'تم النشر'
		,'SELECT_PLATFORM' => 'يرجى اختيار الوسيلة المناسبة لك للتواصل'
		,'PLATFORM_ID' => 'اسم الحساب'
		,'PLATFORM' => 'البرنامج'
		,'DEFAULT_PLATFORM' => 'طريقة التواصل الافتراضية'
		,'SELECT_SESSION' => 'يرجى  اختيار الفترة المناسبة للتواصل'
		,'SESSION_INFO' => 'معلومات الجلسة'
		,'SESSIONS_COUNT' => 'جلسات'
		,'SESSIONS' => 'الجلسات'
		,'SESSION' => 'الجلسة'
		,'HUSBAND_NAME' => 'اسم الزوج'
		,'WIFE_NAME' => 'اسم الزوجة'
		,'WIFE_AGE' => 'عمر الزوجة'
		,'MARRIAGE_DURATION' => 'مدة الزواج'
		,'PREG_RANGE' => 'الفترة المحتملة للولادة'
		,'OLD_PREGNANCY' => 'هل كنت حامل ؟'
		,'PREGNANCIES_NUMBER' => 'عدد مرات الحمل'
		,'LAST_PREGNANCY_DATE' => 'تاريخ اخر حمل '
		,'YOUNG_CHILD_AGE' => 'عمر اصغر طفل'
		,'OTHER' => 'اخر'
		,'RPEATED_FAILURE' => 'الفشل المتكرر في علاج الإخصاب المساعد'
		,'RECURRENT_MISCARRIAGE' => 'الإجهاض المتكرر'
		,'LOW_AMOUNT_QUALITY_SPERMS' => 'كمية قليلة أو نوعية الحيوانات المنوية'
		,'LACK_SPERMS' => 'نقص الحيوانات المنوية'
		,'PROBLEMS_FAILPIAN_TUBES' => 'مشاكل في قناة فالوب'
		,'ENDOMETRIOSIS' => 'بطانة الرحم'
		,'POLYCYSTIC_OVERIES' => 'تكيس المبايض'
		,'WEAK_OVULATION' => 'ضعف التبويض'
		,'ICSI'=> 'الحقن المجهري'
		,'IVF' => 'اطفال انابيب'
		,'IUI' => 'التلقيح داخل الرحم'
		,'GENDER_SELECTION' => 'تحديد نوع الجنين'
		,'ICSI_PGD' => 'الحقن المجهري مع التشخيص الوراثي قبل زرع الأجنة'
		,'ICSI_PGS' => 'الحقن المجهري مع الفحص الجيني قبل الزرع'
		,'ICSI_SIGNLE_GEN' => 'الحقن المجهري مع فحص جيني واحد'
		,'ICSI_TESTICULAR_BIOPSY' => 'الحقن المجهري مع خزعة الخصية'
		,'SEMEN_ANALYSIS' => 'تحليل السائل المنوي'
		,'UR_MSG' => 'محتوى الرسالة'

		,'WRITTEN_BY' => 'الكاتب '
		,'WANTED_SERVICE' => 'نوع الخدمة المطلوبة'
		,'DELAY_REASON' => 'سبب تاخر الحمل ان كان معلوما'
		,'BOOKING_OFFER_NOTE' => 'سيتم التواصل معك باقرب وقت ممكن'
		,'THANKS_FOR_SENDING' => 'شكرا لاختيار خدمات مستشفي بداية . سيتم التواصل معك فى اقرب وقت ممكن'
		,'VIEW_ALL_STORIES' => 'عرض جميع القصص الناجحة'
		,'HOSPITAL' => 'المستشفي'
		,'HOSPITALS' => 'المستشفيات'
		,'MAKE_APPOINTMENT' => 'تحديد موعد'
		,'NEW_TOPICS' => 'مواضيع جديدة'
		,'LOOKING_FOR_SOMETHING' => 'هل تبحث عن شىء ما'
		,'EMPTY_RESULT' => 'لا يوجد بيانات '
		,'SEARCH_RESULT' => 'نتيجة البحث'
		,'SEARCH_RESULTS' => 'نتائج البحث'
		,'EMPTY_TXT_BEFORE' => 'لا يمكن ايجاد ما تبحق عنه'
		,'EMPTY_TXT_AFTER' => 'يرجى المحاولة مع كلمة اخري او قم بمراجعة  ما تم كتابته'
		,'SEARCH_PLACEHOLDER' => 'البحث عن ..'
		,'NATIONALITY' => 'الجنسية'
		,'LONGITUDE' => 'Longitude'
		,'LATITUDE' => 'Latitude'
		,'OFFERS' => 'العروض'
		,'TALK_TO_EXPERTS_INTRO' => 'لديك سؤال ؟  يمكنك التحدث   مباشرة الى احد المتخصصين'
		,'CHAT_WITH_US' => 'التواصل معنا'
		,'VIEW_ALL_DOCTORS' => 'عرض  جميع  الاطباء'
		,'VIEWW_ALL_DOCTORS' => 'عرض  جميع  الاطباء'
		,'LIBRARY' => 'المكتبة'
		,'WIDTH' => 'العرض'
		,'HEIGHT' => 'الارتفاع'
		,'BOOKING_MEDICAL_PART' => 'لخدمة افضل يرجى رفع اى ملفات  طبية خاصة بك'
		,'BOOK_LATER' => 'الحجز لاحقا'
		,'SKIP_STEP' => 'الخطوة التالية'
		,'STEP' => 'الخطوة'
		,'VIEW_MAP' => 'عرض الموقع على الخريطة'
		,'SELECT_NEAR_BRANCH' => 'يرجى تحديد الفرع الاقرب اليك'
		,'SELECT_SPECIALITY' => 'يرجى تحديد التخصص  المطلوب'
		,'SELECT_DOCTOR' => 'يرجى تحديد الطبيب المتخصص'
		,'SELECT_SLOT' => 'يرجى تحديد الموعد المناسب'
		,'SELECT_PAYMENT' => 'يرجى اختيار طريقة الدفع'
		,'AFTERNOON' => 'ظهرا'
		,'EVENING' => 'مساءا'
		,'NEXT' => 'التالى'
		,'TIMES_AUTO_SET' => 'جميع المواعيد تم تحديدها بناءا على حسب   الموقع الجغرافي'
		,'CUR_ZONE' => 'التوقيت'
		,'APPLY_DISCOUNT_CODE' => 'قم باضافة كود الخصم'
		,'NEW_ARTICLES' => 'مواضيع جديدة'
		,'HISTORY' => 'السجل السابق'
		,'UPCOMING_APPOINTMENTS' => 'المواعيد القادمة'
		,'HOSTPITAL_STORY' => 'عن المستشفي'
		,'OUR_DOCTORS' => 'فريق العمل'
		,'INTERNATIONAL_PATIENTS' => 'المقيمين بالخارج'
		,'MEDIA' => 'Media'
		,'MEDIA_PRESS' => 'الوسائط'
		,'UPCOMING_EVENTS' => 'الاحداث القادمة'
		,'MORE_NEW' => 'المزيد من الاخبار'
		,'PAGE_URL' => 'Page URL'
		,'SIMILAR_ITEMS' => 'موضوعات قد تهمك'
		,'FIRST_DAY_PERIOD' => 'تاريخ اليوم الاول من اخر دورة ؟'
		,'PERIOD_LAST' => ' المدة التى استمرت فيها اخر دورة'
		,'CYCLE_LONG' => 'الفترة التى مرت بين اخر دورتين'
		,'CALCULATE' => 'تنفيذ'
		,'DAYS' => 'ايام'
		,'CUSTOMIZE_OFFERS_MSG' => 'احصلي على العرض الخاص بيكي, وحددى العرض المناسب ليكي'
		,'OVULATION_CALCULATOR' => 'معرفة فترة التبويض'
		,'OVULATION_CALCULATOR_MSG' => 'لو عايزة تعرفى فترة التبويض الانسب  ليكى  ؟ جربى من هنا الاداة الخاصة  بمستشفيات بداية'
		,'PREGNANCY_CALCULATOR' => 'معرفة ميعاد الولادة'
		,'CUSTOMIZE_PACKAGE' => 'تخصيص العرض المناسب'
		,'CALCULATOR_MSG' => 'محتاجة تعرفى فترة الولادة هتكون تقريبا امتى ؟ تقدري تجربي   الاداة الخاصة بينا من هنا.'
		,'GO_HOME' => 'الذهاب للصفحة الرئيسية'
		,'BACK_HOME' => 'العودة للرئيسية'
		,'ALL_TIMES_SET' => 'جميع الاوقات تم تحديدها  حسب الموقع'
		,'CURRENT_ZONE' => 'المنطقة الحالية'
		,'PAYMENT_METHOD' => 'طريقة  الدفع'
		,'ORDER_UNPAID' => 'هذا الحجز لم يتم دفعه بعد'
		,'PAY_NOW' => 'الدفع الان'
		,'PLEASE_WAIT' => 'يرجى الانتظار'
		,'PHONE_CALL' => 'افضل الاتصال الهاتفى'
		,'PAYMENT_MADE_SECCUESS' => 'عملية الدفع تمت بنجاح'
		,'TO_GET_PRICES' => ' لعرض الاسعار'
		,'OTHER_REASONS' => 'اسباب اخري'
		,'CONTINUE' => 'استمرار'
		,'CONTINUE_PAYMENT' => 'المتابعة للدفع'
		,'FILD_ID' => 'رقم الملف'
		,'MAIN_ADDRESS' => '2 ش احمد المليحي, من ميدان فيني, الدقي, الجيزة, مصر'
		,'SUBSCRIBED_OFFER_NOTE' => 'تم الاشتراك فى  احد العروض  المقدمة من مستفيات بداية'
		,'CONSULTATION_NOTES1' => 'يرجى تسجيل الدخول على  حسابك الشخصى على '
		,'CONSULTATION_NOTES2' => 'قبل  بدء ميعاد الجلسة ب 5 دقائق  لتجربة الاتصال.'
		,'TABLE_CONTENTS' => 'جدول المحتوى'
		,'PREG_MONTH' => 'انت حامل فى الشهر  '
		,'FERTILITY_TIME' => 'الفترة المناسبة للحمل'
		,'MIN_SES' => 'دقيقة /جلسة'
		,'RESULTS' => 'النتائج'
		,'BOOKING_DAYS' => 'ايام الحجز'
		,'SOON' => 'قريبا'
		,'CONTACT_INFO' => 'رجاء اضافة بياناتك لكي يتم التواصل  معك'
		,'HELIOPLIS_ADDRESS' => '39 شارع كيلوباترا, ميدان صلاح الدين, هليوبليس, القاهرة, مصر ( مستشفى كليوباترا)'
		,'TESEEN_ADDRESS' => 'شارع التسعين, التجمع الخامس ,  (مجمع عيادات كليوباترا  ) '
		,'ZAYED_ADDRESS' => 'مجرة الشيخ زايد, طريق المحور المركزي, الجيزة '
		,'BADRAWY_ADDRESS' => 'مستشفي النيل البدراوى, كورنيش النيل, القاهرة'
		,'ASHMON_ADDRESS' => 'فرع اشمون - المنوفية  مستشفي المشرق- موقف الكوادي- أشمون '
		,'BOOKING_WITH' => 'احجز مع '
		,'NOT_VALID' => 'البيانات غير صحيحة'
		
		,'MOBILE_ERR' => 'رقم الموبايل غير صحيح'
		,'FIELD' => 'الحقل '
		,'EMPTY' => 'فارغ'
		,'ORDER_PAID' => 'تم سداد قيمة هذا الحجز بنجاح'
		,'ORDER_FAILED' => 'لم يتم سداد قيمة هذا الحجز  '
		,'THANKS' => 'شكرا لك '
		,'CHOOSE_DATE_LABEL' => 'يرجى تحديد التاريخ المناسب للحجز'
		,'SELECT_TIME_AND_DATE' => 'يجب اختيار التاريخ والوقت  لاكتمال الحجز'
		,'SELECT_DATE' => 'يجب اختيار التاريخ لاكتمال الحجز'
		,'SERVICE' => 'الخدمة'






		,'DEVICES' => 'الأجهزة'
		,'DEVICE' => 'الجهاز'
		,'PAYMENTS' => 'المدفوعات'
		,'CALENDAR' => 'تقويم الحجوزات'
		,'ALL_BOOKINGS' => 'جميع الحجوزات'
		,'ACTIVE_BOOKINGS' => 'حجوزات نشطة'
		,'COMPLETED_BOOKINGS' => 'حجوزات مكتملة'
		,'PAID_BOOKINGS' => 'حجوزات مدفوعة'
		,'MANAGEMENT' => 'الإدارة'
		,'PAID_ORDERS' => 'فواتير مدفوعة'
		,'REFUND_ORDERS' => 'فواتير مرتجعة'
		,'MANAGERS' => 'المديرين'
		,'PRODUCTS_LIST' => 'قائمة المنتجات'
		,'STOCK' => 'المخزون'
		,'STOCK_LOG' => 'سجل المخزون'
		,'TODAY_REVENUE' => 'أرباح اليوم'
		,'TODAY_BOOKINGS' => 'حجوزات اليوم'
		,'TODAY_SOLD_PRODUCTS' => 'مبيعات المنتجات اليوم'
		,'TODAY_INCOME' => 'إجمالي مبيعات اليوم'
		,'today_payments' => 'مصروفات اليوم'
		
		,'Latest unpaid Bookings' => 'احدث الحجوزات الغير مدفوعة'
		,'Latest paid Bookings' => 'احدث الحجوزات مدفوعة'
		,'Latest sold products' => 'احدث المنتجات المباعة'
		,'game' => 'اللعبة'
		,'games' => 'الألعاب'
		,'duration' => 'المدة'
		,'date' => 'التاريخ'
		,'by' => 'بواسطة'
		,'Devices bookings' => 'حجوزات الأجهزة'
		,'Invoice Number' => 'رقم الفاتورة'
		,'Invoice From' => 'فاتورة من'
		,'Payment Details' => 'تفاصيل الدفع'
		,'Billed to' => 'الفاتورة الى'
		,'Issue Date' => 'تارسخ الإنشاء'
		,'Issue Date' => 'تارسخ الإنشاء'
		,'SUBTOTAL' => 'المبلغ الإجالمي'
		,'Rate' => 'القيمة'
		,'Item' => 'عنصر'
		,'Terms and Conditions' => 'شروط الاستخدام'
		,'Total Amount' => 'القيمة الإجمالية'
		,'Tax' => 'الضريبة'
		,'Orders list' => 'قائمة الفواتير'
		,'Time' => 'الوقت'
		,'actions' => 'تفاصيل'
		,'add new' => 'أضف جديد'
		,'Add product' => 'إضافة منتج'
		,'Action' => 'إجراءات'
		,'Purchase amount' => 'تكلفة الشراء'
		,'paid amount' => 'القيمة المدفوعة'
		,'Payments list' => 'قائمة المدفوعات'
		,'devices list' => 'قائمة الأجهزة'
		,'device name' => 'اسم الجهاز'
		,'product name' => 'اسم المنتج'
		,'product price' => 'تكلفة المنتج'
		,'single price' => 'سعر الفردي'
		,'multi price' => 'سعر الزوجي'
		,'Edit device' => 'تعديل بيانات الجهاز'
		,'description' => 'الوصف'
		,'Basic Details' => 'البيانات الأساسية'
		,'Address Details' => 'بيانات العنوان'
		,'Address' => 'العنوان'
		,'country' => 'الدولة'
		,'invoice info' => 'بيانات الفاتورة'
		,'Invoice notes' => 'ملاحظات على الفواتير'
		,'Invoice terms & conditions' => 'شروط الاستخدام على الفواتير'
		,'Minimum Stock alert' => 'تنبيه عند وصول الحد الأدمي من المخزون'
		,'Number' => 'رقم'
		,'Currency' => 'العملة'
		,'Language' => 'اللغة'
		,'updated' => 'تم التعديل بنجاح'
		,'added' => 'تم الإضافة بنجاح'
		,'Password required' => 'كلمة المور مطلوبة'
		,'Email required' => 'البريد الإلكتروني مطلوب'
		,'Name required' => 'الإسم مطلوب'
		,'remove' => 'حذف'
		,'PROMO CODE' => 'كود الخصم'
		,'APPLY' => 'تطبيق'
		,'Add More Products' => 'إضافة منتجات'
		,'Add Products' => 'إضافة منتجات'
		,'finish' => 'إنهاء'
		,'start_playing' => 'بدء التشغيل'
		,'Order Summary' => 'ملخص الطلب'
		,'User credentials not valid' => 'بيانات الدخول غير صحيحة'
		,'User account is not active' => 'هذا الحساب غير نشط'
		,'Email already found' => 'هذا البريد موجود بالفعل'
		,'Logged in' => 'تم تسجيل الدخول'
		,'Purchased Products' => 'المنتجات التي تم شرائها'
		,'Last 30 Days' => 'اخر 30 يوم'
		,'Last week orders' => 'فواتير اخر إسبوع'
		,'Today orders' => 'فواتير اليوم'
		,'Products Stock' => 'سجل مخزون المنتجات'
		,'add device' => 'إضافة جهاز'
		,'First step' => 'الخطوة الأولي'
		,'Second step' => 'الخطوة الثانية'
		,'third Step' => 'الخطوة  الثالثة'
		,'Alert' => 'تنبيه'
		,'order_status_is' => 'حالة هذا الطلب'
		,'confirm_delete' => 'هل أنت متأكد من حذف هذا العنصر'
		,'Are your sure you want to finish this booking' => 'هل أنت متاكد من إكتمال الحجز'
		,'confirm_complete_booking' => 'هل أنت متاكد من إكتمال الحجز'
		,'order created' => 'تم تأكيد الطلب'
		,'Show orders' => 'عرض الفواتير'
		,'show_invoice' => 'عرض الفاتورة'
		,'paid' => 'مدفوع'
		,'completed' => 'مكتمل'
		,'active' => 'نشط'
		,'unpaid' => 'غير مدفوع'
		,'Created' => 'تم الإنشاء بنجاح'
		,'Stock alert products' => 'منتجات  أوشكت على النفاذ'
		,'Stock out products' => 'منتجات   نفذت من المخزون'
		,'invoice_id' => 'رقم الفاتورة'
		,'New Payment' => 'مدفوعات جديدة'
		,'devices_categories' => 'أقسام الأجهزة'
		,'edit_category' => 'تعديل القسم'
		,'edit_game' => 'تعديل  اللعبة'
		,'edit_product' => 'تعديل   المنتج'
		,'Remove this category' => 'حذف هذا القسم'
		,'Remove this game' => 'حذف  هذه اللعبة'
		,'model_required' => 'الموديل مطلوب'
		,'manage devices' => 'إدارة الأجهزة'
		,'categories' => 'الأقسام'
		,'connected_devices' => 'الأجهزة  المرتبطة'
		,'related_items' => 'الأجهزة  المرتبطة'
		,'CHECK_DATABASE_CONNECTION' => 'تأكد من بيانات قاعدة البيانات'
		,'this user not found' => 'هذا المستخدم غير موجود'
		,'This is canceled event' => 'هذا الحجز تم إلغاؤه'
		,'Canceled bookings' => 'الحجوزات الملغاء'
		,'COPYRIGHTS' => 'Copyrights are reserved'

		);
	

		return array_column(array_map(function($q, $key){
			$key = strtoupper(str_replace([' ', '/', '&', '?','؟' , '@', '#', '$', '%', '(', ')', '-', '='], '_', $key)) ;
			return ['key'=>$key ,'value'=>$q];
		}, $LANG_ARRAY, array_keys($LANG_ARRAY)), 'value', 'key');
	}


	public static function __($langkey)
	{
		$LANG_ARRAY = array_change_key_case(Langs::get(), CASE_LOWER);
		// $LANG_ARRAY = Langs::get();

	    $key = strtolower(str_replace([' ', '/', '&', '?','؟' , '@', '#', '$', '%', '(', ')', '-', '='], '_', $langkey)) ;
		
	    return isset($LANG_ARRAY[$key]) ? $LANG_ARRAY[$key] : $langkey;
	} 

	public static function vueLang()
	{

		return array_change_key_case(Langs::get(), CASE_LOWER);

		return $data;
	}

}

