<?php 

use \NoahBuscher\Macaw\Macaw;

use Medians\APIController;
use Medians\DashboardController;
$app = new \config\APP;


Macaw::get('/home', \Medians\Pages\Application\PageController::class.'@page');
Macaw::get('/', \Medians\Pages\Application\PageController::class.'@page');
Macaw::get('/invoices/print/(:all)', \Medians\Orders\Application\OrderController::class.'@print');
Macaw::get('/invoices/qr_code/(:all)', \Medians\Orders\Application\OrderController::class.'@qr_code');


Macaw::get('/switch-lang/(:all)', function ($lang)  {

    $_SESSION['site_lang'] = in_array($lang, ['arabic', 'english']) ? $lang : 'arabic';
    echo (new \config\APP)->redirect('/');
    return true;
});


Macaw::get('/login', \Medians\Auth\Application\AuthService::class.'@loginPage');
Macaw::get('/signup', \Medians\Auth\Application\AuthService::class.'@signup');
Macaw::get('/google_login_redirect', \Medians\Auth\Application\AuthService::class.'@verifyLoginWithGoogle');

/**
 * @return  Login page in case if not authorized 
*/
Macaw::post('/', \Medians\Auth\Application\AuthService::class.'@userLogin');
Macaw::post('/userSignup', \Medians\Auth\Application\AuthService::class.'@userSignup');
Macaw::post('/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
Macaw::get('/activate-account/(:all)', \Medians\Users\Application\UserController::class.'@activate_account');

/**
* Restricted access requests 
*/
if(isset($app->auth()->id))
{

    Macaw::get('/json/dashboard', \Medians\DashboardController::class.'@json'); 
    Macaw::get('/dashboard', \Medians\DashboardController::class.'@index'); 
    Macaw::get('/get-started', \Medians\Users\Application\UserController::class.'@get_started'); 
    Macaw::get('/get_started', \Medians\Users\Application\UserController::class.'@get_started'); 



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



    /**
    * @return devices
    */
    Macaw::get('/devices/manage', \Medians\Devices\Application\DeviceController::class.'@manage');
    Macaw::get('/devices/orders', \Medians\Devices\Application\DeviceController::class.'@orders');
    Macaw::get('/devices_orders', \Medians\Devices\Application\DeviceController::class.'@orders');
    Macaw::get('/devices/index', \Medians\Devices\Application\DeviceController::class.'@index');
    Macaw::get('/devices/calendar', \Medians\Devices\Application\CalendarController::class.'@index');
    Macaw::get('/calendar', \Medians\Devices\Application\CalendarController::class.'@index');

    Macaw::get('/devices/categories', function ()  {
        try 
        {
            return (new \Medians\Categories\Application\CategoryController)->index('Medians\Devices\Domain\Device');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });
    Macaw::get('/categories/edit/(:num)', \Medians\Categories\Application\CategoryController::class.'@edit');



    /**
    * @return Games
    */
    Macaw::get('/games/index', \Medians\Games\Application\GameController::class.'@index');
    Macaw::get('/games', \Medians\Games\Application\GameController::class.'@index');

    /**
    * @return Discounts
    */
    Macaw::get('/discounts/index', \Medians\Games\Application\GameController::class.'@index');
    Macaw::get('/discounts', \Medians\Games\Application\GameController::class.'@index');


    /**
    * @return Products
    */
    Macaw::get('/products/stock_alert', \Medians\Products\Application\ProductController::class.'@stock_alert');
    Macaw::get('/products/stock_out', \Medians\Products\Application\ProductController::class.'@stock_out');
    Macaw::get('/products/orders', \Medians\Products\Application\ProductController::class.'@orders');
    Macaw::get('/products/index', \Medians\Products\Application\ProductController::class.'@index');
    Macaw::get('/products', \Medians\Products\Application\ProductController::class.'@index');
    Macaw::get('/products/categories', function ()  {
        return (new \Medians\Categories\Application\CategoryController())->index('Medians\Products\Domain\Product');
    });


    /**
    * @return Stock
    */
    Macaw::get('/stock/index', \Medians\Products\Application\StockController::class.'@index');
    Macaw::get('/stock', \Medians\Products\Application\StockController::class.'@index');

    /**
    * @return Payments
    */
    Macaw::get('/expenses/index', \Medians\Expenses\Application\ExpenseController::class.'@index');
    Macaw::get('/expenses', \Medians\Expenses\Application\ExpenseController::class.'@index');

    /**
    * @return Orders
    */
    Macaw::get('/orders/index', \Medians\Orders\Application\OrderController::class.'@index');
    Macaw::get('/invoices/show/(:all)', \Medians\Orders\Application\OrderController::class.'@show');
    Macaw::get('/invoices', \Medians\Orders\Application\OrderController::class.'@index');
    Macaw::get('/orders', \Medians\Orders\Application\OrderController::class.'@index');


    /**
    * @return Settings request
    */
    Macaw::get('/settings', \Medians\Settings\Application\SettingsController::class.'@index');



    /**
    * @return Users
    */
    Macaw::get('/users/index', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/users/', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/users', \Medians\Users\Application\UserController::class.'@index');
    Macaw::get('/index_users', \Medians\Users\Application\UserController::class.'@index_users');

    /**
    * @return customers
    */
    Macaw::get('/customers/index', \Medians\Customers\Application\CustomerController::class.'@index');
    Macaw::get('/customers/', \Medians\Customers\Application\CustomerController::class.'@index');
    Macaw::get('/customers', \Medians\Customers\Application\CustomerController::class.'@index');


    /**
    * @return Branches
    */
    Macaw::get('/branches/index', \Medians\Branches\Application\BranchController::class.'@index');
    Macaw::get('/branches', \Medians\Branches\Application\BranchController::class.'@index');


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
    Macaw::get('/system_settings', \Medians\Settings\Application\SystemSettingsController::class.'@index');


    /**
    * @return Content editor
    */
    Macaw::get('/admin/editor', \Medians\Pages\Application\PageController::class.'@editor');
    Macaw::post('/admin/update_section_content', \Medians\Pages\Application\PageController::class.'@updateContent');

    /**
    * @return Plans
    */
    Macaw::get('/plans/index', \Medians\Plans\Application\PlanController::class.'@index');
    Macaw::get('/plans', \Medians\Plans\Application\PlanController::class.'@index');
    Macaw::get('/plan_features/index', \Medians\Plans\Application\PlanFeatureController::class.'@index');
    Macaw::get('/plan_features', \Medians\Plans\Application\PlanFeatureController::class.'@index');



}


/*
// Return list of device 
*/

return $app->run();


    