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




/** @return send_message */
RouteHandler::post('/send_message', Medians\Help\Application\HelpMessageController::class.'@store');



/**
 * Switch the language 
 * 
 * and redirect to home page
 * 
 */ 
RouteHandler::get('/switch-lang/(:all)', \Medians\DashboardController::class.'@switchLang');

/**
 * Authentication
 */
RouteHandler::get('/', \Medians\Pages\Application\PageController::class.'@homepage');
RouteHandler::get('/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
RouteHandler::get('/signup', \Medians\Auth\Application\AuthService::class.'@signupPage');
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
RouteHandler::get('/cart', \Medians\Cart\Application\CartController::class.'@cart');
RouteHandler::get('/checkout', \Medians\Cart\Application\CartController::class.'@checkout');
RouteHandler::get('/create-payment-intent', \Medians\Transactions\Application\TransactionController::class.'@createPaymentIntent');
RouteHandler::post('/cart/delete', \Medians\Cart\Application\CartController::class.'@delete');
RouteHandler::post('/cart/update', \Medians\Cart\Application\CartController::class.'@update');



// POST Requests
RouteHandler::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
RouteHandler::post('/signup', \Medians\Auth\Application\AuthService::class.'@userSignup');
RouteHandler::post('/reset-password', \Medians\Auth\Application\AuthService::class.'@userResetPassword');
RouteHandler::post('/reset-password-code', \Medians\Auth\Application\AuthService::class.'@resetChangePassword');


/**
 * Load sub-pages
 */
RouteHandler::get('/page/(:all)', \Medians\Pages\Application\PageController::class.'@page'); 

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

    RouteHandler::get('/admin/load_currencies', \Medians\Currencies\Application\CurrencyService::class.'@load');

    // API GET requests
    RouteHandler::get('/api/(:all)', \Medians\APIController::class.'@handle');

    RouteHandler::get('/logout', function () 
    {
        (new \Medians\Auth\Application\AuthService)->unsetSession();
        echo (new \config\APP)->redirect('./login');
    });



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

    /** @return payment methods */
    RouteHandler::get('/admin/payment_methods', Medians\PaymentMethods\Application\PaymentMethodController::class.'@index');

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



    /**
     * Master requests
     * The next reuests available only 
     * if the user is Master 
     * has role_id = 1
     */ 
    if ($app->auth()->role_id != 1)
        return $app->run();

    /**
    * @return System settings
    */
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
    
    RouteHandler::post('/admin/update_section_content', \Medians\Pages\Application\PageController::class.'@updateContent');
    RouteHandler::post('/admin/builder', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/submit', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/scrab', \Medians\Builders\Application\BuilderController::class.'@scrab'); 
    
}

// Front API GET requests
RouteHandler::post('/front_api', \Medians\FrontAPIController::class.'@handle');
RouteHandler::post('/front_api/create', \Medians\FrontAPIController::class.'@create');
RouteHandler::post('/front_api/update', \Medians\FrontAPIController::class.'@update');

/**
 * Loading assets with handling types
 */
RouteHandler::get('/assets', \Medians\Media\Application\MediaController::class.'@assets'); 

/**
 * Streaming multi-media types
 */
RouteHandler::get('/stream', \Medians\Media\Application\MediaController::class.'@stream'); 

/**
 * Load sub-pages
 */
RouteHandler::get('/(:all)', \Medians\Pages\Application\PageController::class.'@page'); 


return $app->run();


    