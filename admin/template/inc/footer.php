            <footer>
                <div class="row">
                        <div class="col-12">
                            <div id="copyright">
                                <ul class="menu">
                                    <li><?=$footer?></a></li>
                                    <!-- <li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                <p class="copyright" style="font-size:0.7em;">Made with Mini Cms Church <?=$mc_version?> - Fork of Mini Cms, a project by &nbsp; &nbsp; <a href="https://www.dmweblab.com"><img src="admin/assets/img/dmweblab_logo.png"></a></p>
            </footer>
        </div>

        
        <?php
            require "assets/mcc/inc/cookie.php";
            foreach (glob("admin/scripts/var/*.js") as $file){
                ?>
			    <script src="<?=$file?>"></script>
            <?php
            }
            require "assets/mcc/inc/footerScript.php";
        ?>


	</body>
</html>
