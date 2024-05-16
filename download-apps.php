<?php

$app = $_GET['app'];

if ($app == 'driver')
{
    error_log('Driver : '.$_SERVER['REMOTE_ADDR'].' || '.$_SERVER['HTTP_USER_AGENT'] .' || '. $_SERVER['HTTP_COOKIE']);
    return  header("Location: ./driver.apk");
}

if ( $app == 'parent')
{
    error_log('Parent : '.$_SERVER['REMOTE_ADDR'].' || '.$_SERVER['HTTP_USER_AGENT'] .' || '. $_SERVER['HTTP_COOKIE']);
    return  header("Location: ./parent.apk");
}

    header("Location: ./page404");