<?php

// require '../vendor/autoload.php';		// If installed via composer
// $debug = new \bdk\Debug(array(
// 	'collect' => true,
// 	'output' => true,
// ));

    ##############    Mini Cms    ##############
    #                                          #
    #           A project by DM WebLab         #
    #   Website: https://www.dmweblab.com      #
    #   GitHub: https://github.com/damares86   #
    #                                          #
    ############################################


if(session_status() == PHP_SESSION_ACTIVE){
  session_destroy();
 }
 
 if(is_file("../class/Database.php")){
 
 include ("../class/Database.php");
 $database=new Database();
 $db = $database->getConnection();

 $prx="";
 if(is_file("prefix.php")){
  require "prefix.php";
  $prx=$prefix;
 }

 
 $query = "DROP TABLE `".$prx."accounts`, `".$prx."color`, `".$prx."contacts`, `".$prx."default_page`, `".$prx."files`, `".$prx."menu`,`".$prx."page`, `".$prx."password_reset_temp`, `".$prx."plugins`, `".$prx."roles`, `".$prx."settings`, `".$prx."verify`, `".$prx."view_home`";

 
 $stmt = $database->conn->prepare($query);
 
 $stmt->execute();
 }

$dir="../../uploads/";

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

$dir="../../misc/";

rmdir_recursive($dir);

$page_arr=array("contact","index","login");

foreach (glob("../../*.php") as $row){
    $file = pathinfo($row);
    $filename = $file['filename'];
  if(!in_array($filename,$page_arr)){
    unlink($row);
  }
}

foreach (glob("../inc/pages/*") as $row){
  unlink($row);
}

rmdir("../inc/pages");

unlink("../class/Database.php");
unlink("site.php");
if(is_file("prefix.php")){
  unlink("prefix.php");
 }
unlink("../inc/class_initialize.php");


header("Location: ../../");
exit;