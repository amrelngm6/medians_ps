<?php

// session_start(); error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start(); error_reporting(E_ALL);
date_default_timezone_set('Africa/Cairo');

require_once __DIR__.'/app/config/database.php';
require_once __DIR__.'/vendor/autoload.php';

spl_autoload_register(function ($name) {

    // $name = $name;
//  is_file(getcwd().'/app/'.$name.'.php') ? include (getcwd().'/app/'.$name.'.php') : '';
        $name2 = str_replace('\\', '/', __DIR__.'/app/'.$name.'.php');
    is_file($name2) ? include ($name2) : '';

});

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseManager;


use Shared\dbaser;
use Medians\Users\Infrastructure\UserRepository;
use Medians\Customers\Infrastructure\CustomerRepository;
// use Medians\Infrastructure\Providers\ProviderRepository;

$request = Request::createFromGlobals();

    
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => db_name,
    'username' => db_username,
    'password' => db_password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();


include('app/helper/methods.php');
// include('app/controller.php');
include('app/config/route.php');



