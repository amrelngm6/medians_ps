<?php 
  $db = mysqli_connect("localhost", "root", "root", "ps_test"); 
  if (mysqli_connect_errno()) { 
     printf("Connect failed: %s\n", mysqli_connect_error()); 
     exit();
  } 
  $query = file_get_contents("db.sql"); 
  // if (mysqli_multi_query($db, $query)) 
  //    echo "Success"; 
  // else
  //    echo "Fail";
