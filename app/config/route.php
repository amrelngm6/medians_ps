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
RouteHandler::get('/', \Medians\Auth\Application\AuthService::class.'@loginPage');
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


// POST Requests
RouteHandler::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
RouteHandler::post('/signup', \Medians\Auth\Application\AuthService::class.'@userSignup');
RouteHandler::post('/reset-password', \Medians\Auth\Application\AuthService::class.'@userResetPassword');
RouteHandler::post('/reset-password-code', \Medians\Auth\Application\AuthService::class.'@resetChangePassword');


/**
* Restricted access requests 
*/
if(!empty($app->auth()))
{

    // Dashboard controller based on the user Role 
    RouteHandler::get('/dashboard', \Medians\DashboardController::class.'@index'); 


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
    * @return Leads
    */
    RouteHandler::get('/admin/leads', Medians\Leads\Application\LeadController::class.'@index');

    /** @return help messages */
    RouteHandler::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return Admin profile */
    RouteHandler::get('/admin/profile', Medians\Users\Application\UserController::class.'@profile');


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

    
    /** @return  Languages */
    RouteHandler::get('/admin/languages', Medians\Languages\Application\LanguageController::class.'@index');

    /** @return  Translations */
    RouteHandler::get('/admin/translations', Medians\Languages\Application\TranslationController::class.'@index');

    /** @return Contact Forms */
    RouteHandler::get('/admin/contact_forms', Medians\Forms\Application\ContactFormController::class.'@index');

    /** @return Email templates */
    RouteHandler::get('/admin/email_templates', \Medians\Templates\Application\EmailTemplateController::class.'@index');

}


/**
 * Loading assets with handling types
 */
RouteHandler::get('/assets', \Medians\Media\Application\MediaController::class.'@assets'); 

/**
 * Streaming multi-media types
 */
RouteHandler::get('/stream', \Medians\Media\Application\MediaController::class.'@stream'); 

return $app->run();


    