<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php

                $page->page_name="index";
                $page_class="index";
                
                $stmt=$page->showByName();
                ?>
                <div id="content">
                    <div class="block block1 <?=$page_class?>">
                        <?php
                        echo $page->block1;
                        ?>            
                    </div>
                    <?php
                    if($page->block2){
                    ?>
                    <div class="block block2 <?=$page_class?>">
                    <?php
                        echo $page->block2;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block3){
                    ?>
                    <div class="block block3 <?=$page_class?>">
                    <?php
                        echo $page->block3;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block4){
                    ?>
                    <div class="block block4 <?=$page_class?>">
                    <?php
                        echo $page->block4;
                        ?>  
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>