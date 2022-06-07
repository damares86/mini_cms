<?php

require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));


// loading class
include("../class/Database.php");
include("../class/Plugins.php");
include("../class/Home.php");
include("../class/Menu.php");


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);
$home = new Home($db);
$menu = new Menu($db);

$op=filter_input(INPUT_GET,"op");


if(filter_input(INPUT_GET,"name")){
    $plugin_name=filter_input(INPUT_GET,"name");
    $name=strtolower($plugin_name);
    require "../plugins/$name/config.php";
    
    $plugins->plugin_name=$plugin_name;
  if($op=="enable"){
        $plugins->active=1;
        if($plugins->updateActive()){   
            $home->name_function=$name;

            if($home->create()){
                if($second_page){
                    $home->name_function=$second_page;
                    if($home->create()){
                        $menu->pagename=$plugin_name;
                        
                        if($menu->insert()){
                            header("Location: ../index.php?man=plugins&op=show&msg=pluginEnSucc");
                            exit;
                        }else{
                            header("Location: ../index.php?man=plugins&op=show&msg=pluginEnErr1");
                            exit;
                        }
                    }else{
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginEnErr2");
                        exit;
                    }
            } else{
                header("Location: ../index.php?man=plugins&op=show&msg=pluginEnErr3");
                exit;
            }
        }
    }
    }else if($op="disable"){
        $plugins->active=0;
        if($plugins->updateActive()){     
            $home->name_function=$name;


            if($home->delete()){
                if($second_page){
                    $home->name_function=$second_page;
                    if($home->delete()){
                        $menu->pagename=$plugin_name;
                        if($menu->delete()){
                            header("Location: ../index.php?man=plugins&op=show&msg=pluginDisSucc");
                            exit;
                        }else{
                            header("Location: ../index.php?man=plugins&op=show&msg=pluginDisErr");
                            exit;
                        }
                    } else{
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginDisErr");
                        exit;
                    }
                }else{
                    header("Location: ../index.php?man=plugins&op=show&msg=pluginDisErr");
                    exit;
                }
            }
        }
    }
}   

if(filter_input(INPUT_POST,"submit")){

    function chmod_R($path, $filemode) {
        if ( !is_dir($path) ) {
         return chmod($path, $filemode);
        }
        $dh = opendir($path);
        while ( $file = readdir($dh) ) {
         if ( $file != '.' && $file != '..' ) {
          $fullpath = $path.'/'.$file;
          if( !is_dir($fullpath) ) {
           if ( !chmod($fullpath, $filemode) ){
            return false;
           }
          } else {
           if ( !chmod_R($fullpath, $filemode) ) {
            return false;
           }
          }
         }
        }
        
        closedir($dh);
        
        if ( chmod($path, $filemode) ) {
         return true;
        } else {
         return false;
        }
       }

    if($_FILES["zip_file"]["name"]) {
        $filename = $_FILES["zip_file"]["name"];
        $source = $_FILES["zip_file"]["tmp_name"];
        $type = $_FILES["zip_file"]["type"];
        
        $name = explode(".", $filename);
        $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
        foreach($accepted_types as $mime_type) {
            if($mime_type == $type) {
                $okay = true;
                break;
            } 
        }
        
        $continue = strtolower($name[1]) == 'zip' ? true : false;
        if(!$continue) {
            header("Location: ../index.php?man=plugins&op=show&msg=pluginUploadFormatErr");
            exit;
        }
    
        $target_path = "../plugins/".$filename;  // change this to the correct site path
        if(move_uploaded_file($source, $target_path)) {
            $zip = new ZipArchive();
            $x = $zip->open($target_path);
            $folder="../plugins/";
            if ($x === true) {
                $zip->extractTo($folder); // change this to the correct site path
                $zip->close();
                
                chmod_R($folder,0777);

                unlink($target_path);
            }
            header("Location: ../index.php?man=plugins&op=show&msg=pluginUploadSucc");
            exit;
        } else {	
            header("Location: ../index.php?man=plugins&op=show&msg=pluginUploadErr");
            exit;
        }
    }


}





?>