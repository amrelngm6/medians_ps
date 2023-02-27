<?php 

use \NoahBuscher\Macaw\Macaw;

use Medians\Application as apps;
// use Medians\Application\DashboardController;
use Shared\dbaser;
use Medians\Infrastructure as Repo;
use Medians\Infrastructure\Administrators\AdminRepository;
use Medians\Infrastructure\Users\UserRepository;

$app = new \config\APP;

/**
* Return Dashboard 
*/
if(empty($app->auth()->id))
{
    

/**
 * @return  Login page in case if not authorized 
*/

Macaw::get('/', apps\Auth\AuthService::class.'@loginPage'); 
Macaw::get('/login', apps\Auth\AuthService::class.'@loginPage');
Macaw::post('/login', apps\Auth\AuthService::class.'@userLogin');

} else {


Macaw::get('/dashboard', apps\DashboardController::class.'@index'); 
Macaw::get('/', apps\DashboardController::class.'@index'); 


Macaw::post('/api/create', apps\APIController::class.'@create');
Macaw::post('/api/update', apps\APIController::class.'@update');
Macaw::post('/api/delete', apps\APIController::class.'@delete');
Macaw::post('/api/updateStatus', apps\APIController::class.'@updateStatus');
Macaw::post('/api/checkout', apps\Orders\OrderController::class.'@checkout');
Macaw::post('/api/(:all)', apps\APIController::class.'@handle');
Macaw::post('/api', apps\APIController::class.'@handle');

Macaw::get('/api/calendar', apps\Devices\DeviceController::class.'@calendar');
Macaw::get('/api/calendar_events', apps\Devices\DeviceController::class.'@events');
Macaw::get('/api/(:all)', apps\Devices\DeviceController::class.'@handle');

Macaw::get('/logout', function () 
{
    (new apps\Auth\AuthService)->unsetSession();
    echo (new \config\APP)->redirect('./');
});




Macaw::post('/media-library-api/delete', apps\Media\MediaController::class.'@delete');
Macaw::post('/media-library-api/(:all)', apps\Media\MediaController::class.'@upload');
Macaw::get('/media-library-api/media', apps\Media\MediaController::class.'@media');



/**
* @return devices
*/
Macaw::get('/devices/create', apps\Devices\DeviceController::class.'@create');
Macaw::get('/devices/edit/(:num)', apps\Devices\DeviceController::class.'@edit');
Macaw::get('/devices/device/(:num)', apps\Devices\DeviceController::class.'@edit');
Macaw::get('/devices/manage', apps\Devices\DeviceController::class.'@manage');
Macaw::get('/devices/orders', apps\Devices\DeviceController::class.'@orders');
Macaw::get('/devices/calendar', apps\Devices\DeviceController::class.'@index');
Macaw::get('/devices/calendar2', apps\Devices\DeviceController::class.'@index2');
Macaw::get('/devices/index', apps\Devices\DeviceController::class.'@index');

Macaw::get('/devices/categories', function ()  {
    try 
    {
        return (new apps\Categories\CategoryController)->index('Medians\Domain\Devices\Device');

    } catch (Exception $e) {
        return $e->getMessage();
    }
});
Macaw::get('/categories/edit/(:num)', apps\Categories\CategoryController::class.'@edit');



Macaw::get('/games/edit/(:num)', apps\Games\GameController::class.'@edit');
Macaw::get('/games/index', apps\Games\GameController::class.'@index');
Macaw::get('/games', apps\Games\GameController::class.'@index');


/**
* @return Products
*/
Macaw::get('/products/create', apps\Products\ProductController::class.'@create');
Macaw::get('/products/edit/(:all)', apps\Products\ProductController::class.'@edit');
Macaw::get('/products/stock_alert', apps\Products\ProductController::class.'@stock_alert');
Macaw::get('/products/stock_out', apps\Products\ProductController::class.'@stock_out');
Macaw::get('/products/orders', apps\Products\ProductController::class.'@orders');
Macaw::get('/products/index', apps\Products\ProductController::class.'@index');
Macaw::get('/products/categories', function ()  {
    return (new apps\Categories\CategoryController())->index('Medians\Domain\Products\Product');
});


/**
* @return Stock
*/
Macaw::get('/stock/create', apps\Products\StockController::class.'@create');
Macaw::get('/stock/edit/(:num)', apps\Products\StockController::class.'@edit');
Macaw::get('/stock/index', apps\Products\StockController::class.'@index');

/**
* @return Payments
*/
Macaw::get('/payments/create', apps\Payments\PaymentController::class.'@create');
Macaw::get('/payments/edit/(:num)', apps\Payments\PaymentController::class.'@edit');
Macaw::get('/payments/index', apps\Payments\PaymentController::class.'@index');
Macaw::get('/payments', apps\Payments\PaymentController::class.'@index');

/**
* @return Orders
*/
Macaw::get('/orders/create', apps\Orders\OrderController::class.'@create');
Macaw::get('/orders/edit/(:all)', apps\Orders\OrderController::class.'@edit');
Macaw::get('/orders/show/(:all)', apps\Orders\OrderController::class.'@show');
Macaw::get('/orders/index', apps\Orders\OrderController::class.'@index');


/**
* @return Branches
*/
Macaw::get('/branches/create', apps\Branches\BranchController::class.'@create');
Macaw::get('/branches/edit/(:num)', apps\Branches\BranchController::class.'@edit');
Macaw::get('/branches/show/(:num)', apps\Branches\BranchController::class.'@show');
Macaw::get('/branches/index', apps\Branches\BranchController::class.'@index');

Macaw::get('/settings', apps\Settings\SettingsController::class.'@index');



/**
* @return Branches
*/
Macaw::get('/users/create', apps\Users\UserController::class.'@create');
Macaw::get('/users/edit/(:num)', apps\Users\UserController::class.'@edit');
Macaw::get('/users/show/(:num)', apps\Users\UserController::class.'@show');
Macaw::get('/users/index', apps\Users\UserController::class.'@index');
Macaw::get('/users/', apps\Users\UserController::class.'@index');
Macaw::get('/users', apps\Users\UserController::class.'@index');


return $app->run();
}


/*
// Return list of device 
*/

return $app->run();


    