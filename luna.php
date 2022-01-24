<?php
$classi = "pagine luna";
$page = "Luna";
require "lib/header.php";
require "lib/menuPagine.php";
?>

</div>
<div id="bottomContainer">
    <div class="container-fluid pt-5 pagine position-relative">
        <h1 class="blu text-center">
            La luna</h1>
        <div class="row p-5">
            <div class="col-12 col-sm-7 azzurroScuro wow zoomIn p-3 rounded" data-wow-duration="1s">
                La vedi sempre nel cielo la notte, ma lo sai com'è fatta veramente la Luna? <br>
                Sai che è piena di buchi?
                <br>Tanti astronauti sono andati ad esplorarla e hanno fatto molte foto.<br>
                Se vieni con me ti farò scoprire le loro storie e vedere cosa hanno trovato sulla nostra Luna.
            </div>
            <div class=" mascotte d-none d-sm-block">
                <img src="img/halParla.svg">
            </div>
        </div>
    </div>
    <h1 class="blu text-center">Le giostre</h1>
    <div class="row px-5 mx-auto text-left">
        <!-- <div class="col-12 col-lg-6 mb-2 mb-md-0 p-3 align-middle ">
            <div class="row d-flex rounded verde">
                <div class="col-12 col-md-6 py-3 imgFull">
                    <img src="img/luna1.jpg" class="rounded">
                </div>
                <div class="col-12 col-md-6 p-5">
                    <h4>Montagne russe</h4>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-lg-6 mb-2 mb-md-0 p-3 align-middle ">
            <div class="row d-flex rounded verde">
                <div class="col-12 col-md-6 py-3 imgFull">
                    <img src="img/orbita1.jpg" class="rounded">
                </div>
                <div class="col-12 col-md-6 p-5">
                    <h4>Leggerissimi</h4>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-2 mb-md-0 p-3 align-middle ">
            <div class="row d-flex rounded arancione">
                <div class="col-12 col-md-6 py-3 imgFull">
                    <img src="img/luna2.jpg" class="rounded">
                </div>
                <div class="col-12 col-md-6 p-5">
                    <h4>Lunar Rover</h4>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>

    <h1 class="blu text-center">Le esperienze</h1>
    <div class="row px-5 mx-auto text-left">
        <div class="col-12 col-lg-6 mb-2 mb-md-0 p-3 align-middle ">
            <div class="row d-flex rounded rosso">
                <div class="col-12 col-md-6 py-3 imgFull">
                    <img src="img/luna4.jpg" class="rounded">
                </div>
                <div class="col-12 col-md-6 p-5">
                    <h4>Sulla luna</h4>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-2 mb-md-0 p-3 align-middle ">
            <div class="row d-flex rounded azzurro">
                <div class="col-12 col-md-6 py-3 imgFull">
                    <img src="img/luna-rocce.jpg" class="rounded">
                </div>
                <div class="col-12 col-md-6 p-5">
                    <h4>Il suolo</h4>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
require "lib/footer.php";
?>