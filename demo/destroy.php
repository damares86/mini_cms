<?php

require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));

if(session_status() == PHP_SESSION_ACTIVE){
 session_destroy();
}

if(is_file("admin/class/Database.php")){

include ("admin/class/Database.php");
$database=new Database();
$db = $database->getConnection();

$query = "DROP TABLE `t_accounts`, `t_categories`, `t_color`, `t_files`, `t_menu`, `t_page`, `t_post`, `t_roles`, `t_settings`";
        
$stmt = $database->conn->prepare($query);

$stmt->execute();


unlink("admin/class/Database.php");
}

header("Location: index.php");
exit;
