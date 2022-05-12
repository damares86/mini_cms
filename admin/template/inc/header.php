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
$user = new User($db);
$page = new Page($db);
$portfolio = new Portfolio($db);
$portfolio_cat = new Categories_Portfolio($db);
$menu = new Menu($db);
$settings = new Settings($db);
$verify = new Verify($db);

$stmt=$settings->showSettings();

$stmt1=$settings->showLang();
$lang=$settings->dashboard_language;
require "admin/locale/$lang.php";

// prendo il nome del file (con estensione)
$file = basename($_SERVER['PHP_SELF']);

$post_title="";
if(filter_input(INPUT_GET,"id")){
$post_id=filter_input(INPUT_GET,"id");

$post->id=$post_id;
$post->showById();
$post_title = $post->title;
}


$page_name="";
$page_class="";
if($file=="login.php"){
    if (isset($_SESSION['loggedin'])) {
        header('Location: admin/');
        exit;
    }
}

if($file=="index.php"){
    $page_name="Home";
    $page_class = pathinfo($file, PATHINFO_FILENAME);
} else if($file=="post.php"){
    $page_name=$post_title." - Blog ";
    $page_class="blog";
}else if($file=="contact.php"){
    $page_name=$cont_form_page;
    $page_class="contact";
}else{
// mi prendo solo il nome senza l'estensione
$page_name = pathinfo($file, PATHINFO_FILENAME);
$page_class = pathinfo($file, PATHINFO_FILENAME);
// rimuovo gli _ (underscore) che ho messo nel nome file
$page_name=str_replace("_"," ", $page_name);
// metto la prima lettera maiuscola
$page_name=ucfirst($page_name);
}

$root="";


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
          
            if($page_class=="index"||$page_class=="blog"||$page_class=="contact"){
                $page->page_name=$page_class;
            }else{
                $page->page_name=$page_name;
            }
            $stmt1=$page->showByName();
            $img=$page->img;


        ?>
        <link rel="stylesheet" href="admin/template/layout/<?=$page->layout?>.css" />
        <link href='admin/scripts/simplelightbox/simple-lightbox.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="admin/scripts/simplelightbox/simple-lightbox.jquery.min.js"></script>
		<?php

            require "assets/".$theme."/inc/scripts.php";
            if(($file=="login.php")||($file=="contact.php")){
                require "assets/".$theme."/inc/recaptcha.php";
            }
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
            <a href="admin"><?=$goToAdmin?></a>
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
                    if($page->header==1){
                    ?>
                <div id="banner-wrapper">
					<div id="banner" class="box container" style="background-image: url(<?=$root?>assets/<?=$theme?>/img/<?=$img?>);">
						<div class="row">
                            <?php
                            if($use_text==1){
                            ?>
							<div class="col-7 col-12-medium">
								<h2><?=$site_name?></h2>
								<p><?=$site_description?></p>
							</div>
                            <?php
                            }
                            ?>
						</div>
					</div>
				</div>
                    <?php
                    }
                ?> 
            </div>
            <?php
}
?>