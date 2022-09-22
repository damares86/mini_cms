<?php

// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

session_start();
// loading class

if(!is_file('admin/class/Database.php')){
    require "admin/inc/dbdata.php";
    exit;
    // header("Location: admin/inc/dbdata.php");
    // exit;
}

require "admin/inc/version.php";

spl_autoload_register('autoloader');

function autoloader($class){
	include("admin/class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$files=glob("admin/class/*.php", GLOB_BRACE);
rsort($files); 

if(!is_file('admin/inc/class_initialize.php')){
$file_handle = fopen('admin/inc/class_initialize.php', 'w');
fwrite($file_handle, '<?php');
fwrite($file_handle, "\n");
foreach ($files as $filename) {
    $nomefile = pathinfo($filename);
    $file=$nomefile['filename'];
    $file_var = strtolower($file);
    fwrite($file_handle, '$'.$file_var.' = new '.$file.'($db);');
    fwrite($file_handle, "\n");
}
fwrite($file_handle,"?>");
chmod('admin/inc/class_initialize.php',0777);

}

include "admin/inc/class_initialize.php";


$stmt2=$settings->showSettings();

$stmt3=$settings->showLangAndName();
$lang=$settings->dashboard_language;


foreach (glob("admin/locale/$lang/*.php") as $file){
    require "$file";
}

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

$root="";

if($file=="index.php"){
    $page_name="Home";
    $page_class = pathinfo($file, PATHINFO_FILENAME);
} else if($file=="post.php"){
    $page_name=$post_title." - Blog ";
    $page_class="blog";
}else if($file=="contact.php"){
    $page_name=$cont_form_page;
    $page_class="contact";
}else if($file=="blog.php"){
}else{
// mi prendo solo il nome senza l'estensione
$page_name = pathinfo($file, PATHINFO_FILENAME);
$page_class = pathinfo($file, PATHINFO_FILENAME);
// rimuovo gli _ (underscore) che ho messo nel nome file
$page_name=str_replace("_"," ", $page_name);
// metto la prima lettera maiuscola
$page_name=ucfirst($page_name);
}

$lang="";

if($page_class=="index"||$page_class=="blog"||$page_class=="contact"){
    $page->page_name=$page_class;
}else{
    $page->page_name=$page_name;
}

$default="";
$showDefault=$page->showAllDefault();
$name="";
if($file=="index.php"){
    $name="index";
}else{
    $name=ucfirst($page_class);
}
foreach($showDefault as $row){
    if($name==$row['page_name']){
        $default=1;
    }
}

if($default==1){
    $stmt=$page->showByNameDefault();
}else{
    $stmt=$page->showByName();
}


$img="";
if($file=="post.php"){
    $img=$post->main_img;
}else{
    $img=$page->img;
}


while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
    
    extract($row);
    $theme=$row['theme'];
    $lang=$row['dashboard_language'];
    
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
        <meta name="author" content="dmweblab" />

        <!-- FACEBOOK and LINKEDIN meta tag -->
        <meta property="og:title" content="<?=$site_name?>">
        <meta property="og:description" content="<?=$site_description?>">
        <meta property="og:url" content="<?=$url?>" />
        <meta property="og:image" content="uploads/img/<?=$img?>">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="800">

        <!-- TWITTER meta tag -->
        <meta name="twitter:card" value="summary">
        <meta name="twitter:title" content="<?=$site_name?>"> 
        <meta name="twitter:description" content="<?=$site_description?>"> 
        <meta name="twitter:site" content="<?=$url?>"/>
        <meta name="twitter:image" content="uploads/img/<?=$img?>"> 
        

		<title><?=$page_name?> - <?=$site_name?></title>
        <link rel="icon" href="assets/<?= $theme ?>/img/favicon.ico">
        <?php
          



        ?>
        
        <link rel="stylesheet" href="admin/template/layout/<?=$page->layout?>.css" />
        <link rel="stylesheet" href="admin/assets/css/my-login.css" />
        <link href='admin/scripts/simplelightbox/simple-lightbox.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="admin/scripts/simplelightbox/simple-lightbox.jquery.min.js"></script>
        <link href='admin/template/inc/layout.css' rel='stylesheet' type='text/css'>
		<?php

            require "assets/".$theme."/inc/scripts.php";
            require "admin/inc/func/check.php";
            if(($file=="login.php")||($file=="contact.php")){
                require "admin/template/inc/recaptcha.php";
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
					<div id="banner" class="box container" style="background-image: url(<?=$root?>uploads/img/<?=$img?>);">
						<div class="row">
							<div class="col-7 col-12-medium">
                            <?php
                            if($page->use_name==1){
                            ?>
								<h2><?=$site_name?></h2>
                            <?php
                            }
                            
                            if($page->use_desc==1){
                            ?>

								<p><?=$site_description?></p>
                            <?php
                            }
                            ?>
							</div>
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