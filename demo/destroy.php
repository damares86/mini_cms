<?php

require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));

if(session_status() == PHP_SESSION_ACTIVE){
 session_destroy();
}


include ("admin/class/Database.php");
$database=new Database();
$db = $database->getConnection();

// $query = "DROP TABLE t_accounts, t_categories, t_color, t_files, t_menu, t_page, t_post, t_roles, t_settings";
$query = "DROP TABLE `t_accounts`, `t_categories`, `t_color`, `t_files`, `t_menu`, `t_page`, `t_post`, `t_roles`, `t_settings`";
        
$stmt = $database->conn->prepare($query);

if($stmt->execute()){
    // print_r("db ok");
    // exit;
}else{
    // print_r("db ko");
    // exit;
}


if(unlink("admin/class/Database.php")){
    // print_r("file ok");
    // exit;
}else{
    // print_r("file ko");
    // exit;
}

header("Location: index.php");
exit;
