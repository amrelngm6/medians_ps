<?php

$app = $_GET['app'];

if ($app == 'driver')
{
    error_log(json_encode($_SERVER));
    return  header("Location: ./driver.apk");
}

if ( $app == 'parent')
{
    error_log(json_encode($_SERVER));
    return  header("Location: ./parent.apk");
}

    header("Location: ./page404");