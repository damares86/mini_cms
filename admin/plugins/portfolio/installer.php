<?php

require '../../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));


// loading class
include("../../class/Database.php");
include("../../class/Plugins.php");
include("../../class/Page.php");


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);
$page = new Page($db);

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
        $error=0;

        // DELETE CLASS
        if(is_file("../../class/Portfolio.php")){
            if(!unlink("../../class/Portfolio.php")){
                $error++;
            }
        }

        // DELETE MNG
        if(is_file("../../core/mngPortfolio.php")){
            if(!unlink("../../core/mngPortfolio.php")){
                $error++;
            }
        }

        // DELETE MNG CAT
        if(is_file("../../core/mngCatPortfolio.php")){
            if(!unlink("../../core/mngCatPortfolio.php")){
                $error++;
            }
        }

        // DELETE ALL
        if(is_file("../../inc/func/allPortfolio.php")){
            if(!unlink("../../inc/func/allPortfolio.php")){
                $error++;
            }
        }


        // DELETE REG
        if(is_file("../../inc/func/regPortfolio.php")){
            if(!unlink("../../inc/func/regPortfolio.php")){
                $error++;
            }
        }


        // DELETE TEMPLATE
        if(is_file("../../template/project.php")){
            if(!unlink("../../template/project.php")){
                $error++;
            }
        }

       // DELETE REG CAT
        if(is_file("../../inc/func/regCatPortfolio.php")){
            if(!unlink("../../inc/func/regCatPortfolio.php")){
                $error++;
            }
        }

        // DELETE ALL
        if(is_file("../../inc/func/allCatPortfolio.php")){
            if(!unlink("../../inc/func/allCatPortfolio.php")){
                $error++;
            }
        }

        // DELETE DEFAULT PAGE
        if(is_file("../../../portfolio.php")){
            if($plugins->deletePage())
                if(!unlink("../../../portfolio.php")){
                    $error++;
                }
            }else{
                $error++;
            }
            
            unlink("../../inc/class_initialize.php");
            if($error==0){
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginDelSucc");
                exit;
            }else{
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginDelErr");
                exit;
            }

            } else{
                // header KO
        }

    } else if($op=="add"){

        if($plugins->create()){
            
            $error=0;

            // CLASS
            if(copy('class/Portfolio.php', '../../class/Portfolio.php')){
                chmod('../../class/'.$plugin_name.'.php',0777);
            }else{
                $error++;
            }

            // ALL
            if(copy('all/allPortfolio.php', '../../inc/func/allPortfolio.php')){
                chmod('../../inc/func/allPortfolio.php',0777);
            }else{
                $error++;
            }

            // ALL
            if(copy('reg/regPortfolio.php', '../../inc/func/regPortfolio.php')){
                chmod('../../inc/func/regPortfolio.php',0777);
            }else{
                $error++;
            }

            // MNG
            if(copy('mng/mngPortfolio.php', '../../core/mngPortfolio.php')){
                chmod('../../core/mngPortfolio.php',0777);
            }else{
                $error++;
            }


            // MNG CAT
            if(copy('mng/mngCatPortfolio.php', '../../core/mngCatPortfolio.php')){
                chmod('../../core/mngCatPortfolio.php',0777);
            }else{
                $error++;
            }

            // PAGE
            if(copy('page/portfolio.php', '../../../portfolio.php')){
                chmod('../../../portfolio.php',0777);
            }else{
                $error++;
            }


            // TEMPLATE
            if(copy('template/project.php', '../../template/project.php')){
                chmod('../../template/project.php',0777);
            }else{
                $error++;
            }

            // REG CAT
            if(copy('reg/regCatPortfolio.php', '../../inc/func/regCatPortfolio.php')){
                chmod('./../inc/func/regCatPortfolio.php',0777);
                }else{
                    $error++;
                }

            // ALL CAT
            if(copy('all/allCatPortfolio.php', '../../inc/func/allCatPortfolio.php')){
                chmod('./../inc/func/allCatPortfolio.php',0777);
                }else{
                    $error++;
                }
    
    

            // LOCAL

            unlink("../../inc/class_initialize.php");
            if($error==0){
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginSucc");
                exit;
            }else{
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginErr");
                exit;
            }

        }else{
            print_r("ko");
            exit;
        }
    }

