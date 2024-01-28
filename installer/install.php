<?php

error_reporting(0);

$db = mysqli_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']); 

if (mysqli_connect_errno()) { 
    echo json_encode(['error'=>'Database Connection failed']);
    return true;
} 

$installStatus = '';

if ($_POST['step'] == 2)
{


  /** 
   * This below comment 
   * Remove all tables 
   * to start new installation
   */  

  $query = file_get_contents("./db.sql"); 

  if (mysqli_multi_query($db, $query)) 
      $installStatus =  "Success"; 
  else
      $installStatus =  json_encode(['error'=>'Can not install database']); 
}

if ($_POST['step'] == 3)
{
    $name = $_POST['user']['name'];
    $email = $_POST['user']['email'];
    $pass = sha1(md5($_POST['user']['password']));
    $sql = "
        INSERT INTO `users` ( `id`,  `first_name`, `password`, `email`, `role_id`, `active`)  VALUES (1, '$name', '$pass', '$email',1,1)
    ";

    if ($db->query($sql) === TRUE) {
        $installStatus = "Success";
    } else {
        $installStatus = $db->error . $installStatus;
    }
    
    replace_string_in_file();
}


echo json_encode(($installStatus == "Success") ? ['success' => $installStatus] : ['error'=> $installStatus]);


function replace_string_in_file(){
    $content=file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/app/config/database.php.file');
    $content_chunks=str_replace(['__db_host','__db_name', '__db_user', '__db_password'],
     [$_POST['db_host'], $_POST['db_name'], $_POST['db_user'], $_POST['db_password']], $content);
    file_put_contents('../app/config/database.php', $content_chunks);
}