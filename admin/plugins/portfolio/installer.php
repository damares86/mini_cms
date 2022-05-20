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

    unlink("../../inc/class_initialize.php");
    header("Location: ../../index.php?man=plugins&op=show&msg=pluginSucc");
    exit;

}else{
    print_r("ko");
    exit;
}

