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
include("../../class/Home.php");


$database = new Database();
$db = $database->getConnection();

$plugins = new Plugins($db);
$page = new Page($db);
$home = new Home($db);

require "config.php";

$plugins->plugin_name = $plugin_name;
$plugins->link = $link;
$plugins->second_page = $second_page;
$plugins->description=$description;
$plugins->icon=$sidebar_icon;
$plugins->title=$sidebar_title;
$plugins->sub_show_title=$sidebar_sub_show_title;
$plugins->sub_show_link=$sidebar_sub_show_link;
$plugins->sub_add_title=$sidebar_sub_add_title;
$plugins->sub_add_link=$sidebar_sub_add_link;

$op = filter_input(INPUT_GET,"op");

if($op=="del"){

    $plugins->plugin_name=$plugin_name;

    $name = ucfirst($plugin_name);

    if($plugins->delete()){
        
        $error=0;

        // DELETE CLASSES
        if(is_file("../../class/Portfolio.php")){
            if(!unlink("../../class/Portfolio.php")){
                $error++;
            }
        }

        if(is_file("../../class/Categories_Portfolio.php")){
            if(!unlink("../../class/Categories_Portfolio.php")){
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

        // DELETE LOCALE IT
        if(is_file("../../locale/en/portfolio_en.php")){
            if(!unlink("../../locale/en/portfolio_en.php")){
                $error++;
            }
        }

        // DELETE LOCALE IT
        if(is_file("../../locale/it/portfolio_it.php")){
            if(!unlink("../../locale/it/portfolio_it.php")){
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


        // DELETE ALERT
        if(is_file('../../inc/alert/portfolio_alert.php')){
            if(!unlink('../../inc/alert/portfolio_alert.php')){
                $error++;
            }
        }
        
        $home->name_function="portfolio";
        $home->delete();
        
        $home->name_function="catPortfolio";
        $home->delete();

        $plugins->plugin_name=$name;
        $plugins->deletePage();

        
        function removeFolder($folderName) {
			if (is_dir($folderName))
			$folderHandle = opendir($folderName);

			// if (!$folderHandle){
			// 	header("Location: ../index.php?man=gall&op=show&msg=gallDelSucc");
			// 	exit;
			// }

			while($file = readdir($folderHandle)) {
				if ($file != "." && $file != "..") {
						if (!is_dir($folderName."/".$file))
							unlink($folderName."/".$file);
						else
							removeFolder($folderName.'/'.$file);
				}
			}
			closedir($folderHandle);
			rmdir($folderName);
			
		}

		$folderName="../../../misc/portfolio/";
		
        unlink("../../inc/class_initialize.php");

			if(removeFolder($folderName)||!is_dir($folderName)){
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginDelSucc");
                exit;
			}else{
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginDelErr");
                exit;
			}

		
            }else{
                header("Location: ../../index.php?man=plugins&op=show&msg=pluginDelErr");
                exit;
			}

    } else if($op=="add"){

        if($plugins->create()){
            
            $error=0;

                        
            // ALERT
            if(copy('alert/backup_alert.php', '../../inc/alert/backup_alert.php')){
                chmod('../../inc/alert/backup_alert.php',0777);
                }else{
                    $error++;
                }

            // ALL
            if(copy('reg/regBackup.php', '../../inc/func/regBackup.php')){
                chmod('../../inc/func/regBackup.php',0777);
            }else{
                $error++;
            }

            // LOCALE EN
            if(copy('locale/en/backup_en.php', '../../locale/en/backup_en.php')){
                chmod('../../locale/en/backup_en.php',0777);
                }else{
                    $error++;
                }

            // LOCALE IT
            if(copy('locale/it/backup_it.php', '../../locale/it/backup_it.php')){
                chmod('../../locale/it/backup_it.php',0777);
                }else{
                    $error++;
                }

            // MNG
            if(copy('mng/mngBackup.php', '../../core/mngBackup.php')){
                chmod('../../core/mngBackup.php',0777);
            }else{
                $error++;
            }

            // RESTORE
            if(copy('page/restore.php', '../../../restore.php')){
                chmod('../../../restore.php',0777);
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
            header("Location: ../../index.php?man=plugins&op=show&msg=pluginErr");
            exit;
        }
    }

