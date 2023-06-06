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
  // $db->query('DROP TABLE `branches`, `branch_users`, `categories`, `custom_fields`, `devices`, `discounts`, `games`, `orders`, `order_devices`, `order_device_items`, `order_items`, `payments`, `prices`, `products`, `roles`,`settings`,`stock`, `users`');

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
  INSERT INTO `users`  
  (`id`,`first_name`, `email`, `password`, `role_id`, `active`)
  VALUES 
  (1,'$name', '$email', '$pass', 1, 1)
  "; 

  if ($db->query($sql) === TRUE) {
      $installStatus = "Success";
  } else {
      $installStatus = $db->error . $installStatus;
  }

  $branch_name = $_POST['branch']['name'];
  
  $sql_settings = "
  INSERT INTO  `settings` 
  (`id`, `code`, `value`, `branch_id`) VALUES  (1, 'sitename', '$branch_name', 1) ";

  $sql_roles = "
  INSERT INTO `roles` (`id`, `name`) VALUES
  (1, 'Master'),
  (3, 'Administrator');
  ";

  $sql_plans = "
  INSERT INTO `plans` (`id`, `name`, `paid`, `monthly_cost`, `yearly_cost`, `created_by`) VALUES
  (1, 'Free Plan', 0, 0, 0, 1),
  (2, 'Business Plan', 1, 5, 50, 1);
  ";

  $sql_plan_features = "
  INSERT INTO `plan_features` (`id`, `plan_id`, `code`, `access`, `created_by`) VALUES
  (1, 1, 'devices_count', 5, 1),
  (2, 2, 'devices_count', 100, 1),
  (4, 1, 'products_count', 10, 1),
  (5, 2, 'products_count', -1, 1),
  (7, 1, 'games_count', 2, 1),
  (8, 2, 'games_count', 4, 1)

  ";

  try {
    
    if (
      $db->query($sql_settings) === TRUE && 
      $db->query($sql_roles) === TRUE && 
      $db->query($sql_plans) === TRUE && 
      $db->query($sql_plan_features) === TRUE
    ) {
        $installStatus = "Success";
        replace_string_in_file();

    } else {
        $installStatus = $db->error . $installStatus;
    }
    
  } catch (\Exception $e) {
      $installStatus = $e->getMessage();
  }
}


echo json_encode(($installStatus == "Success") ? ['success' => $installStatus] : ['error'=> $installStatus]);


function replace_string_in_file(){
    $content=file_get_contents('../app/config/database.php.file');
    $content_chunks=str_replace(['__db_host','__db_name', '__db_user', '__db_password'],
     [$_POST['db_host'], $_POST['db_name'], $_POST['db_user'], $_POST['db_password']], $content);
    file_put_contents('../app/config/database.php', $content_chunks);

    rmdir($_SERVER['DOCUMENT_ROOT'].'/installer');
}