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



/**
 * Store daily reports
 */ 
Macaw::get('/admin/store_daily_report/(:all)', \Medians\Reports\Application\ReportController::class.'@store_report');


/**
 * These routes for guests 
 */ 
Macaw::get('/(:all)', \Medians\Pages\Application\PageController::class.'@pages');
Macaw::get('', \Medians\Pages\Application\PageController::class.'@home');

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
 * Switch the active branch
 * and redirect to Dashboard
 */ 
Macaw::get('/switch-branch/(:all)', function ($id)  {
    $app = new \config\App;
    $user = $app->auth();
    if (in_array($id, array_column($user->branches->toArray(), 'id')))
    {
        $user->update(['active_branch'=>$id]);
    }
    echo (new \config\APP)->redirect($_SERVER['HTTP_REFERER']);
});


Macaw::get('/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/signup', \Medians\Auth\Application\AuthService::class.'@signup');

/**
 * Activate account after signup
 */ 
Macaw::get('/activate-account/(:all)', \Medians\Users\Application\UserController::class.'@activate_account');

/** 
 * Login with Google redirect page
 */  
Macaw::get('/google_login_redirect', \Medians\Auth\Application\AuthService::class.'@verifyLoginWithGoogle');


/**
 * @return  Login page in case if not authorized 
 * Theses routes are POST requests
*/
Macaw::post('/', \Medians\Auth\Application\AuthService::class.'@userLogin');
Macaw::post('/userSignup', \Medians\Auth\Application\AuthService::class.'@userSignup');
Macaw::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
Macaw::get('/mobile_api/(:all)', \Medians\MobileAPIController::class.'@handle');
Macaw::post('/mobile_api/driver_login', \Medians\MobileAPIController::class.'@driver_login');
Macaw::post('/mobile_api/login', \Medians\MobileAPIController::class.'@login');
Macaw::post('/mobile_api/create', \Medians\MobileAPIController::class.'@create');
Macaw::post('/mobile_api/update', \Medians\MobileAPIController::class.'@update');
Macaw::post('/mobile_api', \Medians\MobileAPIController::class.'@handle');
Macaw::get('/route/(:all)', \Medians\Routes\Application\RouteController::class.'@getRoute');
Macaw::get('/driver/(:all)', \Medians\Drivers\Application\DriverController::class.'@getDriver');
Macaw::get('/trip/(:all)', \Medians\Trips\Application\TripController::class.'@getTrip');
Macaw::get('/helpMessages', \Medians\Help\Application\HelpMessageController::class.'@loadHelpMessages');



/**
* Restricted access requests 
*/
if(isset($app->auth()->id))
{

    $roleId = $app->auth()->role_id;

    // Switch dashboard controller based on the user Role 
    Macaw::get('/dashboard', \Medians\DashboardController::class.'@index'); 

    Macaw::get('/admin/payment_success', \Medians\Payments\Application\PaymentController::class.'@payment_success'); 
    Macaw::get('/admin/payment_failed', \Medians\Payments\Application\PaymentController::class.'@payment_failed'); 



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
    Macaw::get('/api/calendar', \Medians\Devices\Application\CalendarController::class.'@calendar');
    Macaw::get('/api/calendar_events', \Medians\Devices\Application\CalendarController::class.'@events');
    Macaw::get('/api/(:all)', \Medians\APIController::class.'@handle');

    Macaw::get('/logout', function () 
    {
        (new \Medians\Auth\Application\AuthService)->unsetSession();
        echo (new \config\APP)->redirect('./');
    });



    /**
    * @return Media Library requests
    */
    Macaw::post('/media-library-api/delete', \Medians\Media\Application\MediaController::class.'@delete');
    Macaw::post('/media-library-api/(:all)', \Medians\Media\Application\MediaController::class.'@upload');
    Macaw::get('/media-library-api/media', \Medians\Media\Application\MediaController::class.'@media');



    Macaw::get('/admin/devices/categories', function ()  {
        try 
        {
            return (new \Medians\Categories\Application\CategoryController)->index('Medians\Devices\Domain\Device');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



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
    * @return customers
    */
    Macaw::get('/admin/customers/index', \Medians\Customers\Application\CustomerController::class.'@index');
    Macaw::get('/admin/customers', \Medians\Customers\Application\CustomerController::class.'@index');




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

    /** @return help messages */
    Macaw::get('/admin/help_messages', Medians\Help\Application\HelpMessageController::class.'@index');

    /** @return trips */
    Macaw::get('/admin/trips', Medians\Trips\Application\TripController::class.'@index');

    /** @return trips */
    Macaw::get('/admin/parents', Medians\Parents\Application\ParentController::class.'@index');



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
    * @return Content editor
    */
    Macaw::get('/admin/pages', \Medians\Pages\Application\PageController::class.'@index');
    Macaw::get('/builder', \Medians\Builders\Application\BuilderController::class.'@index');
    Macaw::get('/admin/editor', \Medians\Pages\Application\PageController::class.'@editor');
    Macaw::post('/admin/update_section_content', \Medians\Pages\Application\PageController::class.'@updateContent');

    Macaw::get('/builder/load', \Medians\Builders\Application\BuilderController::class.'@load'); 
    Macaw::get('/builder/meta', \Medians\Builders\Application\BuilderController::class.'@meta'); 
    Macaw::post('/builder', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    Macaw::post('/builder/submit', \Medians\Builders\Application\BuilderController::class.'@submit'); 
    
    /**
    * @return Notifications events 
    */
    Macaw::get('/admin/notifications_events', \Medians\Notifications\Application\NotificationEventController::class.'@index');


    
    /**
    * @return Blog
    */
    Macaw::get('/admin/blog', Medians\Blog\Application\BlogController::class.'@index');
    Macaw::get('/admin/blog/categories', function ()  {
        return (new apps\Categories\CategoryController())->index('Medians\Blog\Domain\Blog');
    });

    




}

Macaw::get('/assets', \Medians\Media\Application\MediaController::class.'@assets'); 
Macaw::get('/stream', \Medians\Media\Application\MediaController::class.'@stream'); 



/**
* return list of device 
*/

return $app->run();


    