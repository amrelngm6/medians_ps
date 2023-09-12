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
// Macaw::get('/home', \Medians\Pages\Application\PageController::class.'@page');
// Macaw::get('/arabic', \Medians\Pages\Application\PageController::class.'@page');
// Macaw::get('/arabic/', \Medians\Pages\Application\PageController::class.'@page');
Macaw::get('/getMedia/(:all)', \Medians\Messages\Application\MessageController::class.'@loadMedia');
Macaw::get('/messages', \Medians\Messages\Application\MessageController::class.'@index');
Macaw::get('/load_messages', \Medians\Messages\Application\MessageController::class.'@load_messages');
Macaw::get('/load_contacts', \Medians\Messages\Application\MessageController::class.'@load_contacts');
Macaw::get('/new_chats', \Medians\Conversations\Application\ConversationController::class.'@new_chats');


Macaw::get('/home/central_webhook_callback', \Medians\Messages\Application\MessageController::class.'@webhook');
Macaw::post('/home/central_webhook_callback', \Medians\Messages\Application\MessageController::class.'@webhook');
Macaw::get('/', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/(:all)', \Medians\Messages\Application\MessageController::class.'@page');


Macaw::post('/join_contact/(:all)', \Medians\Conversations\Application\ConversationController::class.'@save');
Macaw::post('/read_message/(:all)', \Medians\Messages\Application\MessageController::class.'@read_message');


/**
 * Switch the language 
 * 
 * and redirect to home page
 * 
 */ 
Macaw::get('/switch-lang/(:all)', \Medians\DashboardController::class.'@switchLang');




Macaw::get('/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/dashboard', \Medians\DashboardController::class.'@index');

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



/**
* Restricted access requests 
*/
if(isset($app->auth()->id))
{

    $roleId = $app->auth()->role_id;

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
    Macaw::post('/wp/send_image', \Medians\Messages\Application\MessageController::class.'@uploadImage');
    Macaw::post('/wp/send_file', \Medians\Messages\Application\MessageController::class.'@uploadFile');
    Macaw::get('/media-library-api/media', \Medians\Media\Application\MediaController::class.'@media');



    /**
    * @return devices
    */
    Macaw::get('/admin/devices/manage', \Medians\Devices\Application\DeviceController::class.'@manage');
    Macaw::get('/admin/devices/orders', \Medians\Devices\Application\DeviceController::class.'@orders');
    Macaw::get('/admin/devices_orders', \Medians\Devices\Application\DeviceController::class.'@orders');
    Macaw::get('/admin/devices/index', \Medians\Devices\Application\DeviceController::class.'@index');
    Macaw::get('/admin/devices/calendar', \Medians\Devices\Application\CalendarController::class.'@index');
    Macaw::get('/admin/calendar', \Medians\Devices\Application\CalendarController::class.'@index');
    Macaw::get('/admin/devices/booking_follow', \Medians\Devices\Application\BookingController::class.'@index');

    Macaw::get('/admin/devices/categories', function ()  {
        try 
        {
            return (new \Medians\Categories\Application\CategoryController)->index('Medians\Devices\Domain\Device');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



    /**
    * @return Games
    */
    Macaw::get('/admin/games/index', \Medians\Games\Application\GameController::class.'@index');
    Macaw::get('/admin/games', \Medians\Games\Application\GameController::class.'@index');

    /**
    * @return Discounts
    */
    Macaw::get('/admin/discounts/index', \Medians\Games\Application\GameController::class.'@index');
    Macaw::get('/admin/discounts', \Medians\Games\Application\GameController::class.'@index');


    /**
    * @return Products
    */
    Macaw::get('/admin/products/stock_alert', \Medians\Products\Application\ProductController::class.'@stock_alert');
    Macaw::get('/admin/products/stock_out', \Medians\Products\Application\ProductController::class.'@stock_out');
    Macaw::get('/admin/products/orders', \Medians\Products\Application\ProductController::class.'@orders');
    Macaw::get('/admin/products/index', \Medians\Products\Application\ProductController::class.'@index');
    Macaw::get('/admin/products', \Medians\Products\Application\ProductController::class.'@index');
    Macaw::get('/admin/products/categories', function ()  {
        return (new \Medians\Categories\Application\CategoryController())->index('Medians\Products\Domain\Product');
    });


    /**
    * @return Stock
    */
    Macaw::get('/admin/stock/index', \Medians\Products\Application\StockController::class.'@index');
    Macaw::get('/admin/stock', \Medians\Products\Application\StockController::class.'@index');

    /**
    * @return Payments
    */
    Macaw::get('/admin/payments/index', \Medians\Payments\Application\PaymentController::class.'@index');
    Macaw::get('/admin/payments', \Medians\Payments\Application\PaymentController::class.'@index');

    /**
    * @return Expenses
    */
    Macaw::get('/admin/expenses/index', \Medians\Expenses\Application\ExpenseController::class.'@index');
    Macaw::get('/admin/expenses', \Medians\Expenses\Application\ExpenseController::class.'@index');

    /**
    * @return Orders
    */
    Macaw::get('/admin/orders/index', \Medians\Orders\Application\OrderController::class.'@index');
    Macaw::get('/admin/invoices/show/(:all)', \Medians\Orders\Application\OrderController::class.'@show');
    Macaw::get('/admin/invoices', \Medians\Orders\Application\OrderController::class.'@index');
    Macaw::get('/admin/orders', \Medians\Orders\Application\OrderController::class.'@index');


    /**
    * @return Settings request
    */
    Macaw::get('/admin/settings', \Medians\Settings\Application\SettingsController::class.'@index');



    /**
    * @return Users
    */
    Macaw::get('/admin/users/index', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/admin/users/', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/admin/users', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/admin/index_users', \Medians\Users\Application\UserController::class.'@index_users');

    /**
    * @return customers
    */
    Macaw::get('/admin/customers/index', \Medians\Customers\Application\CustomerController::class.'@index');
    Macaw::get('/admin/customers/', \Medians\Customers\Application\CustomerController::class.'@index');
    Macaw::get('/admin/customers', \Medians\Customers\Application\CustomerController::class.'@index');


    /**
    * @return Branches
    */
    Macaw::get('/admin/branches/index', \Medians\Branches\Application\BranchController::class.'@index');
    Macaw::get('/admin/branches', \Medians\Branches\Application\BranchController::class.'@index');


    /**
    * @return Plans subscriptions
    */
    Macaw::get('/admin/plan_subscriptions', \Medians\Plans\Application\PlanSubscriptionController::class.'@index');



    /**
    * @return Content Notifications 
    */
    Macaw::get('/admin/notifications', \Medians\Notifications\Application\NotificationController::class.'@index');
    Macaw::get('/admin/latest_notifications', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    Macaw::get('/admin/latest_notifications/', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    Macaw::get('/admin/latest_notifications/(:all)', \Medians\Notifications\Application\NotificationController::class.'@latest_notifications');
    Macaw::post('/admin/read_notification', \Medians\Notifications\Application\NotificationController::class.'@read_notification');
    Macaw::post('/admin/check_notification', \Medians\Notifications\Application\NotificationController::class.'@check_notification');

    



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
    * @return Plans
    */
    Macaw::get('/admin/plans/index', \Medians\Plans\Application\PlanController::class.'@index');
    Macaw::get('/admin/plans', \Medians\Plans\Application\PlanController::class.'@index');
    Macaw::get('/admin/plan_features/index', \Medians\Plans\Application\PlanFeatureController::class.'@index');
    Macaw::get('/admin/plan_features', \Medians\Plans\Application\PlanFeatureController::class.'@index');


    
    /**
    * @return Blog
    */
    Macaw::get('/admin/blog', Medians\Blog\Application\BlogController::class.'@index');
    Macaw::get('/admin/blog/', Medians\Blog\Application\BlogController::class.'@index');
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


    