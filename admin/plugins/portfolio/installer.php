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
        if(is_file("../../../portfolio.php")){
            if($plugins->deletePage())
                if(unlink("../../../portfolio.php")){
                    // ok
                }else{
                    // ko
                }
            }else{
                //pagina non cancellata dal db
            }
            
            unlink("../inc/class_initialize.php");
            header("Location: ../../index.php?man=plugins&op=show&msg=pluginSucc");
            exit;

            } else{
                // header KO
        }

    } else if($op=="add"){

        if($plugins->create()){
            // CLASS
            if(copy('class/Portfolio.php', '../../class/Portfolio.php')){
                chmod('../../class/'.$plugin_name.'.php',0777);
            }else{
                print_r("ko_class");
                exit;
            }

            // ALL
            if(copy('all/allPortfolio.php', '../../inc/func/allPortfolio.php')){
                chmod('../../inc/func/allPortfolio.php',0777);
            }else{
                print_r("ko_all");
                exit;
            }

            // ALL
            if(copy('reg/regPortfolio.php', '../../inc/func/regPortfolio.php')){
                chmod('../../inc/func/regPortfolio.php',0777);
            }else{
                print_r("ko_reg");
                exit;
            }

            // MNG
            if(copy('mng/mngPortfolio.php', '../../core/mngPortfolio.php')){
                chmod('../../core/mngPortfolio.php',0777);
            }else{
                print_r("ko_mng");
                exit;
            }

            // MNG
            if(copy('page/portfolio.php', '../../../portfolio.php')){
            chmod('../../../portfolio.php',0777);
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

