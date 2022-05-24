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


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);
$home = new Home($db);

$op=filter_input(INPUT_GET,"op");

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
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginEnSucc");
                        exit;
                    }else{
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginEnErr");
                        exit;
                    }
            } else{
                header("Location: ../index.php?man=plugins&op=show&msg=pluginEnErr");
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
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginDisSucc");
                        exit;
                    } else{
                        header("Location: ../index.php?man=plugins&op=show&msg=pluginDisErr");
                        exit;
                    }
                }
            }
        }
    }
            





?>