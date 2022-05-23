<?php

require '../../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));


// loading class
include("../../class/Database.php");
include("../../class/Plugins.php");


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);

require "config.php";

$plugins->plugin_name = $plugin_name;
$plugins->description=$description;
$op = filter_input(INPUT_GET,"op");

if($op=="del"){

    $plugins->plugin_name=$plugin_name;

    $name = ucfirst($plugin_name);

    if($plugins->delete()){
        
        /////////////////////////////////////////////////////////////////
        // RIMOZIONE DA TABELLA DELLA SIDEBAR E DELL'INDEX
        /////////////////////////////////////////////////////////////////


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

    } else if($op=="add"){

        if($plugins->create()){
            // CLASS
            if(copy('class/'.$plugin_name.'.php', '../../class/'.$plugin_name.'.php')){
                chmod('../../class/'.$plugin_name.'.php',0777);
            }else{
                print_r("ko_class");
                exit;
            }

            // ALL
            if(copy('all/all'.$plugin_name.'.php', '../../inc/func/all'.$plugin_name.'.php')){
                chmod('../../inc/func/all'.$plugin_name.'.php',0777);
            }else{
                print_r("ko_all");
                exit;
            }

            // ALL
            if(copy('reg/reg'.$plugin_name.'.php', '../../inc/func/reg'.$plugin_name.'.php')){
                chmod('../../inc/func/reg'.$plugin_name.'.php',0777);
            }else{
                print_r("ko_reg");
                exit;
            }

            // MNG
            if(copy('mng/mng'.$plugin_name.'.php', '../../core/mng'.$plugin_name.'.php')){
                chmod('../../core/mng'.$plugin_name.'.php',0777);
            }else{
                print_r("ko_mng");
                exit;
            }

            // LOCAL

            unlink("../../inc/class_initialize.php");
            header("Location: ../../index.php?man=plugins&op=show&msg=pluginSucc");
            exit;

        }else{
            print_r("ko");
            exit;
        }
    }

