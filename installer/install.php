<?php

error_reporting(E_ALL);

try {
    $db = mysqli_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']); 
    
} catch (\Throwable $th) {
    echo json_encode(['error'=>'Database Connection failed']);
    return true;
}


$installStatus = '';

if ($_POST['step'] == 1)
{

    try {
                
        $query = file_get_contents("./db.sql"); 

        if (mysqli_multi_query($db, $query)) 
            echo   "Success"; 
        else
            echo  json_encode(['error'=>'Can not install database']); 
                
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    return null;
}

if ($_POST['step'] == 2)
{
    $user = $_POST['user'];

    if (empty($user['email'])) {
        echo json_encode(['error'=>'Email is required']);
        return ;
    }
    if (empty($user['name'])) {
        echo json_encode(['error'=>'Name is required']);
        return ;
    }
    if (empty($user['password']) || strlen($user['password']) < 5) {
        echo json_encode(['error'=>'Password is required at least 5 characters']);
        return ;
    }

    $name = $user['name'];
    $email = $user['email'];
    $pass = sha1(md5($user['password']));
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