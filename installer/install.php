<?php

$db = mysqli_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']); 

if (mysqli_connect_errno()) { 
    printf("Connect failed: %s\n", mysqli_connect_error()); 
    exit();
} 

$query = file_get_contents("./db.sql"); 

if (mysqli_multi_query($db, $query)) 
    $installStatus =  "Success"; 
else
    $installStatus =  "Fail"; 


return ($installStatus == "Success") ? true : false;
