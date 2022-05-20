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

if($op=="del"){

    $plugins->plugin_name=$plugin_name;

    $name = ucfirst($plugin_name);

    if($plugins->delete()){
        
        // DELETE CLASS
        if(is_file("../class/$name.php")){
            if(unlink("../class/$name.php")){
                // ok
            }else{
                // ko
            }
        }

        // DELETE MNG
        if(is_file("mng$name.php")){
            if(unlink("mng$name.php")){
                // ok
            }else{
                // ko
            }
        }

        // DELETE ALL
        if(is_file("../inc/func/all$name.php")){
            if(unlink("../inc/func/all$name.php")){
                // ok
            }else{
                // ko
            }
        }


        // DELETE REG
        if(is_file("../inc/func/reg$name.php")){
            if(unlink("../inc/func/reg$name.php")){
                // ok
            }else{
                // ko
            }
        }


        // DELETE TEMPLATE
        if(is_file("../template/$name.php")){
            if(unlink("../template/$name.php")){
                // ok
            }else{
                // ko
            }
        }


        // DELETE DEFAULT PAGE
        if(is_file("../../$name.php")){
            if($plugins->deletePage())
                if(unlink("../../$name.php")){
                    // ok
                }else{
                    // ko
                }
            }else{
                //pagina non cancellata dal db
            }
            
            unlink("../inc/class_initialize.php");
            header("Location: ../index.php?man=plugins&op=show&msg=pluginSucc");
            exit;

            } else{
                // header KO
        }

        
    } else if($op=="enable"||$op=="disable"){
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