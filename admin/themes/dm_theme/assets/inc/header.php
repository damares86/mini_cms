<?php

session_start();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $page ?> - Mini Cms</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Favicons -->
   <link rel="icon" href="img/favicon.ico">
    <meta name="theme-color" content="#563d7c">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Squada+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/burger.css" rel="stylesheet" type="text/css">
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <meta name="viewport" content="width=device-width, intial-scale=1">
</head>

<body>
    <div id="siteContainer">
        <div id="topContainer" class="<?= $classi ?>">
            <div class="coverSfondo"></div>
            <header>
                <div id="logo">
                    <a href="index.php">
                        <img src="assets/img/logo_mc.svg">
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
                        <li><a href="esperienze.php" <?php
                                                        if ($page == "Esperienze") {
                                                            echo "class='active'";
                                                        }
                                                        ?>>Le esperienze</a></li>
                        <li><a href="eventi.php" <?php
                                                    if ($page == "Eventi") {
                                                        echo "class='active'";
                                                    }
                                                    ?>>Gli eventi speciali</a></li>
                        <li><a href="biglietti.php" <?php
                                                    if ($page == "Biglietti") {
                                                        echo "class='active'";
                                                    }
                                                    ?>>Acquista i biglietti</a></li>
                        <li><a href="contatti.php" <?php
                                                    if ($page == "Contatti") {
                                                        echo "class='active'";
                                                    }
                                                    ?>>Contatti</a></li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </header>