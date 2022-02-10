<?php

// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

session_start();
// loading class

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
$settings = new Settings($db);

$stmt=$settings->showSettings();

// prendo il nome del file (con estensione)
$file = basename($_SERVER['PHP_SELF']);
$page_name="";
if($file=="index.php"){
    $page_name="Home";
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
		<meta charset="utf-8">
		<title><?=$page_name?> - <?=$site_name?></title>
        <link rel="icon" href="assets/<?= $theme ?>/img/favicon.ico">
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
                    <div id="logo">
                        <a href="index.php">
                            <img src="assets/<?= $theme ?>/img/logo.png">
                        </a>
                    </div>
                    <div id="menu">
                        <button class="hamburger hamburger--boring" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                    <div id="menuBurger" class="closed">
                    <ul>
                    <?php
                    $menu=$page->showMenu();
                    while ($row = $menu->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row);
                        $str=$row['pagename'];
                        $str = preg_replace('/\s+/', '_', $str);
                        $str = strtolower($str);
                    ?>
                        <li><a href="<?=$str?>.php" ><?php
                        if($row['pagename']=='index'){
                            echo "Home";
                        } else {
                        echo $row['pagename'];
                        }?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                    </div>
              
                    <div class="clearfix"></div>
                </header>
                <div id="visual">
                    visual
                </div>
            </div>
            <?php
}
?>