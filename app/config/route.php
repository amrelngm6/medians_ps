<?php 

/**
 * Medians PS System
 * 
 * Here you can control all routes 
 * for backend & frontend
 */ 

use \Shared\RouteHandler;

use Medians\APIController;
use Medians\DashboardController;
$app = new \config\APP;



/**
 * Loading assets with handling types
 */
RouteHandler::get('/assets', \Medians\Media\Application\MediaController::class.'@assets'); 

/**
 * Streaming multi-media types
 */
RouteHandler::get('/stream', \Medians\Media\Application\MediaController::class.'@stream'); 


/** @return send_message */
RouteHandler::post('/send_message', Medians\Help\Application\HelpMessageController::class.'@store');
RouteHandler::get('/online-consultation/(:num)', \Medians\OnlineConsultations\Application\OnlineConsultationController::class.'@page');
RouteHandler::get('/%D8%A7%D8%B3%D8%AA%D8%B4%D8%A7%D8%B1%D8%A7%D8%AA-%D8%A7%D9%88%D9%86%D9%84%D8%A7%D9%8A%D9%86/(:num)', \Medians\OnlineConsultations\Application\OnlineConsultationController::class.'@page');
RouteHandler::get('/%D8%AF%D9%83%D8%AA%D9%88%D8%B1-%D9%85%D9%86%D9%8A-%D8%B4%D8%B9%D8%A8%D8%A7%D9%86', \Medians\Doctors\Application\DoctorController::class.'@list'); 
RouteHandler::get('/doctors', \Medians\Doctors\Application\DoctorController::class.'@list'); 
RouteHandler::get('/doctors/', \Medians\Doctors\Application\DoctorController::class.'@list'); 
RouteHandler::get('/doctor_booking/(:all)', \Medians\Bookings\Application\BookingController::class.'@doctor_booking'); 
RouteHandler::get('/book/(:all)', \Medians\Bookings\Application\BookingController::class.'@page'); 
RouteHandler::get('/bookings/(:all)', \Medians\Bookings\Application\BookingController::class.'@page'); 
RouteHandler::post('/submit/(:all)', \Medians\FrontendController::class.'@form_submit'); 
RouteHandler::get('/blog', \Medians\Blog\Application\BlogController::class.'@list'); 
RouteHandler::get('/blog/', \Medians\Blog\Application\BlogController::class.'@list'); 
RouteHandler::get('/offer_booking/(:all)', \Medians\Offers\Application\OfferController::class.'@page'); 
RouteHandler::get('/search', \Medians\Pages\Application\PageController::class.'@search'); 
RouteHandler::get('/search/', \Medians\Pages\Application\PageController::class.'@search'); 
RouteHandler::get('/technologies', \Medians\Technologies\Application\TechnologyController::class.'@list'); 
RouteHandler::get('/technologies/(:all)', \Medians\Technologies\Application\TechnologyController::class.'@item'); 
RouteHandler::get('/booking_confirm/booking', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/booking_confirm/online_consultation', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/booking_confirm/offers', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/booking_confirm/contact', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 


// Front API GET requests
RouteHandler::post('/front_api', \Medians\FrontAPIController::class.'@handle');
RouteHandler::post('/front_api/create', \Medians\FrontAPIController::class.'@create');
RouteHandler::post('/front_api/update', \Medians\FrontAPIController::class.'@update');
RouteHandler::post('/front_api/delete', \Medians\FrontAPIController::class.'@delete');


/**
 * Switch the language 
 */ 
RouteHandler::get('/switch-lang/(:all)', \Medians\DashboardController::class.'@switchLang');

/**
 * Authentication
 */
RouteHandler::get('/', \Medians\Pages\Application\PageController::class.'@homepage');
RouteHandler::get('/dashboard/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
RouteHandler::get('/google_login_redirect', \Medians\Auth\Application\AuthService::class.'@verifyLoginWithGoogle');
RouteHandler::get('/activate-account/(:all)', \Medians\Auth\Application\AuthService::class.'@activate');
RouteHandler::get('/reset-password', \Medians\Auth\Application\AuthService::class.'@resetPasswordPage');
RouteHandler::get('/reset-password-code', \Medians\Auth\Application\AuthService::class.'@resetPasswordCodePage');

// Login as admin
RouteHandler::post('/', \Medians\Auth\Application\AuthService::class.'@userLogin');


/**
 * Mobile API requests authorized & non-authorized  
*/
RouteHandler::post('/mobile_api/login', \Medians\MobileAPIController::class.'@login');
RouteHandler::post('/mobile_api/create', \Medians\MobileAPIController::class.'@create');
RouteHandler::post('/mobile_api/update', \Medians\MobileAPIController::class.'@update');
RouteHandler::post('/mobile_api/delete', \Medians\MobileAPIController::class.'@delete');
RouteHandler::post('/mobile_api', \Medians\MobileAPIController::class.'@handle');

// Get requests
RouteHandler::get('/mobile_api/(:all)', \Medians\MobileAPIController::class.'@handle');
/**
 * Cart routes
 */
RouteHandler::get('/search', \Medians\Products\Application\ProductController::class.'@searchPage');
RouteHandler::get('/cart', \Medians\Cart\Application\CartController::class.'@cart');
RouteHandler::get('/wishlist', \Medians\Cart\Application\WishlistController::class.'@wishlist');
RouteHandler::get('/compare', \Medians\Cart\Application\CompareController::class.'@compare');
RouteHandler::get('/checkout', \Medians\Cart\Application\CartController::class.'@checkout');
RouteHandler::get('/invoice/(:all)', \Medians\Invoices\Application\InvoiceController::class.'@invoicePage');
RouteHandler::get('/create-payment-intent', \Medians\Transactions\Application\TransactionController::class.'@createPaymentIntent');
RouteHandler::post('/cart/delete', \Medians\Cart\Application\CartController::class.'@delete');
RouteHandler::post('/cart/update', \Medians\Cart\Application\CartController::class.'@update');

RouteHandler::get('/customer/login', \Medians\Auth\Application\CustomerAuthService::class.'@loginPage');
RouteHandler::get('/customer/signup', \Medians\Auth\Application\CustomerAuthService::class.'@signupPage');
RouteHandler::get('/customer/confirm_account', \Medians\Auth\Application\CustomerAuthService::class.'@otp');
RouteHandler::get('/customer/dashboard', \Medians\Customers\Application\CustomerController::class.'@dashboard');
RouteHandler::get('/order/(:all)', \Medians\Orders\Application\OrderController::class.'@orderPage');


// POST Requests
RouteHandler::post('/dashboard/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
RouteHandler::post('/reset-password', \Medians\Auth\Application\AuthService::class.'@userResetPassword');
RouteHandler::post('/reset-password-code', \Medians\Auth\Application\AuthService::class.'@resetChangePassword');
RouteHandler::post('/customer/signup', \Medians\Auth\Application\CustomerAuthService::class.'@userSignup');
RouteHandler::post('/customer/login', \Medians\Auth\Application\CustomerAuthService::class.'@userLogin');
RouteHandler::post('/customer/confirm', \Medians\Auth\Application\CustomerAuthService::class.'@checkOTP');
RouteHandler::post('/customer/reset-password', \Medians\Auth\Application\CustomerAuthService::class.'@userResetPassword');
RouteHandler::post('/customer/reset-password-code', \Medians\Auth\Application\CustomerAuthService::class.'@resetChangePassword');

/**
* Restricted access requests 
*/
if(!empty($app->auth()))
{

    // Dashboard controller based on the user Role 
    RouteHandler::get('/dashboard', \Medians\DashboardController::class.'@index'); 
    RouteHandler::get('/admin/dashboard', \Medians\DashboardController::class.'@index'); 


    // API POST requests
    RouteHandler::post('/api/create', \Medians\APIController::class.'@create');
    RouteHandler::post('/api/update', \Medians\APIController::class.'@update');
    RouteHandler::post('/api/delete', \Medians\APIController::class.'@delete');
    RouteHandler::post('/api/updateStatus', \Medians\APIController::class.'@updateStatus');
    RouteHandler::post('/api/checkout', \Medians\Orders\Application\OrderController::class.'@checkout');
    RouteHandler::post('/api/bug_report', \Medians\APIController::class.'@bug_report');
    RouteHandler::post('/api/search', \Medians\APIController::class.'@search');
    RouteHandler::post('/api/(:all)', \Medians\APIController::class.'@handle');
    RouteHandler::post('/api', \Medians\APIController::class.'@handle');

    // API GET requests
    RouteHandler::get('/api/(:all)', \Medians\APIController::class.'@handle');




    /**
    * @return Media Library requests
    */
    RouteHandler::post('/media-library-api/delete', \Medians\Media\Application\MediaController::class.'@delete');
    RouteHandler::post('/media-library-api/(:all)', \Medians\Media\Application\MediaController::class.'@upload');
    RouteHandler::get('/media-library-api/media', \Medians\Media\Application\MediaController::class.'@media');



    /**
    * @return Users
    */
    RouteHandler::get('/admin/users/index', \Medians\Users\Application\UserController::class.'@index');
    RouteHandler::get('/admin/users', \Medians\Users\Application\UserController::class.'@index');

    

    /**
    * @return  Notifications 
    */
    RouteHandler::get('/admin/notifications', \Medians\Notifications\Application\NotificationController::class.'@index');
    RouteHandler::get('/admin/latest_notifications', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    RouteHandler::get('/admin/latest_notifications/(:all)', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    RouteHandler::post('/admin/read_notification', \Medians\Notifications\Application\NotificationController::class.'@read_notification');
    RouteHandler::post('/admin/check_notification', \Medians\Notifications\Application\NotificationController::class.'@check_notification');

    

    /**
    * @return products
    */
    RouteHandler::get('/admin/products', Medians\Products\Application\ProductController::class.'@index');
    RouteHandler::get('/admin/products/new', Medians\Products\Application\ProductController::class.'@create');
    RouteHandler::get('/admin/products/(:all)', Medians\Products\Application\ProductController::class.'@product');

    /**
    * @return Categories
    */
    RouteHandler::get('/admin/product_categories', Medians\Products\Application\CategoryController::class.'@index');
    RouteHandler::get('/admin/product_categories/new', Medians\Products\Application\CategoryController::class.'@create');
    RouteHandler::get('/admin/product_categories/(:all)', Medians\Products\Application\CategoryController::class.'@category');

    /**
    * @return Brands
    */
    RouteHandler::get('/admin/brands', Medians\Brands\Application\BrandController::class.'@index');

    /**
    * @return Shipping
    */
    RouteHandler::get('/admin/shipping', Medians\Shipping\Application\ShippingController::class.'@index');

    /**
    * @return Newsletters
    */
    RouteHandler::get('/admin/newsletters', Medians\Newsletters\Application\NewsletterController::class.'@index');

    RouteHandler::get('/admin/newsletter_subscribers', Medians\Newsletters\Application\SubscriberController::class.'@index');

    /** @return Customers */
    RouteHandler::get('/admin/customers', Medians\Customers\Application\CustomerController::class.'@index');

    /** @return help messages */
    RouteHandler::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return events */
    RouteHandler::get('/admin/events', Medians\Events\Application\EventController::class.'@index');

    /** @return packages */
    RouteHandler::get('/admin/packages', Medians\Packages\Application\PackageController::class.'@index');

    /** @return Specialization */
    RouteHandler::get('/admin/specialization', \Medians\Specializations\Application\SpecializationController::class.'@index');

    /** @return Get-started */
    RouteHandler::get('/admin/get_started', Medians\Users\Application\GetStartedController::class.'@get_started');


    /**
    * @return Business settings
    */
    RouteHandler::get('/admin/settings', \Medians\Settings\Application\SettingsController::class.'@index');

    /** @return Admin profile */
    RouteHandler::get('/admin/profile', Medians\Users\Application\UserController::class.'@profile');

    /** @return Gallery */
    RouteHandler::get('/admin/gallery', Medians\Gallery\Application\GalleryController::class.'@index');

    /** @return reviews */
    RouteHandler::get('/admin/reviews', Medians\Reviews\Application\ReviewController::class.'@index');

    /** @return Doctors */
    RouteHandler::get('/admin/doctors', Medians\Doctors\Application\DoctorController::class.'@index');

    /** @return Blog */
    RouteHandler::get('/admin/blog', \Medians\Blog\Application\BlogController::class.'@index');

    /** @return OnlineConsultation */
    RouteHandler::get('/admin/online_consultation', \Medians\OnlineConsultations\Application\OnlineConsultationController::class.'@index');

    /** @return Offer */
    RouteHandler::get('/admin/offers', \Medians\Offers\Application\OfferController::class.'@index');

    /** @return Offer */
    RouteHandler::get('/admin/success_stories', \Medians\Stories\Application\StoryController::class.'@index');

    /** @return Technologies */
    RouteHandler::get('/admin/technologies', \Medians\Technologies\Application\TechnologyController::class.'@index');

    /** @return Bookings */
    RouteHandler::get('/admin/bookings', \Medians\Bookings\Application\BookingController::class.'@index');
    RouteHandler::get('/admin/offers_bookings', \Medians\Bookings\Application\BookingController::class.'@index_offers');
    RouteHandler::get('/admin/consultation_bookings', \Medians\Bookings\Application\BookingController::class.'@index_consultation');
    RouteHandler::get('/admin/contact_bookings', \Medians\Bookings\Application\BookingController::class.'@index_contact');
    RouteHandler::get('/admin/doctor_bookings', \Medians\Bookings\Application\BookingController::class.'@index_doctor');
    
    
    RouteHandler::get('/admin/visitors', \Medians\Visits\Application\VisitController::class.'@index');

    /**
    * @return System settings
    */
    RouteHandler::get('/admin/settings', \Medians\Settings\Application\SystemSettingsController::class.'@index');
    RouteHandler::get('/admin/system_settings', \Medians\Settings\Application\SystemSettingsController::class.'@index');
    RouteHandler::get('/admin/site_settings', \Medians\Settings\Application\SiteSettingsController::class.'@index');
    RouteHandler::get('/admin/payment_settings', \Medians\Settings\Application\PaymentSettingsController::class.'@index');

    /**
    * @return AppSettings
    */
    RouteHandler::get('/admin/app_settings', \Medians\Settings\Application\AppSettingsController::class.'@index');

    /**
    * @return AppSettings
    */
    RouteHandler::get('/admin/parent_app_settings', \Medians\Settings\Application\AppSettingsController::class.'@parent_index');

    /**
    * @return Notifications events 
    */
    RouteHandler::get('/admin/notifications_events', \Medians\Notifications\Application\NotificationEventController::class.'@index');

    /** @return roles */
    RouteHandler::get('/admin/roles', Medians\Roles\Application\RoleController::class.'@index');

    /** @return Payments */
    RouteHandler::get('/admin/payments', Medians\Payments\Application\PaymentController::class.'@index');

    /** @return Business Languages */
    RouteHandler::get('/admin/languages', Medians\Languages\Application\LanguageController::class.'@index');

    /** @return Business Translations */
    RouteHandler::get('/admin/translations', Medians\Languages\Application\TranslationController::class.'@index');

    /** @return Subscriber */
    RouteHandler::get('/admin/newsletter_subscribers', Medians\Newsletters\Application\NewsletterSubscriberController::class.'@index');

    /** @return Contact Forms */
    RouteHandler::get('/admin/contact_forms', Medians\Forms\Application\ContactFormController::class.'@index');

    /** @return Contact Forms */
    RouteHandler::get('/admin/menus', \Medians\Menus\Application\MenuController::class.'@index');
    
    /** @return Email templates */
    RouteHandler::get('/admin/email_templates', \Medians\Templates\Application\EmailTemplateController::class.'@index');

    /** @return countries */
    RouteHandler::get('/admin/countries', Medians\Locations\Application\CountryController::class.'@index');

    /** @return cities */
    RouteHandler::get('/admin/cities', Medians\Locations\Application\CityController::class.'@index');

    /** @return states */
    RouteHandler::get('/admin/states', Medians\Locations\Application\StateController::class.'@index');

    /** @return Templates */
    RouteHandler::get('/admin/templates', Medians\Templates\Application\WebTemplateController::class.'@index');



    /**
    * @return Content editor
    */
    RouteHandler::get('/admin/email_builder', \Medians\Builders\Application\EmailBuilderController::class.'@index');
    RouteHandler::get('/admin/pages', \Medians\Pages\Application\PageController::class.'@index');
    RouteHandler::get('/admin/builder', \Medians\Builders\Application\BuilderController::class.'@index');
    RouteHandler::get('/admin/editor', \Medians\Pages\Application\PageController::class.'@editor');
    RouteHandler::get('/admin/builder/load', \Medians\Builders\Application\BuilderController::class.'@load'); 
    RouteHandler::get('/admin/builder/meta', \Medians\Builders\Application\BuilderController::class.'@meta'); 
    RouteHandler::get('/admin/builder/languages', \Medians\Builders\Application\BuilderController::class.'@languages'); 
    RouteHandler::get('/admin/builder/template_preview', \Medians\Builders\Application\BuilderController::class.'@template_preview'); 
    RouteHandler::get('/admin/builder/new', \Medians\Builders\Application\BuilderController::class.'@new_get'); 
    RouteHandler::get('/admin/builder/scrab', \Medians\Builders\Application\BuilderController::class.'@scrab_get'); 

    RouteHandler::post('/admin/update_section_content', \Medians\Pages\Application\PageController::class.'@updateContent');
    RouteHandler::post('/admin/builder', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/submit', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/scrab', \Medians\Builders\Application\BuilderController::class.'@scrab'); 
    
}


RouteHandler::get('/logout', function () 
{
    (new \Medians\Auth\Application\AuthService)->unsetSession();
    (new \Medians\Auth\Application\CustomerAuthService)->unsetSession();
    echo (new \config\APP)->redirect('./');
});


/**
 * Load sub-pages
 */
RouteHandler::get('/(:all)/', \Medians\Pages\Application\PageController::class.'@page'); 
RouteHandler::get('/(:all)/(:all)', \Medians\Pages\Application\PageController::class.'@sub_page'); 
RouteHandler::get('/(:all)', \Medians\Pages\Application\PageController::class.'@page'); 


return $app->run();


    