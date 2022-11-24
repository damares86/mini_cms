<?php

// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

// $dir="../../uploads/";

if(session_status() == PHP_SESSION_ACTIVE){
  session_destroy();
 }
 
 if(is_file("../class/Database.php")){
 
 include ("../class/Database.php");
 $database=new Database();
 $db = $database->getConnection();
 
 $query = "DROP TABLE `accounts`, `color`, `contacts`, `default_page`, `files`, `menu`,`page`, `password_reset_temp`, `plugins`, `roles`, `settings`, `time`, `verify`, `view_home`";
     
 $stmt = $database->conn->prepare($query);
 
 $stmt->execute();
 }
$dir="../../misc/";

if(is_dir($dir)){
  function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
      if ('.' === $file || '..' === $file) continue;
      if (is_dir($dir.'/'.$file)) rmdir_recursive($dir.'/'.$file);
      else unlink($dir.'/'.$file);
    }
    rmdir($dir);
  }
}


// rmdir_recursive($dir);

$page_arr=array("catechismo","contact","index","login","blog","post","oratorio","parrocchia","storia_della_chiesa");

foreach (glob("../../*.php") as $row){
    $file = pathinfo($row);
    $filename = $file['filename'];
  if(!in_array($filename,$page_arr)){
    unlink($row);
  }
}

$json_arr=array("catechismo","contact","index","oratorio","parrocchia","storia_della_chiesa");

foreach (glob("../inc/pages/*.json") as $row){
  $file = pathinfo($row);
  $filename = $file['filename'];
  if(!in_array($filename,$json_arr)){
    unlink($row);
  }
}


unlink("../class/Database.php");

unlink("../inc/class_initialize.php");


header("Location: ../../");
exit;