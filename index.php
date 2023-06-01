<?php

session_start(); error_reporting(E_ALL & ~E_DEPRECATED); date_default_timezone_set('Africa/Cairo');


// Check if installed or redirect to installation 
file_exists(__DIR__.'/app/config/database.php') 
    ?  require_once __DIR__.'/app/config/database.php' 
    : header('Location: ./installer/index.php');

require_once __DIR__.'/vendor/autoload.php';


/**
 * Load all System Models
 * The base folder is /app folder
 * Any Object caould be accesses through its namespace
 * All Objects inside that folder would be called
 */ 
spl_autoload_register(function ($name) {
    $name2 = str_replace('\\', '/', __DIR__.'/app/'.$name.'.php');
    is_file($name2) ? include ($name2) : '';
});

/**
 * Set the database connection using 
 * @var Illuminate\Database\Capsule\Manager 
 * library for all models
 */ 
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => db_host,
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
include('app/config/route.php');



