<?php


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


include('app/helper/methods.php');

// (new \Medians\Reports\Application\ReportController)->handleDailyReports();

(new \Medians\Notifications\Application\NotificationController)->handleBookingsNotifications();
(new \config\APP)->capsule->getConnection()->disconnect();

