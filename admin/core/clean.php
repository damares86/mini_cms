<?php

// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

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

$page_arr=array("contact.php","index.php","login.php");

foreach (glob("../../*.php") as $row){
  if(!in_array($row,$page_arr)){
    unlink($row);
  }
}


foreach (glob("../inc/pages/*") as $row){
  unlink($row);
}



unlink("./class/Database.php");
unlink("../core/Site.php");
unlink("../inc/class_initialize.php");


header("Location: ../../");
exit;