<?php 

/**
 * Medians PS System
 * 
 * Here you can control all routes 
 * for backend & frontend
 */ 

use \NoahBuscher\Macaw\Macaw;

use Medians\APIController;
use Medians\DashboardController;
$app = new \config\APP;




/** @return send_message */
Macaw::post('/send_message', Medians\Help\Application\HelpMessageController::class.'@store');



/**
 * Switch the language 
 * 
 * and redirect to home page
 * 
 */ 
Macaw::get('/switch-lang/(:all)', \Medians\DashboardController::class.'@switchLang');

/**
 * Authentication
 */
Macaw::get('/', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/signup', \Medians\Auth\Application\AuthService::class.'@signup');

// Login as admin
Macaw::post('/', \Medians\Auth\Application\AuthService::class.'@userLogin');

/**
 * Activate account after signup
 */ 
Macaw::get('/activate-account/(:all)', \Medians\Users\Application\UserController::class.'@activate_account');

/** 
 * Login with Google redirect page
 */  
Macaw::get('/google_login_redirect', \Medians\Auth\Application\AuthService::class.'@verifyLoginWithGoogle');


/**
 * Mobile API requests authorized & non-authorized  
*/
Macaw::post('/mobile_api/login', \Medians\MobileAPIController::class.'@login');
Macaw::post('/mobile_api/create', \Medians\MobileAPIController::class.'@create');
Macaw::post('/mobile_api/update', \Medians\MobileAPIController::class.'@update');
Macaw::post('/mobile_api', \Medians\MobileAPIController::class.'@handle');

// Get requests
Macaw::get('/mobile_api/(:all)', \Medians\MobileAPIController::class.'@handle');
Macaw::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
Macaw::get('/route/(:all)', \Medians\Routes\Application\RouteController::class.'@getRoute');
Macaw::get('/driver_routes', \Medians\Routes\Application\RouteController::class.'@getDriverRoutes');
Macaw::get('/parent/(:all)', \Medians\Parents\Application\ParentController::class.'@checkParent');
Macaw::get('/get_parent', \Medians\Parents\Application\ParentController::class.'@getParent');
Macaw::get('/driver/(:all)', \Medians\Drivers\Application\DriverController::class.'@getDriver');
Macaw::get('/vehicle/(:all)', \Medians\Vehicles\Application\VehicleController::class.'@getVehicle');
Macaw::get('/trip/(:all)', \Medians\Trips\Application\TripController::class.'@getTrip');
Macaw::get('/events', \Medians\Events\Application\EventController::class.'@index');
Macaw::get('/routes', \Medians\Routes\Application\RouteController::class.'@index');



/**
* Restricted access requests 
*/
if(isset($app->auth()->id))
{

    // Dashboard controller based on the user Role 
    Macaw::get('/dashboard', \Medians\DashboardController::class.'@index'); 


    // API POST requests
    Macaw::post('/api/create', \Medians\APIController::class.'@create');
    Macaw::post('/api/update', \Medians\APIController::class.'@update');
    Macaw::post('/api/delete', \Medians\APIController::class.'@delete');
    Macaw::post('/api/updateStatus', \Medians\APIController::class.'@updateStatus');
    Macaw::post('/api/checkout', \Medians\Orders\Application\OrderController::class.'@checkout');
    Macaw::post('/api/bug_report', \Medians\APIController::class.'@bug_report');
    Macaw::post('/api/search', \Medians\APIController::class.'@search');
    Macaw::post('/api/(:all)', \Medians\APIController::class.'@handle');
    Macaw::post('/api', \Medians\APIController::class.'@handle');

    // API GET requests
    Macaw::get('/api/(:all)', \Medians\APIController::class.'@handle');

    Macaw::get('/logout', function () 
    {
        (new \Medians\Auth\Application\AuthService)->unsetSession();
        echo (new \config\APP)->redirect('./login');
    });



    /**
    * @return Media Library requests
    */
    Macaw::post('/media-library-api/delete', \Medians\Media\Application\MediaController::class.'@delete');
    Macaw::post('/media-library-api/(:all)', \Medians\Media\Application\MediaController::class.'@upload');
    Macaw::get('/media-library-api/media', \Medians\Media\Application\MediaController::class.'@media');




    /**
    * @return Settings request
    */
    Macaw::get('/admin/settings', \Medians\Settings\Application\SettingsController::class.'@index');



    /**
    * @return Users
    */
    Macaw::get('/admin/users/index', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/admin/users', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/admin/index_users', \Medians\Users\Application\UserController::class.'@index_users');

    

    /**
    * @return  Notifications 
    */
    Macaw::get('/admin/notifications', \Medians\Notifications\Application\NotificationController::class.'@index');
    Macaw::get('/admin/latest_notifications', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    Macaw::get('/admin/latest_notifications/(:all)', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    Macaw::post('/admin/read_notification', \Medians\Notifications\Application\NotificationController::class.'@read_notification');
    Macaw::post('/admin/check_notification', \Medians\Notifications\Application\NotificationController::class.'@check_notification');

    

    /**
    * @return Students
    */
    Macaw::get('/admin/students', Medians\Students\Application\StudentController::class.'@index');

    /**
    * @return Drivers
    */
    Macaw::get('/admin/drivers', Medians\Drivers\Application\DriverController::class.'@index');

    /** @return Routes */
    Macaw::get('/admin/routes', Medians\Routes\Application\RouteController::class.'@index');

    /** @return Vehicles */
    Macaw::get('/admin/vehicles', Medians\Vehicles\Application\VehicleController::class.'@index');

    /** @return PickupLocations */
    Macaw::get('/admin/locations', Medians\Locations\Application\PickupLocationController::class.'@index');

    /** @return Destinations */
    Macaw::get('/admin/destinations', Medians\Locations\Application\DestinationController::class.'@index');

    /** @return help messages */
    Macaw::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return trips */
    Macaw::get('/admin/trips', Medians\Trips\Application\TripController::class.'@index');

    /** @return parents */
    Macaw::get('/admin/parents', Medians\Parents\Application\ParentController::class.'@index');

    /** @return events */
    Macaw::get('/admin/events', Medians\Events\Application\EventController::class.'@index');

    /** @return vacations */
    Macaw::get('/admin/vacations', Medians\Vacations\Application\VacationController::class.'@index');

    /** @return roles */
    Macaw::get('/admin/roles', Medians\Roles\Application\RoleController::class.'@index');



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
    Macaw::get('/admin/system_settings', \Medians\Settings\Application\SystemSettingsController::class.'@index');

    /**
    * @return Notifications events 
    */
    Macaw::get('/admin/notifications_events', \Medians\Notifications\Application\NotificationEventController::class.'@index');




}


/**
 * Loading assets with handling types
 */
Macaw::get('/assets', \Medians\Media\Application\MediaController::class.'@assets'); 

/**
 * Streaming multi-media types
 */
Macaw::get('/stream', \Medians\Media\Application\MediaController::class.'@stream'); 

return $app->run();


    