<?php
$page = "Home";
require "assets/inc/header.php";
?>

<div id="visual">

    <div class="row my-5 p-5">
        <div class="col">&nbsp;</div>
        <div class="col">
            <h1 class="my-5">Your website description here</h1>
            <a href="login.php">Login</a>
           
        </div>
    </div>

   
</div>
</div>
<div id="bottomContainer" class="pb-1">
    <div class="container-fluid">

    
        <h1 class="text-center blu p-5">Parco</h1>
        <div class="row sezioni text-center">

            <div class="col-12 col-sm-4 p-5">
                <a href="orbita.php">
                    <img src="assets/img/orbita.png" class="w-75">
                </a>
            </div>
            <div class="col-12 col-sm-4 p-5">
                <a href="luna.php">
                    <img src="assets/img/luna.png" class="w-75">
                </a>
            </div>
            <div class="col-12 col-sm-4 p-5">
                <a href="spazio.php">
                    <img src="assets/img/spazio.png" class="w-75">
                </a>
            </div>
        </div>

        <div class="row mt-5 mb-2">
            <div class="row mx-auto text-center">
                <div class="col-md-6 col-sm-12 mb-2 mb-md-0 rounded verde p-5 align-middle ">
                    <a href="colora.php">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 imgFull px-5">
                                <img src="assets/img/colora.png" class="w-75">
                            </div>
                            <div class="col-12 p-5">
                                <h4>Colora con noi</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 rounded p-0 pl-0 pl-md-2 m-0">
                    <div class="col-sm-12 p-5 mb-2 rounded arancione">
                        <a href="esperienze.php">
                            <div class="row">
                                <div class="col-12 col-md-5 imgFull">
                                    <img src="assets/img/scopri.png" class="w-100">
                                </div>
                                <div class="col-12 col-md-7 p-5">
                                    <h4>Diventa&nbsp;uno scienziato</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 p-5 rounded rosso">
                        <a href="pianeti.php">
                            <div class="row">
                                <div class="col-12 col-md-5 imgFull p-2">
                                    <img src="assets/img/sistema_solare.png" class="w-100">
                                </div>
                                <div class="col-12 col-md-7 p-5">
                                    <h4>Crea il tuo pianeta</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "assets/inc/footer.php";
?>