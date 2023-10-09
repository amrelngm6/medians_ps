<?php

// error_reporting(0); 
error_reporting(E_ALL); 
session_start(); 
date_default_timezone_set('Africa/Cairo');


// Check if installed or redirect to installation 
file_exists(__DIR__.'/app/config/database.php') 
    ?  require_once __DIR__.'/app/config/database.php' 
    : header('Location: ./installer/index.php');

require_once __DIR__.'/vendor/autoload.php';

function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    // Radius of the Earth in kilometers
    $radius = 6371;

    // Convert latitude and longitude from degrees to radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Haversine formula
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Calculate the distance
    $distance = $radius * $c;

    return $distance;
}

// Example usage
$lat1 = 30.0211563; // Latitude of location 1
$lon1 = 31.1854662; // Longitude of location 1

$lat2 = 30.012948; // Latitude of location 2
$lon2 = 31.123689;  // Longitude of location 2

$distance = calculateDistance($lat1, $lon1, $lat2, $lon2);
echo "Distance between the two locations: " . number_format($distance, 2) . " km";

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



include('app/helper/methods.php');
include('app/config/route.php');
$capsule->getConnection()->disconnect();



