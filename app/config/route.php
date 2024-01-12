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
RouteHandler::get('/signup', \Medians\Auth\Application\AuthService::class.'@signup');

// Login as admin
RouteHandler::post('/', \Medians\Auth\Application\AuthService::class.'@userLogin');


/**
 * Mobile API requests authorized & non-authorized  
*/
RouteHandler::post('/mobile_api/login', \Medians\MobileAPIController::class.'@login');
RouteHandler::post('/mobile_api/create', \Medians\MobileAPIController::class.'@create');
RouteHandler::post('/mobile_api/update', \Medians\MobileAPIController::class.'@update');
RouteHandler::post('/mobile_api', \Medians\MobileAPIController::class.'@handle');

// Get requests
RouteHandler::get('/mobile_api/(:all)', \Medians\MobileAPIController::class.'@handle');
RouteHandler::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
RouteHandler::get('/route/(:all)', \Medians\Routes\Application\RouteController::class.'@getRoute');
RouteHandler::get('/driver_routes', \Medians\Routes\Application\RouteController::class.'@getDriverRoutes');
RouteHandler::get('/parent/(:all)', \Medians\Parents\Application\ParentController::class.'@checkParent');
RouteHandler::get('/get_parent', \Medians\Parents\Application\ParentController::class.'@getParent');
RouteHandler::get('/driver/(:all)', \Medians\Drivers\Application\DriverController::class.'@getDriver');
RouteHandler::get('/vehicle/(:all)', \Medians\Vehicles\Application\VehicleController::class.'@getVehicle');
RouteHandler::get('/trip/(:all)', \Medians\Trips\Application\TripController::class.'@getTrip');
RouteHandler::get('/getParentTrip/(:all)', \Medians\Trips\Application\TripController::class.'@getParentTrip');
RouteHandler::get('/events', \Medians\Events\Application\EventController::class.'@index');
RouteHandler::get('/routes', \Medians\Routes\Application\RouteController::class.'@index');



/**
* Restricted access requests 
*/
if(isset($app->auth()->id))
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
    * @return Settings request
    */
    RouteHandler::get('/admin/settings', \Medians\Settings\Application\SettingsController::class.'@index');



    /**
    * @return Users
    */
    RouteHandler::get('/admin/users/index', \Medians\Users\Application\UserController::class.'@index');
    RouteHandler::get('/admin/users', \Medians\Users\Application\UserController::class.'@index');
    RouteHandler::get('/admin/index_users', \Medians\Users\Application\UserController::class.'@index_users');

    

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

    /** @return Routes */
    RouteHandler::get('/admin/routes', Medians\Routes\Application\RouteController::class.'@index');

    /** @return Vehicles */
    RouteHandler::get('/admin/vehicles', Medians\Vehicles\Application\VehicleController::class.'@index');

    /** @return PickupLocations */
    RouteHandler::get('/admin/locations', Medians\Locations\Application\PickupLocationController::class.'@index');

    /** @return Destinations */
    RouteHandler::get('/admin/destinations', Medians\Locations\Application\DestinationController::class.'@index');

    /** @return help messages */
    RouteHandler::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return trips */
    RouteHandler::get('/admin/trips', Medians\Trips\Application\TripController::class.'@index');

    /** @return parents */
    RouteHandler::get('/admin/parents', Medians\Parents\Application\ParentController::class.'@index');

    /** @return events */
    RouteHandler::get('/admin/events', Medians\Events\Application\EventController::class.'@index');

    /** @return vacations */
    RouteHandler::get('/admin/vacations', Medians\Vacations\Application\VacationController::class.'@index');



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
    * @return Notifications events 
    */
    RouteHandler::get('/admin/notifications_events', \Medians\Notifications\Application\NotificationEventController::class.'@index');

    /** @return roles */
    RouteHandler::get('/admin/roles', Medians\Roles\Application\RoleController::class.'@index');

    /** @return companies */
    RouteHandler::get('/admin/companies', Medians\Businesses\Application\BusinessController::class.'@companies');

    /** @return schools */
    RouteHandler::get('/admin/schools', Medians\Businesses\Application\BusinessController::class.'@schools');

    /** @return Plans */
    RouteHandler::get('/admin/plans', Medians\Plans\Application\PlanController::class.'@index');

    /** @return Plan Feature */
    RouteHandler::get('/admin/plan_features', Medians\Plans\Application\PlanFeatureController::class.'@index');

    /** @return Plan subscriptions */
    RouteHandler::get('/admin/plan_subscriptions', Medians\Plans\Application\PlanSubscriptionController::class.'@index');

    /** @return Plan employees */
    RouteHandler::get('/admin/employees', Medians\Employees\Application\EmployeeController::class.'@index');


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


    