<?php

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
$page_class = pathinfo($file, PATHINFO_FILENAME);
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
    <?php
        if(isset($_SESSION['loggedin'])){
    ?>
    <div id="adminBar">
        <a href="admin">Go to Admin Area</a>
        &nbsp; - &nbsp;
        <a href="admin/core/logout.php">Logout</a>
    </div>
    <?php
        }
    ?>
    <div id="siteContainer">
        <div id="topContainer" class="">
            <div class="coverSfondo"></div>

            <?php
            require "assets/".$theme."/inc/menu.php";
            ?>

            <div id="visual">
                <?php
                require "assets/".$theme."/inc/visual.php";
                ?>
            </div>
        </div>
<?php
}
?>
   
