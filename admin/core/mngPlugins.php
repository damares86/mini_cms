<?php

require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));


// loading class
include("../class/Database.php");
include("../class/Plugins.php");


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);

$op=filter_input(INPUT_GET,"op");

$plugin_name=filter_input(INPUT_GET,"name");

        
  if($op=="enable"||$op=="disable"){
        $plugins->plugin_name=$plugin_name;
        $plugins->active="0";
        if($op=="enable"){
            $plugins->active=1;
        }else if($op=="disable"){
            $plugins->active=0;
        }
        
        if($plugins->updateActive()){
            header("Location: ../index.php?man=plugins&op=show&msg=pluginStatSucc");
            exit;
        }else{
            header("Location: ../index.php?man=plugins&op=show&msg=pluginStatErr");
            exit;   
        }


    }
        





?>