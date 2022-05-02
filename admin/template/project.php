<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php
                $file = basename($_SERVER['PHP_SELF']);
                $page_class = pathinfo($file, PATHINFO_FILENAME);

                $page->page_name=$page_name;
                
                $stmt=$page->showByName();
                ?>
                <div id="content">

                project
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>