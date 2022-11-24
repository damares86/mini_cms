            <footer>
                            <div id="copyright">
                                <?=$footer?>
                            </div>
             
                <p class="copyright" style="font-size:0.7em;">Made with Mini Cms Church <?=$mc_version?> - Fork of Mini Cms, a project by &nbsp; &nbsp; <a href="https://www.dmweblab.com"><img src="admin/assets/img/dmweblab_logo.png"></a></p>
                <br>
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
