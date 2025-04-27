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
RouteHandler::get('/en/assets', \Medians\Media\Application\MediaController::class.'@assets'); 

/**
 * Streaming multi-media types
 */
RouteHandler::get('/en/stream', \Medians\Media\Application\MediaController::class.'@stream'); 


/** @return send_message */
RouteHandler::post('/en/send_message', Medians\Help\Application\HelpMessageController::class.'@store');
RouteHandler::get('/en/online-consultation/(:num)', \Medians\OnlineConsultations\Application\OnlineConsultationController::class.'@page');
RouteHandler::get('/en/doctors', \Medians\Doctors\Application\DoctorController::class.'@list'); 
RouteHandler::get('/en/doctors/', \Medians\Doctors\Application\DoctorController::class.'@list'); 
RouteHandler::get('/en/doctor_booking/(:all)', \Medians\Bookings\Application\BookingController::class.'@doctor_booking'); 
RouteHandler::get('/en/book/(:all)', \Medians\Bookings\Application\BookingController::class.'@page'); 
RouteHandler::get('/en/bookings/(:all)', \Medians\Bookings\Application\BookingController::class.'@page'); 
RouteHandler::post('/en/submit/(:all)', \Medians\FrontendController::class.'@form_submit'); 
RouteHandler::post('/en/submit_forum_comment', \Medians\FrontendController::class.'@storeCustomerComment'); 

RouteHandler::post('/en/forum_store', \Medians\Forum\Application\ForumController::class.'@saveNew'); 

RouteHandler::get('/en/blog', \Medians\Blog\Application\BlogController::class.'@list'); 
RouteHandler::get('/en/blog/', \Medians\Blog\Application\BlogController::class.'@list'); 
RouteHandler::get('/en/offer_booking/(:all)', \Medians\Offers\Application\OfferController::class.'@page'); 
RouteHandler::get('/en/search', \Medians\Pages\Application\PageController::class.'@search'); 
RouteHandler::get('/en/search/', \Medians\Pages\Application\PageController::class.'@search'); 
RouteHandler::get('/en/technologies', \Medians\Technologies\Application\TechnologyController::class.'@list'); 
RouteHandler::get('/en/technologies/(:all)', \Medians\Technologies\Application\TechnologyController::class.'@item'); 
RouteHandler::get('/en/booking_confirm/booking', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/en/booking_confirm/online_consultation', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/en/booking_confirm/offers', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
RouteHandler::get('/en/booking_confirm/contact', \Medians\Bookings\Application\BookingController::class.'@thanks_page'); 
// RouteHandler::get('/calculator', \Medians\Pages\Application\PageController::class.'@calculator'); 
// RouteHandler::get('/ovulation-calculator', \Medians\Pages\Application\PageController::class.'@ovulationCalculator'); 
RouteHandler::get('/en/forum', \Medians\Forum\Application\ForumController::class.'@list'); 
RouteHandler::get('/en/forum-post/(:all)', \Medians\Forum\Application\ForumController::class.'@page'); 
RouteHandler::get('/en/new-forum-post', \Medians\Forum\Application\ForumController::class.'@forum_post_form'); 


// Front API GET requests
RouteHandler::post('/en/front_api', \Medians\FrontAPIController::class.'@handle');
RouteHandler::post('/en/front_api/create', \Medians\FrontAPIController::class.'@create');
RouteHandler::post('/en/front_api/update', \Medians\FrontAPIController::class.'@update');
RouteHandler::post('/en/front_api/delete', \Medians\FrontAPIController::class.'@delete');


/**
 * Switch the language 
 */ 
RouteHandler::get('/en/switch-lang/(:all)', \Medians\DashboardController::class.'@switchLang');

/**
 * Authentication
 */
RouteHandler::get('/en', \Medians\Pages\Application\PageController::class.'@homepage');
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
// RouteHandler::get('/cart', \Medians\Cart\Application\CartController::class.'@cart');
// RouteHandler::get('/wishlist', \Medians\Cart\Application\WishlistController::class.'@wishlist');
// RouteHandler::get('/compare', \Medians\Cart\Application\CompareController::class.'@compare');
// RouteHandler::get('/checkout', \Medians\Cart\Application\CartController::class.'@checkout');
// RouteHandler::get('/invoice/(:all)', \Medians\Invoices\Application\InvoiceController::class.'@invoicePage');
// RouteHandler::get('/create-payment-intent', \Medians\Transactions\Application\TransactionController::class.'@createPaymentIntent');
// RouteHandler::post('/cart/delete', \Medians\Cart\Application\CartController::class.'@delete');
// RouteHandler::post('/cart/update', \Medians\Cart\Application\CartController::class.'@update');

// RouteHandler::get('/customer/login', \Medians\Auth\Application\CustomerAuthService::class.'@loginPage');
// RouteHandler::get('/customer/signup', \Medians\Auth\Application\CustomerAuthService::class.'@signupPage');
// RouteHandler::get('/customer/confirm_account', \Medians\Auth\Application\CustomerAuthService::class.'@otp');
// RouteHandler::get('/customer/dashboard', \Medians\Customers\Application\CustomerController::class.'@dashboard');
// RouteHandler::get('/order/(:all)', \Medians\Orders\Application\OrderController::class.'@orderPage');


// POST Requests
RouteHandler::post('/dashboard/login', \Medians\Auth\Application\AuthService::class.'@userLogin');
// RouteHandler::post('/reset-password', \Medians\Auth\Application\AuthService::class.'@userResetPassword');
// RouteHandler::post('/reset-password-code', \Medians\Auth\Application\AuthService::class.'@resetChangePassword');
// RouteHandler::post('/customer/signup', \Medians\Auth\Application\CustomerAuthService::class.'@userSignup');
// RouteHandler::post('/customer/login', \Medians\Auth\Application\CustomerAuthService::class.'@userLogin');
// RouteHandler::post('/customer/confirm', \Medians\Auth\Application\CustomerAuthService::class.'@checkOTP');
// RouteHandler::post('/customer/reset-password', \Medians\Auth\Application\CustomerAuthService::class.'@userResetPassword');
// RouteHandler::post('/customer/reset-password-code', \Medians\Auth\Application\CustomerAuthService::class.'@resetChangePassword');


/**
 * Load sub-pages
 */
RouteHandler::get('/en/(:all)/(:all)', \Medians\Pages\Application\PageController::class.'@sub_page'); 
RouteHandler::get('/en/(:all)/', \Medians\Pages\Application\PageController::class.'@page'); 
RouteHandler::get('/en/(:all)', \Medians\Pages\Application\PageController::class.'@page'); 


return $app->run();


    