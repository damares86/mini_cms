<?php

session_start();
// loading class

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

    
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

 extract($row);
$theme=$row['theme'];
// prendo il nome del file (con estensione)
$file = basename($_SERVER['PHP_SELF']);
$page_name="";
if($file=="index.php"){
    $page_name="Home";
} else{
// mi prendo solo il nome senza l'estensione
$page_name = pathinfo($file, PATHINFO_FILENAME);
// rimuovo gli _ (underscore) che ho messo nel nome file
$page_name=str_replace("_"," ", $page_name);
// metto la prima lettera maiuscola
$page_name=ucfirst($page_name);
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $page_name ?> - <?= $row['site_name']?></title>
    <?php
    require "assets/".$theme."/inc/scripts.php";
    ?>
</head>

<body>
  
    <div id="siteContainer">
        <div id="topContainer" class="">
            <div class="coverSfondo"></div>
            <header>
                <div id="logo">
                    <a href="index.php">
                        <img src="assets/<?= $theme ?>/img/logo.svg">
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
                        <li><a href="index.php">Home</a></li>
                    <?php
                    $menu=$page->showMenu();
                    while ($row = $menu->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row);
                        $str=$row['pagename'];
                     	$str = preg_replace('/\s+/', '_', $str);
			            $str = strtolower($str);
                    ?>
                        <li><a href="<?=$str?>.php" ><?=$row['pagename']?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                </div>
              
                <div class="clearfix"></div>
            </header>

            <div id="visual">

<div class="row my-5 p-5">
    <div class="col">&nbsp;</div>
    <div class="col">
        <h1 class="my-5"><?= $row['site_description']?></h1>
        <a href="login.php">Login</a>
       
    </div>
</div>


</div>
<?php
}
?>
   
