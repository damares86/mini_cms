<?php

//CONFRONTARE IL NOME PAGINA CON QUELLO INSERITO NEL DB
// prendo il nome del file (con estensione)
$file = basename($_SERVER['PHP_SELF']);
// mi prendo solo il nome senza l'estensione
$page = pathinfo($file, PATHINFO_FILENAME);
// rimuovo gli _ (underscore) che ho messo nel nome file
$page=str_replace("_"," ", $page);
// metto la prima lettera maiuscola
$page=ucfirst($page);
// ottengo così "Contact 
require "assets/inc/header.php";
?>

<div id="visual">

    <div class="row my-5 p-5">
        <div class="col">&nbsp;</div>
        <div class="col">
            <!-- AGGIUNGERE LA SITE DESCRIPTION RECUPERATA DAL DB -->
            <h1 class="my-5">Your website description here</h1>
            <a href="login.php">Login</a>
           
        </div>
    </div>

   
</div>
</div>
<div id="bottomContainer" class="pb-1">
    <div class="container-fluid">
    
        <div class="row" id="block1">

            
        </div>
        <?php
        // if block1 definito
        ?>
        <div class="row" id="block2">
            
        </div>
        <?php
        //fine
        // if block1 definito

        ?>
        <div class="row" id="block3">

        </div>

        <div class="row" id="block4">

        </div>

    </div>
</div>
<?php
require "assets/inc/footer.php";
?>