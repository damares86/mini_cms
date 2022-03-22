<?php

// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

// loading class
session_start();

if(!is_file('admin/class/Database.php')){
    header("Location: admin/inc/dbdata.php");
    exit;
}

spl_autoload_register('autoloader');

function autoloader($class){
	include("admin/class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$page = new Page($db);
$menu = new Menu($db);
$settings = new Settings($db);

$stmt=$settings->showSettings();

// prendo il nome del file (con estensione)
$file = basename($_SERVER['PHP_SELF']);
$page_name="";
$page_class="";
if($file=="index.php"){
    $page_name="Home";
    $page_class = pathinfo($file, PATHINFO_FILENAME);
} else{
// mi prendo solo il nome senza l'estensione
$page_name = pathinfo($file, PATHINFO_FILENAME);
$page_class = pathinfo($file, PATHINFO_FILENAME);
// rimuovo gli _ (underscore) che ho messo nel nome file
$page_name=str_replace("_"," ", $page_name);
// metto la prima lettera maiuscola
$page_name=ucfirst($page_name);
}


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    extract($row);
    $theme=$row['theme'];
    
    ?>

<!doctype html>
<html>
    <head>
        <!--
            ==========================================================================
            
            Mini Cms is a project by damares86 (https://github.com/damares86/mini_cms)
            
            ==========================================================================
        -->
		<meta charset="utf-8">
		<title><?=$page_name?> - <?=$site_name?></title>
        <link rel="icon" href="assets/<?= $theme ?>/img/favicon.ico">
        <?php
          
            $page->page_name=$page_class;
            $stmt1=$page->showByName();


        ?>
        <link rel="stylesheet" href="admin/template/layout/<?=$page->layout?>.css" />
		<?php

            require "assets/".$theme."/inc/scripts.php";
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>

	<body>
        <?php
            $style="";
            if(isset($_SESSION['loggedin'])){
                $style="style='margin-top:1.8em'";
        ?>
        <div id="adminBar">
            <a href="admin">Go to Admin Area</a>
            &nbsp; - &nbsp;
            <a href="admin/core/logout.php">Logout</a>
        </div>
        <?php
            }
        ?>
        <div id="siteContainer" <?=$style?>>
            <div id="topContainer">
                <header>
                <?php
                    require "assets/".$theme."/inc/header.php";
                ?>  
                </header>
                <?php
                    require "assets/".$theme."/inc/visual.php";
                ?> 
            </div>
            <?php
}
?>