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
                    <?php
                        require "admin/template/inc/menu.php";
                    ?>
                    </div>
              
                    <div class="clearfix"></div>