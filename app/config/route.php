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
RouteHandler::get('/route/(:all)', \Medians\Routes\Application\RouteController::class.'@getRoute');
RouteHandler::get('/driver_routes', \Medians\Routes\Application\RouteController::class.'@getDriverRoutes');
RouteHandler::get('/business_routes', \Medians\Routes\Application\RouteController::class.'@getBusinessRoutes');
RouteHandler::get('/parent/(:all)', \Medians\Customers\Application\ParentController::class.'@checkParent');
RouteHandler::get('/get_parent', \Medians\Customers\Application\ParentController::class.'@getParent');
RouteHandler::get('/driver/(:all)', \Medians\Drivers\Application\DriverController::class.'@getDriver');
RouteHandler::get('/vehicle/(:all)', \Medians\Vehicles\Application\VehicleController::class.'@getVehicle');
RouteHandler::get('/trip/(:all)', \Medians\Trips\Application\TripController::class.'@getTrip');
RouteHandler::get('/private_trip/(:all)', \Medians\Trips\Application\PrivateTripController::class.'@getPrivateTrip');
RouteHandler::get('/upcoming_private_trip', \Medians\Trips\Application\PrivateTripController::class.'@upcomingTrip');
RouteHandler::get('/upcoming_parent_trip', \Medians\Trips\Application\PrivateTripController::class.'@upcomingParentTrip');
RouteHandler::get('/getParentTrip/(:all)', \Medians\Trips\Application\TripController::class.'@getParentTrip');
RouteHandler::get('/events', \Medians\Events\Application\EventController::class.'@index');
RouteHandler::get('/routes', \Medians\Routes\Application\RouteController::class.'@index');
RouteHandler::get('/Route_active_trip', \Medians\Trips\Application\TripController::class.'@getActiveTrip');
RouteHandler::get('/create-payment-intent', \Medians\Transactions\Application\TransactionController::class.'@createPaymentIntent');


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
    * @return Students
    */
    RouteHandler::get('/admin/students', Medians\Students\Application\StudentController::class.'@index');

    /**
    * @return Drivers
    */
    RouteHandler::get('/admin/drivers', Medians\Drivers\Application\DriverController::class.'@index');

    /**
    * @return Drivers
    */
    RouteHandler::get('/admin/driver_profile', Medians\Drivers\Application\DriverController::class.'@profile');

    /**
    * @return Drivers Applicants
    */
    RouteHandler::get('/admin/driver_applicants', Medians\Drivers\Application\DriverApplicantController::class.'@index');

    /**
    * @return Business Applicants
    */
    RouteHandler::get('/admin/business_applicants', Medians\Customers\Application\BusinessApplicantController::class.'@index');

    /** @return Routes */
    RouteHandler::get('/admin/routes', Medians\Routes\Application\RouteController::class.'@index');
    
    RouteHandler::get('/admin/routes/create', Medians\Routes\Application\RouteController::class.'@create');

    /** @return Vehicles */
    RouteHandler::get('/admin/vehicles', Medians\Vehicles\Application\VehicleController::class.'@index');

    /** @return RouteLocations */
    RouteHandler::get('/admin/locations', Medians\Locations\Application\RouteLocationController::class.'@index');

    /** @return help messages */
    RouteHandler::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return trips */
    RouteHandler::get('/admin/trips', Medians\Trips\Application\TripController::class.'@index');

    /** @return parents */
    RouteHandler::get('/admin/parents', Medians\Customers\Application\ParentController::class.'@index');

    /** @return events */
    RouteHandler::get('/admin/events', Medians\Events\Application\EventController::class.'@index');

    /** @return vacations */
    RouteHandler::get('/admin/vacations', Medians\Vacations\Application\VacationController::class.'@index');

    /** @return packages */
    RouteHandler::get('/admin/packages', Medians\Packages\Application\PackageController::class.'@index');

    /** @return payment methods */
    RouteHandler::get('/admin/payment_methods', Medians\PaymentMethods\Application\PaymentMethodController::class.'@index');

    /** @return PackageSubscription */
    RouteHandler::get('/admin/package_subscriptions', Medians\Packages\Application\PackageSubscriptionController::class.'@index');

    /** @return VehicleType */
    RouteHandler::get('/admin/vehicle_types', Medians\Vehicles\Application\VehicleTypeController::class.'@index');

    /** @return Supervisors */
    RouteHandler::get('/admin/supervisors', Medians\Customers\Application\SuperVisorController::class.'@index');

    /** @return Get-started */
    RouteHandler::get('/admin/get_started', Medians\Users\Application\GetStartedController::class.'@get_started');


    /**
    * @return Business settings
    */
    RouteHandler::get('/admin/settings', \Medians\Settings\Application\SettingsController::class.'@index');

    /** @return Plan employees */
    RouteHandler::get('/admin/employees', Medians\Customers\Application\EmployeeController::class.'@index');

    /** @return Private trips */
    RouteHandler::get('/admin/private_trips', Medians\Trips\Application\PrivateTripController::class.'@index');
    
    /** @return Admin profile */
    RouteHandler::get('/admin/profile', Medians\Users\Application\UserController::class.'@profile');

    /** @return Payments */
    RouteHandler::get('/admin/transactions', Medians\Transactions\Application\TransactionController::class.'@index');

    /** @return Invoices */
    RouteHandler::get('/admin/invoices', Medians\Invoices\Application\InvoiceController::class.'@index');

    /** @return Wallets */
    RouteHandler::get('/admin/wallets', Medians\Wallets\Application\WalletController::class.'@index');

    /** @return Business Withdrawals */
    RouteHandler::get('/admin/withdrawals', Medians\Wallets\Application\WithdrawalController::class.'@index');

    /** @return Business Collected cash */
    RouteHandler::get('/admin/collected_cash', Medians\Wallets\Application\CollectedCashController::class.'@index');

    /** @return Gallery */
    RouteHandler::get('/admin/gallery', Medians\Gallery\Application\GalleryCashController::class.'@index');



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

    /** @return Plans */
    RouteHandler::get('/admin/plans', Medians\Plans\Application\PlanController::class.'@index');

    /** @return Plan Feature */
    RouteHandler::get('/admin/plan_features', Medians\Plans\Application\PlanFeatureController::class.'@index');

    /** @return Plan subscriptions */
    RouteHandler::get('/admin/plan_subscriptions', Medians\Plans\Application\PlanSubscriptionController::class.'@index');

    /** @return Payments */
    RouteHandler::get('/admin/payments', Medians\Payments\Application\PaymentController::class.'@index');

    /** @return companies */
    RouteHandler::get('/admin/companies', Medians\Businesses\Application\BusinessController::class.'@companies');

    /** @return schools */
    RouteHandler::get('/admin/schools', Medians\Businesses\Application\BusinessController::class.'@schools');

    /** @return Business Withdrawals */
    RouteHandler::get('/admin/business_withdrawals', Medians\Wallets\Application\BusinessWithdrawalController::class.'@index');

    /** @return Business Wallets */
    RouteHandler::get('/admin/business_wallets', Medians\Wallets\Application\BusinessWalletController::class.'@index');

    /** @return Business Languages */
    RouteHandler::get('/admin/languages', Medians\Languages\Application\LanguageController::class.'@index');

    /** @return Business Translations */
    RouteHandler::get('/admin/translations', Medians\Languages\Application\TranslationController::class.'@index');

    /** @return Subscriber */
    RouteHandler::get('/admin/newsletter_subscribers', Medians\Newsletters\Application\NewsletterSubscriberController::class.'@index');

    /** @return Contact Forms */
    RouteHandler::get('/admin/contact_forms', Medians\Forms\Application\ContactFormController::class.'@index');


    /**
    * @return Content editor
    */
    RouteHandler::get('/admin/pages', \Medians\Pages\Application\PageController::class.'@index');
    RouteHandler::get('/admin/builder', \Medians\Builders\Application\BuilderController::class.'@index');
    RouteHandler::get('/admin/editor', \Medians\Pages\Application\PageController::class.'@editor');
    RouteHandler::get('/admin/builder/load', \Medians\Builders\Application\BuilderController::class.'@load'); 
    RouteHandler::get('/admin/builder/meta', \Medians\Builders\Application\BuilderController::class.'@meta'); 
    RouteHandler::get('/admin/builder/scrab', \Medians\Builders\Application\BuilderController::class.'@scrab_get'); 
    
    RouteHandler::post('/admin/update_section_content', \Medians\Pages\Application\PageController::class.'@updateContent');
    RouteHandler::post('/admin/builder', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/submit', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    RouteHandler::post('/admin/builder/scrab', \Medians\Builders\Application\BuilderController::class.'@scrab'); 
    
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


    